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

/*
 * Create the database objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$orders_table = $database->get_table('hpi_shop_orders');

/*
 * Set the default return to page.
 */
$return_to_url = $gvm->get('current_page_admin_url');

# Update a project in the database.
if (isset($_GET['edit_id'])) {
	$orders_table->edit_order(
		$_GET['edit_id'],
		$_POST['status']
	);
	$return_to_url->set_get_variable('last_edited_id', $_GET['edit_id']);
}

if (isset($_GET['status'])) 
{
	$return_to_url->set_get_variable('status', $_GET['status']);
}

$page_manager->set_return_to_url($return_to_url);
?>
