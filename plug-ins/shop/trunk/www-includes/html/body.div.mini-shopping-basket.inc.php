<?php
/**
 * A mini div that shows any items in the shopping basket.
 *
 * Would probably go on the side somewhere.
 *
 * @copyright Clear Line Web Design, 2007-11-01
 */

/*
 * Create the singleton objects.
 */
$page_manager = PublicHTML_PageManager::get_instance();
$mysql_user_factory = Database_MySQLUserFactory::get_instance();

/*
 * Create the database objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();
$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
$shopping_baskets_table_renderer = $shopping_baskets_table->get_renderer();

/*
 * Show the mini shopping basket, if necessary.
 */

$current_session_has_shopping_basket 
	= $shopping_baskets_table->check_for_current_session_in_shopping_baskets();

if (
	$current_session_has_shopping_basket 
	&& 
	$page_manager->get_page() != 'shopping-basket'
	&& 
	$page_manager->get_page() != 'checkout'
) {
	$mini_shopping_basket_div = 
		$shopping_baskets_table_renderer->get_mini_shopping_baskets_for_current_session_div();
	$mini_shopping_basket_div->set_attribute_str('id', 'mini-shopping-basket');

	echo $mini_shopping_basket_div->get_as_string();
}
?>
