<?php
/**
 * Navigation for the shop plug-in.
 *
 * @copyright Clear Line Web Design, 2007-11-01
 */

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();
$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
$shopping_baskets_table_renderer = $shopping_baskets_table->get_renderer();

$log_in_manager = Shop_LogInManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();

# Build the list of links.
$pages[] = array(
	'location' => 'hpi/shop/home',
	'name' => 'home',
	'title' => 'Homepage',
	'text' => 'Home'
);

//$pages[] = array(
//        'name' => 'products',
//        'location' => 'hpi/shop/products',
//        'title' => 'Products',
//        'text' => 'Products'
//);

###################################
# active stock lines pages
##################################
$product_categories_table = $database->get_table('hpi_shop_product_categories');
$product_categories_table_renderer = $product_categories_table->get_renderer();
$active_product_categories = $product_categories_table->get_active_product_categories();

foreach ($active_product_categories as $active_product_category)
{
	$pages[] = array(
		'name' => $active_product_category->get_name(),
		'absolute_location' => 
		'/?section=plug-ins&module=shop&page=product-category&type=html&product_category_id=' 
		. 
		$active_product_category->get_id(),
			'title' => $active_product_category->get_description(),
			'text' => $active_product_category->get_name()
		);
}
$pages[] = array(
	'name' => 'shopping-basket',
	'location' => 'hpi/shop/shopping-basket',
	'title' => 'View Your Shopping Basket',
	'text' => 'Shopping Basket'
);
$pages[] = array(
	'name' => 'checkout',
	'location' => 'hpi/shop/checkout',
	'title' => 'Proceed to Checkout',
	'text' => 'Checkout'
);
//$pages[] = array(
//        'name' => 'log-in',
//        'location' => 'hpi/shop/log-in',
//        'title' => 'Log In',
//        'text' => 'Log In'
//);
if ($log_in_manager->is_logged_in())
{
	$pages[] = array(
		'name' => 'my-account',
		'location' => 'hpi/shop/my-account',
		'title' => 'Manage and track your orders',
		'text' => 'My Account'
	);
}
$pages[] = array(
	'name' => 'about',
	'location' => 'about',
	'title' => 'About',
	'text' => 'About'
);
$pages[] = array(
	'name' => 'contact',
	'location' => 'contact',
	'title' => 'Contact us',
	'text' => 'Contact'
);



$navigation_div = new HTMLTags_Div();
$navigation_div->set_attribute_str('id', 'shop_navigation');
###########################################
# Navigation Links
###########################################
###########################################
# Links UL
###########################################

$pages_ul = new HTMLTags_UL();
$pages_ul->set_attribute_str('id', 'navigation-ul');

## Have a Shopping Basket?
$current_session_has_shopping_basket = $shopping_baskets_table->check_for_current_session_in_shopping_baskets();
## Is page a product-category?
if (isset($_GET['product_category_id']))
{
	$product_category = $product_categories_table->get_row_by_id($_GET['product_category_id']);
}
foreach ($pages as $page)
{
	$page_li = new HTMLTags_LI();

	if (
		($page['name'] == $page_manager->get_page()) 
		|| 
		($page['name'] == $_GET['page'])
		||
		(
			isset($product_category)
			&&
			($page['name'] == $product_category->get_name())
		)
	)
	{
		$page_link_span = new HTMLTags_Span('&nbsp;' . $page['text']);
		$page_li->append_tag_to_content($page_link_span);              

		$pages_ul->append_tag_to_content($page_li);
	}
	else
	{
		if ($page['name'] == 'shopping-basket' && !$current_session_has_shopping_basket)
		{
			// No shopping basket so do nothing
			// $current_session_has_shopping_basket is set above
		}
		elseif ($page['name'] == 'checkout' && !$current_session_has_shopping_basket)
		{
			// No shopping basket so do nothing
			// $current_session_has_shopping_basket is set above
		}
		//                elseif ($page['name'] == 'log-in' && $logged_in)
		//                {
		//                         #Logged in so do nothing
		//                        # $logged_in is set in security
		//                }
		else
		{
			if (isset($page['absolute_location']))
			{
				$page_link_file = $page['absolute_location'];

			}
			else
			{
				$page_link_file = '/' . $page['location'] . '.html';
			}

			$page_link_location = new HTMLTags_URL();
			$page_link_location->set_file($page_link_file);

			$page_link_anchor = new HTMLTags_A();
			$page_link_anchor->set_href($page_link_location);
			$page_link_anchor->set_attribute_str('title', $page['title']);
			$page_link_anchor->append_str_to_content($page['text']);

			$page_li->append_tag_to_content($page_link_anchor);

			$pages_ul->append_tag_to_content($page_li);
		}
	}
}

$navigation_div->append_tag_to_content($pages_ul);

echo $navigation_div;
?>
