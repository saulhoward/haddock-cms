<?php
/**
 * Content of the page you see after you have cancelled payment
 * the shop plug-in.
 *
 * @copyright Clear Line Web Design, 2007-09-23
 */

/*
 * Create the singleton objects.
 */
$page_manager = PublicHTML_PageManager::get_instance();
$log_in_manager = Shop_LogInManager::get_instance();

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();
$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
$shopping_baskets_table_renderer = $shopping_baskets_table->get_renderer();


/*
 * Create the HTML tags objects.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * The title of the page.
 */
$content_div->append_tag_to_content(
    new HTMLTags_Heading(2, 'Payment Cancelled')
);
if ($log_in_manager->is_logged_in())
{
	$content_div->append_tag_to_content(new HTMLTags_P('You have cancelled payment, to continue shopping please use the links below.'));
}
else
{
	$content_div
		->append_str_to_content(
			$page_manager->get_inc_file_as_string('body.div.not-logged-in')
		);
}

/*
 *  Links to all products and checkout
 */
$shopping_basket_checkout_links_ul =
	$shopping_baskets_table_renderer->
		get_shopping_basket_checkout_links_ul();

$content_div->append_tag_to_content($shopping_basket_checkout_links_ul);


/*
 * Print everything.
 */
echo $content_div->get_as_string();
?>
