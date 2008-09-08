<?php
/**
 * A script to add, update and delete
 * rows in the product_categories table in the shop plug-in.
 *
 * @copyright Clear Line Web Design, 2007-03-02
 */

require_once PROJECT_ROOT
. '/haddock/database/classes/'
. 'Database_MySQLUserFactory.inc.php';

/*
 * Make a table object to access the table.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$product_categories_table = $database->get_table('hpi_shop_product_categories');

/*
 * Set the default return to page.
 */
$gvm = Caching_GlobalVarManager::get_instance();
$return_to_url = $gvm->get('current_page_admin_url');
$page_manager = PublicHTML_PageManager::get_instance();

# Delete the project from the database.

if (isset($_GET['delete_id'])) {
//        $product_categories_table->delete_by_id($_GET['delete_id']);
	$product_categories_table->delete_product_category($_GET['delete_id']);
//        print_r($_GET['delete_id']);exit;
	$return_to_url->set_get_variable('last_deleted_id', $_GET['delete_id']);
}
# Delete the project from the database.

if (isset($_GET['delete_all'])) {

	$return_to_url->set_get_variable('deleted_all', 'successful');
}

# Add a new row to the table.
if (isset($_GET['add_row'])) {

	#print_r($_POST);

	$last_added_id = $product_categories_table->add_product_category(
		$_POST['name'],
		$_POST['description'],
		$_POST['sort_order']
	);

	$return_to .= '&last_added_id=' . $last_added_id;

	$return_to_url->set_get_variable('last_added_id', $last_added_id);
}


# Update a project in the database.
if (isset($_GET['edit_id'])) {
	$product_categories_table->edit_product_category(
		$_GET['edit_id'],
		$_POST['name'],
		$_POST['description'],
		$_POST['sort_order']
	);

	$return_to_url->set_get_variable('last_edited_id', $_GET['edit_id']);
}

$page_manager->set_return_to_url($return_to_url);
?>
