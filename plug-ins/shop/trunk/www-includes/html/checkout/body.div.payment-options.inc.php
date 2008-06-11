<?php
/**
 * The Payments Div of the Checkout page
 * Step 3 in the Checkout Process
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */

/*
 * Create the singleton objects.
 */ 
$log_in_manager = Shop_LogInManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
//$payments_option_buttons_factory
//    = Payments_OptionButtonsFactory::get_instance();

/*
 * Create URL objects.
 */
$current_page_url = $page_manager->get_script_uri();
$redirect_script_url = clone $current_page_url;
$redirect_script_url->set_get_variable('type', 'redirect-script');

$cancel_href = $current_page_url;

/*
 * Create database objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$customers_table = $database->get_table('hpi_shop_customers');
$customers_table_renderer = $customers_table->get_renderer();

$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
$shopping_baskets_table_renderer = $shopping_baskets_table->get_renderer();

/*
 * Create the HTML tags objects.
 */
$payments_div = new HTMLTags_Div();
$payments_div->set_attribute_str('id', 'payments_div');

///*
// * Display Protx form
// * when clicked convert the shopping baskets into orders
// * and send the person to Protx
// */
$protx_form = $page_manager->get_inc_file_as_string('body.div.protx-form');
$payments_div->append_str_to_content($protx_form);

//$payment_buttons_div = $payments_option_buttons_factory->get_html_div();
//$payments_div->append_tag_to_content($payment_buttons_div);

/* 
 * Display Customer Shipping Details
 * with edit button to reset the session 
 * and send you back to stage 2
 */
$user = $log_in_manager->get_user();
$user_renderer = $user->get_renderer();

$desired_location = $current_page_url;
$payments_div->append_tag_to_content(
	$user_renderer->get_customer_details_display_div($redirect_script_url, $desired_location)
);

/*
 * Display Shopping Basket
 * with edit button to go to shopping-basket.html
 */
$payments_div->append_tag_to_content(
	$shopping_baskets_table_renderer->get_display_shopping_baskets_for_current_session_div()
);

///*
// * Display PayPal form AGAIN
// * when clicked convert the shopping baskets into orders
// * and send the person to PayPal
// */
$payments_div->append_str_to_content($protx_form);

//$payments_div->append_tag_to_content($payment_buttons_div);


echo $payments_div->get_as_string();
?>
