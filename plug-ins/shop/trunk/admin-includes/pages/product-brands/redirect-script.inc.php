<?php
/**
 * The redirect script for the shop - product_brands admin page.
 *
 * @copyright Clear Line Web Design, 2007-03-12
 */

#echo 'print_r($_GET): ' . "\n";
#print_r($_GET);
#echo 'print_r($_POST): ' . "\n";
#print_r($_POST);
##echo 'print_r($_SESSION): ' . "\n";
##print_r($_SESSION);
#echo 'print_r($_FILES): ' . "\n";
#print_r($_FILES);

//require_once PROJECT_ROOT
//. '/haddock/database/classes/'
//. 'Database_MySQLUserFactory.inc.php';

/*
 * Create the database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$product_brands_table = $database->get_table('hpi_shop_product_brands');

/*
 * Set the default return to page.
 */
$gvm = Caching_GlobalVarManager::get_instance();
$return_to_url = $gvm->get('current_page_admin_url');
$page_manager = PublicHTML_PageManager::get_instance();

/*
 * Add or update the product_brands table (and tags and tag links and images.)
 */
if (
	isset($_GET['add_product_brand'])
	||
	isset($_GET['edit_id'])
) {

	#if (isset($_FILES['display_product_brand_file'])) {
	#    $display_product_brand_file = $_FILES['display_product_brand_file'];
	#    #echo 'print_r($_GET): ' . "\n";
	#}
	#else
	#{
	#    $display_product_brand_file = '';
	#}
	#if (isset($_FILES['thumbnail_product_brand_file'])) {
	#    $thumbnail_product_brand_file = $_FILES['thumbnail_product_brand_file'];
	#}
	#else
	#{
	#    $thumbnail_product_brand_file = '';
	#}

	if (isset($_GET['add_product_brand'])) {

		if (isset($_FILES['display_image_file']) && isset($_FILES['thumbnail_image_file']))
		{
			#print_r($_POST);
			$display_image_file = $_FILES['display_image_file'];
			$thumbnail_image_file = $_FILES['thumbnail_image_file'];

			$last_added_id = $product_brands_table->add_product_brand(
				$_POST['name'],
				$_POST['owner'],
				$_POST['description'],
				$_POST['url'],
				$display_image_file,
				$thumbnail_image_file
			);

			$return_to_url->set_get_variable('last_added_id', $last_added_id);
		}
		else {

			#Files not set

			$return_to_url->set_get_variable('add_row', '1');
		}
	}

	if (isset($_GET['edit_id'])) {
		$product_brands_table->edit_product_brand(
			$_GET['edit_id'],
			$_POST['name'],
			$_POST['owner'],
			$_POST['description'],
			$_POST['url']
		);

		$return_to_url->set_get_variable('last_edited_id', $_GET['edit_id']);
	}

}

if (isset($_GET['delete_id'])) {
	$product_brands_table->delete_product_brand($_GET['delete_id']);

	$return_to_url->set_get_variable('last_deleted_id', $_GET['delete_id']);
}

$page_manager->set_return_to_url($return_to_url);
?>
