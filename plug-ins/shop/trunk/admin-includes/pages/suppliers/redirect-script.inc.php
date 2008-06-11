<?php
/**
 * A script to add, update and delete
 * rows in the suppliers table in the shop plug-in.
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

$suppliers_table = $database->get_table('hpi_shop_suppliers');

/*
 * Set the default return to page.
 */
$gvm = Caching_GlobalVarManager::get_instance();
$return_to_url = $gvm->get('current_page_admin_url');
$page_manager = PublicHTML_PageManager::get_instance();

# Delete the project from the database.

if (isset($_GET['delete_id'])) {
	$suppliers_table->delete_supplier($_GET['delete_id']);

	$return_to_url->set_get_variable('last_deleted_id', $_GET['delete_id']);
}
# Delete the project from the database.

if (isset($_GET['delete_all'])) {


	$return_to_url->set_get_variable('deleted_all', 'successful');
}

# Add a new row to the table.
if (isset($_GET['add_row'])) {

	//        print_r($_POST);
	//                 add_supplier (
	//                        $name,
	//                        $notes,
	//                        $currency_id,
	//                        $email_address,
	//                        $telephone_number,
	//                        $address_post_office_box,
	//                        $address_extended_address,
	//                        $address_street_address,
	//                        $address_locality,
	//                        $address_region,
	//                        $address_postal_code,
	//                        $address_country_name
	//                )                       
	$last_added_id = $suppliers_table->add_supplier(
		$_POST['name'],
		$_POST['contact_name'],
		$_POST['notes'],
		$_POST['currency_id'],
		$_POST['email_address'],
		$_POST['telephone_number'],
		$_POST['post_office_box'],
		$_POST['extended_address'],
		$_POST['street_address'],
		$_POST['locality'],
		$_POST['region'],
		$_POST['postal_code'],
		$_POST['country_name']
	);

	$return_to .= '&last_added_id=' . $last_added_id;

	$return_to_url->set_get_variable('last_added_id', $last_added_id);
}


# Update a project in the database.
if (isset($_GET['edit_id'])) {
	$suppliers_table->edit_supplier(
		$_GET['edit_id'],
		$_POST['name'],
		$_POST['contact_name'],
		$_POST['notes'],
		$_POST['currency_id'],
		$_POST['email_address'],
		$_POST['telephone_number'],
		$_POST['post_office_box'],
		$_POST['extended_address'],
		$_POST['street_address'],
		$_POST['locality'],
		$_POST['region'],
		$_POST['postal_code'],
		$_POST['country_name']
	);

	$return_to_url->set_get_variable('last_edited_id', $_GET['edit_id']);
}

$page_manager->set_return_to_url($return_to_url);
?>
