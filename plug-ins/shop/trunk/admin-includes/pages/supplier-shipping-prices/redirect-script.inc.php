<?php
/**
 * A script to add, update and delete
 * rows in the supplier_shipping_prices table in the shop plug-in.
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

$supplier_shipping_prices_table = $database->get_table('hpi_shop_supplier_shipping_prices');
$customer_regions_table = $database->get_table('hpi_shop_customer_regions');

/*
 * Set the default return to page.
 */
$gvm = Caching_GlobalVarManager::get_instance();
$return_to_url = $gvm->get('current_page_admin_url');
$page_manager = PublicHTML_PageManager::get_instance();

# Delete the project from the database.

//if (isset($_GET['delete_id'])) {
//        $supplier_shipping_prices_table->delete_supplier($_GET['delete_id']);
//        $return_to .= '&last_deleted_id=' . $_GET['delete_id'];
//}
//# Delete the project from the database.

//if (isset($_GET['delete_all'])) {

//        $return_to .= '&deleted_all=successful';
//}

//# Add a new row to the table.
//if (isset($_GET['add_row'])) {

//                print_r($_POST);
//                         add_supplier_shipping_price (
//                                $name,
//                                $notes,
//                                $currency_id,
//                                $email_address,
//                                $telephone_number,
//                                $address_post_office_box,
//                                $address_extended_address,
//                                $address_street_address,
//                                $address_locality,
//                                $address_region,
//                                $address_postal_code,
//                                $address_country_name
//                        )                       
//        $last_added_id = $supplier_shipping_prices_table->add_supplier(
//                $_POST['name'],
//                $_POST['notes'],
//                $_POST['currency_id'],
//                $_POST['email_address'],
//                $_POST['telephone_number'],
//                $_POST['post_office_box'],
//                $_POST['extended_address'],
//                $_POST['street_address'],
//                $_POST['locality'],
//                $_POST['region'],
//                $_POST['postal_code'],
//                $_POST['country_name']
//        );

//        $return_to .= '&last_added_id=' . $last_added_id;

//}


# Update a project in the database.
if (isset($_GET['edit_row'])
	&&
		isset($_GET['supplier_id'])
		&&
		isset($_GET['product_category_id'])
	) {
#print_r($_POST);
		$customer_regions = $customer_regions_table->get_all_rows();
		foreach ($customer_regions as $customer_region)
		{
			$conditions = array();
			$conditions['supplier_id'] = $_GET['supplier_id'];
			$conditions['product_category_id'] = $_GET['product_category_id'];
			$conditions['customer_region_id'] = $customer_region->get_id();
			$supplier_shipping_prices_table->delete_where($conditions);

			$supplier_shipping_prices_table->add_supplier_shipping_price(
				$_GET['supplier_id'],
				$customer_region->get_id(),
				$_GET['product_category_id'],
				$_POST['first_price_' . $customer_region->get_id()],
				$_POST['additional_price_' . $customer_region->get_id()]
			);
		}

		$return_to_url->set_get_variable('last_edited_id', $_GET['edit_row']);
	}

$page_manager->set_return_to_url($return_to_url);
?>
