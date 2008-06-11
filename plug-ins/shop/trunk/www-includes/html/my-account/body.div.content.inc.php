<?php
/**
 * Content of the page where customers manage accounts for
 * the shop plug-in.
 *
 * @copyright Clear Line Web Design, 2007-09-23
 */

/*
 * Create the singleton objects.
 */
$page_manager = PublicHTML_PageManager::get_instance();
$log_in_manager = Shop_LogInManager::get_instance();
$current_page_url = $page_manager->get_script_uri();
$redirect_script_url = clone $current_page_url;
$redirect_script_url->set_get_variable('type', 'redirect-script');
$cancel_href = clone $current_page_url;

/*
 * Create the HTML tags objects.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * The title of the page.
 */
$content_div->append_tag_to_content(
    new HTMLTags_Heading(2, 'Your Account')
);
if ($log_in_manager->is_logged_in())
{

	/*
	 * My account paragraph
	 */
	$content_div->append_str_to_content(
		$page_manager->get_inc_file_as_string('body.p.my-account')
	);
	/*
	 * All Orders for SUPPLIER Div
	 */
	$customer = $log_in_manager->get_user();
	if ($customer->is_supplier())
	{
		if (isset($_GET['set_status_order_id'])) 
		{
			/**
			 * Row editing.
			 */
			$mysql_user_factory = Database_MySQLUserFactory::get_instance();
			$mysql_user = $mysql_user_factory->get_for_this_project();
			$database = $mysql_user->get_database();
			$orders_table = $database->get_table('hpi_shop_orders');
			$order_row = $orders_table->get_row_by_id($_GET['set_status_order_id']);
			$order_row_renderer = $order_row->get_renderer();

			$row_editing_url = clone $redirect_script_url;
			$row_editing_url->set_get_variable('set_status_order_id', $_GET['set_status_order_id']);
			$row_editing_form  = $order_row_renderer
				->get_order_editing_form_div($row_editing_url, $cancel_href);

			$content_div->append_tag_to_content($row_editing_form);
		}

		$supplier = $customer->get_supplier();
		$supplier_renderer = $supplier->get_renderer();
		$content_div->append_tag_to_content($supplier_renderer->get_all_orders_div($current_page_url));
	}

	/*
	 * All Orders for customer Div
	 */
	$customer = $log_in_manager->get_user();
	$customer_renderer = $customer->get_renderer();
	$content_div->append_tag_to_content($customer_renderer->get_all_orders_div());
	/*
	 * AccountManagement Div
	 */
	$content_div->append_str_to_content(
		$page_manager->get_inc_file_as_string('body.div.account-management')
	);
}
else
{
	$content_div
		->append_str_to_content(
			$page_manager->get_inc_file_as_string('body.div.not-logged-in')
		);
}
/*
 * Print everything.
 */
echo $content_div->get_as_string();
?>
