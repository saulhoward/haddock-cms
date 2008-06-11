<?php
/**
 * Content of the page where customers enter details of
 * the shop plug-in.
 *
 * @copyright Clear Line Web Design, 2007-09-23
 */

/*
 * Create the singleton objects.
 */
$log_in_manager = Shop_LogInManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();

/*
 * Create the Database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();
$customers_table = $database->get_table('hpi_shop_customers');
$customers_table_renderer = $customers_table->get_renderer();

/*
 * Create the HTML tags objects.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * The title of the page.
 */
$content_div->append_tag_to_content(
	new HTMLTags_Heading(2, 'Customer Details')
);

/*
 * Are we logged in?
 */
if (!$log_in_manager->is_logged_in())
{
	$content_div->append_str_to_content(
		$page_manager->get_inc_file_as_string('body.div.not-logged-in')
	);
}
else
{
	if (isset($_GET['updated_details']))
	{
		$content_div->append_tag_to_content(
			new HTMLTags_LastActionBoxDiv(
				$message = 'Updated your shipping details',
				$no_script_href = '',
				$status = 'message'
			)
		);
	}

	/*
	 * Error messages.
	 */
	if (isset($_GET['error_message'])) {
		$content_div->append_tag_to_content(
			new HTMLTags_LastActionBoxDiv(
				$message = stripslashes(urldecode($_GET['error_message'])),
				$no_script_href = '',
				$status = 'error'
			)
		);
	}

	/*
	 * The form for creating an account.
	 */
	$form_location
		= PublicHTML_PublicURLFactory
		::get_url(
			'plug-ins',
			'shop',
			'customer-details',
			'html'
		);

	$redirect_script_location
		= PublicHTML_PublicURLFactory
		::get_url(
			'plug-ins',
			'shop',
			'customer-details',
			'redirect-script'
		);

	$desired_location
		= PublicHTML_PublicURLFactory
		::get_url(
			'plug-ins',
			'shop',
			'customer-details',
			'html'
		);

	$cancel_page_location
		= PublicHTML_PublicURLFactory
		::get_url(
			'plug-ins',
			'shop',
			'products',
			'html'
		);

	$user = $log_in_manager->get_user();
	$user_renderer = $user->get_renderer();

	$content_div->append_tag_to_content(
//                $customers_table_renderer->get_customer_details_adding_form(
//                        $form_location,
//                        $redirect_script_location,
//                        $desired_location,
//                        $cancel_page_location
//                )
		$user_renderer->get_customer_details_editing_form(
			$form_location,
			$redirect_script_location,
			$desired_location,
			$cancel_page_location
		)
	);
}
/*
 * Print everything.
 */

echo $content_div->get_as_string();
?>
