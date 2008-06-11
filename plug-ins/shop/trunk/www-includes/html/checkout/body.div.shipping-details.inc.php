<?php
/**
 * The shipping_details Div of the Checkout page
 * Step 1 in the Checkout Process
 *
 * @copyright 2007-08-21, Clear Line Web Design
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
$customers_table = $database->get_table('hpi_shop_customers');
$customers_table_renderer = $customers_table->get_renderer();

$shipping_details_div = new HTMLTags_Div();
$shipping_details_div->set_attribute_str('id', 'shipping_details_div');

$add_customer_url = clone $redirect_script_url;
$add_customer_url->set_get_variable('add_shipping_details');
/*
 * Error messages.
 */
//if (isset($_GET['error_message'])) {
//        $shipping_details_div->append_tag_to_content(
//                new HTMLTags_LastActionBoxDiv(
//                        $message = stripslashes(urldecode($_GET['error_message'])),
//                        $no_script_href = '',
//                        $status = 'error'
//                )
//        );
//}

/*
 * Print any errors.
 */
if (isset($_GET['error_message'])) {
	$last_action_div = new HTMLTags_Div();
	$last_action_div->set_attribute_str('id', 'last_action_div');

	$error_p = new HTMLTags_P(stripcslashes($_GET['error_message']));
	
	$error_p->set_attribute_str('class', 'error');
	$last_action_div->append_tag_to_content($error_p);

	$shipping_details_div->append_tag_to_content($last_action_div);

	$clear_div = new HTMLTags_Div();
	$clear_div->set_attribute_str('style', 'clear:both;');

	$shipping_details_div->append_tag_to_content($clear_div);
}

/*
 * The form for creating an account.
 */
$form_location = $current_page_url;
$redirect_script_location
	= PublicHTML_PublicURLFactory
		::get_url(
			'plug-ins',
			'shop',
			'customer-details',
			'redirect-script'
		);
$desired_location = $current_page_url;
$cancel_page_location = $current_page_url;
$user = $log_in_manager->get_user();
$user_renderer = $user->get_renderer();

$shipping_details_div->append_tag_to_content(
	$user_renderer->get_customer_details_editing_form(
		$form_location,
		$redirect_script_location,
		$desired_location,
		$cancel_page_location
	)
);

//$customer_adding_form 
//        = $customers_table_renderer->get_simplified_customer_adding_form($add_customer_url, $cancel_href);
//$shipping_details_div->append_tag_to_content($customer_adding_form);

echo $shipping_details_div->get_as_string();
?>
