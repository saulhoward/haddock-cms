<?php
/**
 * The Accounts Div of the Checkout page
 * Step 1 in the Checkout Process
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */

#echo __FILE__; exit;

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

// If checkout_status == 'accounts'
// 	then not logged in
//
// 	Create new account
// 	OR
//	Log in

$accounts_div = new HTMLTags_Div();
$accounts_div->set_attribute_str('id', 'accounts_div');

/*
 * Print any errors.
 */
if (isset($_GET['error_message'])) {
	$last_action_div = new HTMLTags_Div();
	$last_action_div->set_attribute_str('id', 'last_action_div');

	$error_p = new HTMLTags_P(stripcslashes($_GET['error_message']));
	
	$error_p->set_attribute_str('class', 'error');
	$last_action_div->append_tag_to_content($error_p);

	$accounts_div->append_tag_to_content($last_action_div);

	$clear_div = new HTMLTags_Div();
	$clear_div->set_attribute_str('style', 'clear:both;');

	$accounts_div->append_tag_to_content($clear_div);
}

// ADD NEW CUSTOMER FORM
$add_customer_h = new HTMLTags_Heading(3, 'Create a new account');
$accounts_div->append_tag_to_content($add_customer_h);

/*
 * The form for creating an account.
 */
$form_location = $current_page_url;
$redirect_script_location
    = PublicHTML_PublicURLFactory
        ::get_url(
            'plug-ins',
            'shop',
            'create-new-account',
            'redirect-script'
        );
$desired_location = $current_page_url;
$cancel_page_location = $current_page_url;

//print_r($current_page_url);
//exit;
$accounts_div->append_tag_to_content(
	$log_in_manager->get_create_new_account_form(
		$form_location,
		$redirect_script_location,
		$desired_location,
		$cancel_page_location
	)
);

// LOG IN FORM
$log_in_h = new HTMLTags_Heading(3, 'Log in with your existing account');
$accounts_div->append_tag_to_content($log_in_h);

$login_form_div = new HTMLTags_Div();
#$login_form_div->set_attribute_str('class', 'cmx-form');

$form_location = $current_page_url;
$redirect_script_location
	= PublicHTML_PublicURLFactory
		::get_url(
			'plug-ins',
			'shop',
			'log-in',
			'redirect-script'
		);

$desired_location = $current_page_url;
$cancel_page_location = $current_page_url;

$login_form_div->append_tag_to_content(
	$log_in_manager->get_log_in_form(
		$form_location,
		$redirect_script_location,
		$desired_location,
		$cancel_page_location
	)
);

/*
 * The link to the password reset page.
 */
$password_reset_confirmation_url = $log_in_manager->get_password_reset_confirmation_url();
$password_reset_confirmation_a = new HTMLTags_A('Forgotten your password?');
$password_reset_confirmation_a->set_href($password_reset_confirmation_url);
$login_form_div->append_tag_to_content($password_reset_confirmation_a);

$accounts_div->append_tag_to_content($login_form_div);

echo $accounts_div->get_as_string();
?>
