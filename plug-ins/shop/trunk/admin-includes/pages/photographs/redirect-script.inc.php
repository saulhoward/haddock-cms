<?php
/**
 * The redirect script for the shop - photographs admin page.
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

require_once PROJECT_ROOT
. '/haddock/database/classes/'
. 'Database_MySQLUserFactory.inc.php';

/*
 * Create the database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$photographs_table = $database->get_table('hpi_shop_photographs');

/*
 * Set the default return to page.
 */
$gvm = Caching_GlobalVarManager::get_instance();
$return_to_url = $gvm->get('current_page_admin_url');
$page_manager = PublicHTML_PageManager::get_instance();

/*
 * Add or update the photographs table (and tags and tag links and images.)
 */
if (
	isset($_GET['add_photograph'])
	||
	isset($_GET['edit_id'])
) {

	#if (isset($_FILES['display_photograph_file'])) {
	#    $display_photograph_file = $_FILES['display_photograph_file'];
	#    #echo 'print_r($_GET): ' . "\n";
	#}
	#else
	#{
	#    $display_photograph_file = '';
	#}
	#if (isset($_FILES['thumbnail_photograph_file'])) {
	#    $thumbnail_photograph_file = $_FILES['thumbnail_photograph_file'];
	#}
	#else
	#{
	#    $thumbnail_photograph_file = '';
	#}

	if (isset($_GET['add_photograph'])) {

		if (isset($_FILES['display_photograph_file']) 
			&&
				isset($_FILES['medium_photograph_file']) 
				&&
				isset($_FILES['thumbnail_photograph_file']))
		{
			#print_r($_POST);
			$display_photograph_file = $_FILES['display_photograph_file'];
			$medium_photograph_file = $_FILES['medium_photograph_file'];
			$thumbnail_photograph_file = $_FILES['thumbnail_photograph_file'];

			$last_added_id = $photographs_table->add_photograph(
				$_POST['name'],
				$display_photograph_file,
				$medium_photograph_file,
				$thumbnail_photograph_file
			);

			$return_to_url->set_get_variable('last_added_id', $last_added_id);
		}
		else {

			#Files not set

			$return_to_url->set_get_variable('add_row', '1');
		}
	}

	if (isset($_GET['edit_id'])) {
		$photographs_table->edit_photograph(
			$_GET['edit_id'],
			$_POST['name']
		);

		$return_to_url->set_get_variable('last_edited_id', $_GET['edit_id']);
	}

}

if (isset($_GET['delete_id'])) {
	$photographs_table->delete_photograph($_GET['delete_id']);

	$return_to_url->set_get_variable('last_deleted_id', $_GET['delete_id']);
}

$page_manager->set_return_to_url($return_to_url);
?>
