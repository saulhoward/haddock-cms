<?php
/**
 * A script to add, update and delete
 * rows in the orders table in the shop plug-in.
 *
 * @copyright Clear Line Web Design, 2007-03-02
 */

require_once PROJECT_ROOT
. '/haddock/database/classes/'
. 'Database_MySQLUserFactory.inc.php';
/*
 * Create the singleton objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$gvm = Caching_GlobalVarManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();
$log_in_manager = Shop_LogInManager::get_instance();
$current_page_url = $page_manager->get_script_uri();
$current_page_url->set_get_variable('type', 'html');

/*
 * Create the database objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$orders_table = $database->get_table('hpi_shop_orders');

/*
 * Set the default return to page.
 */
$return_to_url = $current_page_url;

print_r($_POST);
# Update a project in the database.
if (isset($_GET['set_status_order_id'])) {
	$orders_table->edit_order(
		$_GET['set_status_order_id'],
		$_POST['status']
	);
	$return_to_url->set_get_variable('last_edited_id', $_GET['set_status_order_id']);
}

$customer = $log_in_manager->get_user();
if ($customer->is_supplier())
{
	if (isset($_GET['supplier_orders_status'])) 
	{
		$return_to_url->set_get_variable('supplier_orders_status', $_GET['supplier_orders_status']);
	}
}

$page_manager->set_return_to_url($return_to_url);
?>
