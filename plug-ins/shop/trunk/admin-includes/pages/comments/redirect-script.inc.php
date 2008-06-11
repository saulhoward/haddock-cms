<?php
/**
 * The redirect script for the comments admin page.
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

$comments_table = $database->get_table('hpi_shop_comments');

/*
 * Set the default return to page.
 */

$gvm = Caching_GlobalVarManager::get_instance();
$return_to_url = $gvm->get('current_page_admin_url');
$page_manager = PublicHTML_PageManager::get_instance();

/*
 * Add or update the comments table (and tags and tag links and images.)
 */
if (
	isset($_GET['add_comment'])
	||
	isset($_GET['edit_id'])
) {

	if (isset($_GET['add_comment'])) {

		$ip = $_SERVER['REMOTE_ADDR'];            
		#print_r($_POST);

		$last_added_id = $comments_table->add_comment(
			$_POST['name'],
			$ip,
			$_POST['email'],
			$_POST['url'],
			$_POST['homepage_title'],
			$_POST['comment'],
			$_POST['product_id'],
			$_POST['status'],
			$_POST['front_page']
		);

		$return_to_url->set_get_variable('last_added_id', $last_added_id);
	}

	if (
		isset($_GET['edit_id'])
		&&
		isset($_GET['set_status'])
	) {
		$comments_table->set_status($_GET['edit_id'], $_GET['set_status']);

		$return_to_url->set_get_variable('last_edited_id', $_GET['edit_id']);
	}

	elseif (isset($_GET['edit_id'])) {
		$comments_table->edit_comment(
			$_GET['edit_id'],
			$_POST['name'],
			$_POST['email'],
			$_POST['url'],
			$_POST['homepage_title'],
			$_POST['comment'],
			$_POST['product_id'],
			$_POST['status'],
			$_POST['front_page']
		);

		$return_to_url->set_get_variable('last_edited_id', $_GET['edit_id']);
	}

}

if (isset($_GET['delete_id'])) {
	$comments_table->delete_comment($_GET['delete_id']);


	$return_to_url->set_get_variable('last_deleted_id', $_GET['delete_id']);
}

if (isset($_GET['status'])) 
{
	$return_to_url->set_get_variable('status', $_GET['status']);
}
$page_manager->set_return_to_url($return_to_url);
?>
