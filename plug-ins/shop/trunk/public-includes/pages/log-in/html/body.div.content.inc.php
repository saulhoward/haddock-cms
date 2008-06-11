<?php
/**
 * The Login page 
 * of the Shop hpi.
 * 
 * @copyright Clear Line Web Design, 2006-09-27
 */

/*
 * Create singleton objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();

/*
 * Create the database objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$customers_table = $database->get_table('hpi_shop_customers');
$customers_table_renderer = $customers_table->get_renderer();
//$customers_table = $database->get_tusersable('hpi_shop_customers');
//$products_table_renderer = $products_table->get_renderer();
//$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
//$shopping_baskets_table_renderer = $shopping_baskets_table->get_renderer();

// CONTENT DIV
//$wrapper_div = new HTMLTags_Div();
//$wrapper_div->set_attribute_str('id', 'wrapper');
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

// Show The Header 
$main_page_header_id = 'login';
$main_page_header_title = 'Login';
$main_page_header_class = 'login';

$main_page_header_h = new HTMLTags_Heading(2);
$main_page_header_h->set_attribute_str('class', $main_page_header_class);
$main_page_header_h->set_attribute_str('id', $main_page_header_id);

$main_page_header_h->append_tag_to_content(new HTMLTags_Span($main_page_header_title));

$content_div->append_tag_to_content($main_page_header_h);

// Already Logged in?
#if ($logged_in) {
if ($log_in_manager->is_logged_in()) {
	$already_logged_in_div = new HTMLTags_Div();
	$already_logged_in_div->set_attribute_str('id', 'already_logged_in_div');
	// Already logged in
	// You are logged in as Mr. X.
	$p_text = <<<TXT
You are logged in as&nbsp;
TXT;
    
    $p_text .=  $log_in_manager->get_login_name();
	$already_logged_in_div->append_tag_to_content(new HTMLTags_P($p_text));
	$content_div->append_tag_to_content($already_logged_in_div);
}

// Log into existing account (if already logged in - change account)
$log_in_to_account_div = new HTMLTags_Div();
$log_in_to_account_div->set_attribute_str('id', 'log_in_to_account_div');

if ($log_in_manager->is_logged_in()) {
	// Change Account
	$p_text = <<<TXT
You are already logged in. Perhaps you'd like to log out and log in again as someone else...
If so, please click below.
TXT;
	$log_in_to_account_div->append_tag_to_content(new HTMLTags_P($p_text));

	$log_out_url = new HTMLTags_URL();
	$log_out_url->set_file('/');
	$log_out_url->set_get_variable('page', 'log-in');
	$log_out_url->set_get_variable('type', 'redirect-script');
	$log_out_url->set_get_variable('log_out', '1');

	$log_out_link = new HTMLTags_A('Log Out');
	$log_out_link->set_href($log_out_url);
	$log_in_to_account_div->append_tag_to_content($log_out_link);
} else {
	// Log into Account
	$redirect_script_url = new HTMLTags_URL();
	$redirect_script_url->set_file('/');
	$redirect_script_url->set_get_variable('page', 'log-in');
	$redirect_script_url->set_get_variable('type', 'redirect-script');
	$redirect_script_url->set_get_variable('log_in', '1');

	if (isset($_GET['return_to'])) {
		$redirect_script_url->set_get_variable('return_to', $_GET['return_to']);
	}

	$cancel_href = new HTMLTags_URL();
	$cancel_href->set_file('/log-in.html');

	$customer_log_in_form = $customers_table_renderer->get_customer_log_in_form($redirect_script_url, $cancel_href);

	$log_in_to_account_div->append_tag_to_content($customer_log_in_form);
}

$content_div->append_tag_to_content($log_in_to_account_div);

// Create new account (go to customer-details.html)	
$create_new_customer_div = new HTMLTags_Div();
$create_new_customer_div->set_attribute_str('id', 'create_new_customer_div');

$create_new_customer_link = new HTMLTags_A('Create New Customer');
$create_new_customer_link->set_attribute_str('class', 'cool_button');
$create_new_customer_link->set_attribute_str('id', 'create_new_customer_button');
$create_new_customer_location = new HTMLTags_URL();
$create_new_customer_location->set_file('/');
$create_new_customer_location->set_get_variable('page', 'customer-details');

if (isset($_GET['return_to'])) {
	$create_new_customer_location->set_get_variable('return_to', $_GET['return_to']);
}

$create_new_customer_link->set_href($create_new_customer_location);

$create_new_customer_div->append_tag_to_content($create_new_customer_link);
$content_div->append_tag_to_content($create_new_customer_div);

// Blurb at bottom
$p_text = <<<TXT
We hope you have a pleasant login experience.
TXT;
$content_div->append_tag_to_content(new HTMLTags_P($p_text));

// Links to all products and checkout
//$shopping_basket_checkout_links_ul =
//        $shopping_baskets_table_renderer->
//        get_shopping_basket_checkout_links_ul();

//$content_div->append_tag_to_content($shopping_basket_checkout_links_ul);

echo $content_div->get_as_string();

//$wrapper_div->append_tag_to_content($content_div);
//echo $wrapper_div->get_as_string();
?>
