<?php
/**
 * A script to add, update and delete
 * rows in the customers table in the shop plug-in.
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

$customers_table = $database->get_table('hpi_shop_customers');

//print_r($_POST);
/*
 * Set the default return to page.
 */
$gvm = Caching_GlobalVarManager::get_instance();
$return_to_url = $gvm->get('current_page_admin_url');
$page_manager = PublicHTML_PageManager::get_instance();

# Delete the project from the database.

if (isset($_GET['delete_id'])) {
	$customers_table->delete_by_id($_GET['delete_id']);

	$return_to_url->set_get_variable('last_deleted_id', $_GET['delete_id']);
}
# Delete the project from the database.

if (isset($_GET['delete_all'])) {
	$return_to_url->set_get_variable('deleted_all', 'successful');
}

# Add a new row to the table.
if (isset($_GET['add_row'])) {

	//                add_customer (
	//                        $full_name = '',
	//                        $email_address = '',
	//                        $password = '',
	//                        $telephone_number = '',
	//                        $address_post_office_box = '',
	//                        $address_extended_address = '',
	//                        $address_street_address = '',
	//                        $address_locality = '',
	//                        $address_region = '',
	//                        $address_postal_code = '',
	//                        $address_country_name = ''
	//                        $customer_region_id = $_SESSION['customer_region_id']
	//                )

	//                print_r($_POST);
	$last_added_id = $customers_table->add_customer(
		$_POST['full_name'],
		$_POST['password'],
		$_POST['email_address'],
		$_POST['telephone_number'],
		$_POST['post_office_box'],
		$_POST['extended_address'],
		$_POST['street_address'],
		$_POST['locality'],
		$_POST['region'],
		$_POST['postal_code'],
		$_POST['country_name'],
		$_POST['customer_region_id']
	);


	$return_to_url->set_get_variable('last_added_id', $last_added_id);

}
//                edit_customer (
//                        $edit_id,
//                        $full_name,
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

# Update a project in the database.
if (isset($_GET['edit_id'])) {
	$customers_table->edit_customer(
		$_GET['edit_id'],
		$_POST['full_name'],
		$_POST['address_id'],
		$_POST['email_address'],
		$_POST['telephone_number_id'],
		$_POST['customer_region_id']
	);
	
	$return_to_url->set_get_variable('last_edited_id', $_GET['edit_id']);
}

$page_manager->set_return_to_url($return_to_url);
?>
