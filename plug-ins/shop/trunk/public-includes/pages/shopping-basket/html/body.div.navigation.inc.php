<?php
/**
 * The navigation include for shopping-basket page of the hpi.
 * 
 * @copyright Clear Line Web Design, 2007-08-02
 */

# Build the list of links.
$pages[] = array(
	'name' => 'home',
	'title' => 'Homepage',
	'text' => 'Home'
);

$pages[] = array(
	'name' => 'hpi/shop/products',
	'title' => 'Products',
	'text' => 'Products'
);

$pages[] = array(
	'name' => 'shopping-basket',
	'title' => 'View Your Shopping Basket',
	'text' => 'hpi/shop/Shopping Basket'
);

$pages[] = array(
	'name' => 'contact',
	'title' => 'Contact us',
	'text' => 'Contact'
);

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();
$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
$shopping_baskets_table_renderer = $shopping_baskets_table->get_renderer();

$page_manager = PublicHTML_PageManager::get_instance();

$navigation_div = new HTMLTags_Div();
$navigation_div->set_attribute_str('id', 'navigation');

// SHOPPING BASKET DESCRIPTION DIV WITH LINK TO CHECKOUT
$shopping_desc_div = new HTMLTags_Div();

$p_text = <<<TXT
Your Shopping Basket, brought to you by...
TXT;
$shopping_desc_div->append_tag_to_content(new HTMLTags_P($p_text));

	// Links to all products and checkout
        $product_links_ul = new HTMLTags_UL();

            $all_products_link = new HTMLTags_A('See All Products');
            $all_products_location = new HTMLTags_URL();
            $all_products_location->set_file('/products.html');
            $all_products_link->set_href($all_products_location);
            $all_products_li = new HTMLTags_LI();
            $all_products_li->append_tag_to_content($all_products_link);
            
        $product_links_ul->append_tag_to_content($all_products_li);

           $checkout_link = new HTMLTags_A('Checkout');
            $checkout_location = new HTMLTags_URL();
            $checkout_location->set_file('/checkout.html');
            $checkout_link->set_href($checkout_location);
            $checkout_li = new HTMLTags_LI();
            $checkout_li->append_tag_to_content($checkout_link);
            
        $product_links_ul->append_tag_to_content($checkout_li);

$shopping_desc_div->append_tag_to_content($product_links_ul);        
$navigation_div->append_tag_to_content($shopping_desc_div); 


###########################################
# Navigation Links
###########################################
        ###########################################
        # Links UL
        ###########################################

            $pages_ul = new HTMLTags_UL();
		$pages_ul->set_attribute_str('id', 'navigation-ul');

            foreach ($pages as $page)
            {
                $page_li = new HTMLTags_LI();
                
                    if (($page['name'] == $page_manager->get_page()) || ($page['name'] == $_GET['page']))
                    {
                        $page_link_span = new HTMLTags_Span('&nbsp;' . $page['text']);
                        $page_li->append_tag_to_content($page_link_span);              
                    }
                    else
                    {
                    $page_link_file = '/' . $page['name'] . '.html';
                    
                    $page_link_location = new HTMLTags_URL();
                            $page_link_location->set_file($page_link_file);
                            
                    $page_link_anchor = new HTMLTags_A();
                        $page_link_anchor->set_href($page_link_location);
                        $page_link_anchor->set_attribute_str('title', $page['title']);
                        $page_link_anchor->append_str_to_content($page['text']);
                        
                    $page_li->append_tag_to_content($page_link_anchor);
                    }
                $pages_ul->append_tag_to_content($page_li);
            }
            
    $navigation_div->append_tag_to_content($pages_ul);

echo $navigation_div;
?>
