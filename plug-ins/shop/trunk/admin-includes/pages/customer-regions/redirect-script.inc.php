<?php
/**
 * A script to add, update and delete
 * rows in the customer_regions table in the shop plug-in.
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

$customer_regions_table = $database->get_table('hpi_shop_customer_regions');

/*
 * Set the default return to page.
 */
$gvm = Caching_GlobalVarManager::get_instance();
$return_to_url = $gvm->get('current_page_admin_url');
$page_manager = PublicHTML_PageManager::get_instance();

# Delete the project from the database.

if (isset($_GET['delete_id'])) {
	$customer_regions_table->delete_by_id($_GET['delete_id']);
	$return_to_url->set_get_variable('last_deleted_id', $_GET['delete_id']);
}
# Delete the project from the database.

if (isset($_GET['delete_all'])) {

	$return_to_url->set_get_variable('deleted_all', 'successful');
}

# Add a new row to the table.
if (isset($_GET['add_row'])) {

	//        print_r($_POST);
	$last_added_id = $customer_regions_table->add_customer_region(
		$_POST['name'],
		$_POST['description'],
		$_POST['currency_id'],
		$_POST['language_id'],
		$_POST['sort_order']
	);


	$return_to_url->set_get_variable('last_added_id', $last_added_id);
}


# Update a project in the database.
if (isset($_GET['edit_id'])) {
	$customer_regions_table->edit_customer_region(
		$_GET['edit_id'],
		$_POST['name'],
		$_POST['description'],
		$_POST['currency_id'],
		$_POST['language_id'],
		$_POST['sort_order']
	);

	$return_to_url->set_get_variable('last_edited_id', $_GET['edit_id']);
}


if (isset($_GET['suppliers'])
	&&
		isset($_GET['customer_region_id'])
	) {
		#print_r($_POST);
		$customer_region_supplier_links_table =
			$database->get_table('hpi_shop_customer_region_supplier_links');
		$suppliers_table = $database->get_table('hpi_shop_suppliers');

		$conditions = array();
		$conditions['customer_region_id'] = $_GET['customer_region_id'];
		$customer_region_supplier_links_table->delete_where($conditions);

		$suppliers = $suppliers_table->get_all_rows();
		foreach ($suppliers as $supplier)
		{
			if (isset($_POST[$supplier->get_id()]))
			{
				$customer_region_supplier_links_table->add_customer_region_supplier_link(
					$supplier->get_id(),
					$_GET['customer_region_id']
				);
			}
		}

//                $return_to .= '&last_set_suppliers_for_customer_region_id=' . $_GET['customer_region_id'];

		$return_to_url->set_get_variable(
			'last_set_suppliers_for_customer_region_id',
			$_GET['customer_region_id']
		);
	}


$page_manager->set_return_to_url($return_to_url);
?>
