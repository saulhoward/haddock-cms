<?php
/**
 * Content div of the Checkout page.
 * 
 * @copyright Clear Line Web Design, 2006-09-27
 */

$log_in_manager = Shop_LogInManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();
$current_page_url = $page_manager->get_script_uri();
$redirect_script_url = clone $current_page_url;
$redirect_script_url->set_get_variable('type', 'redirect-script');
$cancel_href = $current_page_url;

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();
$products_table = $database->get_table('hpi_shop_products');
$products_table_renderer = $products_table->get_renderer();
$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
$shopping_baskets_table_renderer = $shopping_baskets_table->get_renderer();
$customers_table = $database->get_table('hpi_shop_customers');
$customers_table_renderer = $customers_table->get_renderer();

// CONTENT DIV

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

$main_page_header_id = 'checkout';
$main_page_header_title = 'Checkout';
$main_page_header_class = 'checkout';

$main_page_header_h = new HTMLTags_Heading(2);
$main_page_header_h->set_attribute_str('class', $main_page_header_class);
$main_page_header_h->set_attribute_str('id', $main_page_header_id);

$main_page_header_h->append_tag_to_content(new HTMLTags_Span($main_page_header_title));

$content_div->append_tag_to_content($main_page_header_h);

// Get Checkout Status
//
$checkout_manager = Shop_CheckoutManager::get_instance();
$checkout_status = $checkout_manager->get_checkout_status();

#print_r($checkout_status);

#echo "About to show the nested div\n";

if ($checkout_status != 'no-shopping-basket')
{
	// Put up the Checkout status div
	$checkout_status_div = $checkout_manager->get_checkout_status_div();
	$content_div->append_tag_to_content($checkout_status_div);

	// If checkout_status == 'accounts'
	if ($checkout_status == 'accounts')
	{
		$content_div
			->append_str_to_content(
				$page_manager->get_inc_file_as_string('body.div.accounts')
			);
	}

	//If $logged_in checkout_status == 'shipping_details'
	elseif ($checkout_status == 'shipping-details')
	{
		$content_div
			->append_str_to_content(
				$page_manager->get_inc_file_as_string('body.div.shipping-details')
			);
	}

	//If checkout_status == 'payment-options'
	//	
	//	show shopping-basket and shipping-details (with edit button) and PayPal button
	//
	//	OR Log Out
	//
	elseif ($checkout_status == 'payment-options')
	{
		$content_div
			->append_str_to_content(
				$page_manager->get_inc_file_as_string('body.div.payment-options')
			);
	}
	elseif ($checkout_status == 'checkout-error')
	{
		$content_div
			->append_str_to_content(
				$page_manager->get_inc_file_as_string('body.div.checkout-error')
			);
	}
}
elseif ($checkout_status == 'no-shopping-basket')
{
		$content_div
			->append_str_to_content(
				$page_manager->get_inc_file_as_string('body.div.no-shopping-basket')
			);
}
echo $content_div->get_as_string();
?>
