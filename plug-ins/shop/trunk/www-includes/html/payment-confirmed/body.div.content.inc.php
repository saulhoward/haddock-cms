<?php
/**
 * Content of the page you see after you have paid for
 * the shop plug-in.
 *
 * @copyright Clear Line Web Design, 2007-09-23
 */

/*
 * Create the singleton objects.
 */
$page_manager = PublicHTML_PageManager::get_instance();
$log_in_manager = Shop_LogInManager::get_instance();

/*
 * Create the HTML tags objects.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * The title of the page.
 */
$content_div->append_tag_to_content(
    new HTMLTags_Heading(2, 'Payment Confirmed')
);
if ($log_in_manager->is_logged_in())
{
	$content_div
		->append_str_to_content(
			$page_manager->get_inc_file_as_string('body.div.payment-confirmed')
		);
	/*
	 * All Orders Div
	 */
	$customer = $log_in_manager->get_user();
	$customer_renderer = $customer->get_renderer();
	$content_div->append_tag_to_content($customer_renderer->get_all_orders_div());
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
