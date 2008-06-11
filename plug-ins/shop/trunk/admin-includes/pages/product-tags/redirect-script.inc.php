<?php
/**
 * A script to add, update and delete
 * rows in the products table in the shop plug-in.
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

$product_tags_table = $database->get_table('hpi_shop_product_tags');

/*
 * Set the default return to page.
 */
$gvm = Caching_GlobalVarManager::get_instance();
$return_to_url = $gvm->get('current_page_admin_url');
$page_manager = PublicHTML_PageManager::get_instance();
#
# Add a new row to the table.
if (isset($_GET['add_row'])) {

	#print_r($_POST);

	$last_added_id = $product_tags_table->add_product_tag(
		$_POST['tag'],
		$_POST['principal']
	);

	$return_to_url->set_get_variable('last_added_id', $last_added_id);
}

elseif (isset($_GET['toggle_principal_status'])
	&&
		isset($_GET['product_tag_id'])
	) {
		$product_tag = $product_tags_table->get_row_by_id($_GET['product_tag_id']);
		$product_tag->toggle_principal_status();

		$return_to_url->set_get_variable('last_edited_id', $_GET['product_tag_id']);
	}

$page_manager->set_return_to_url($return_to_url);
?>
