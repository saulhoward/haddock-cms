<?php
/**
 * Pre-html code for the "reset-password" admin page.
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

/*
 * Make sure that the id of the user has been set.
 */
if (isset($_GET['user_id'])) {
	$user_id = $_GET['user_id'];
} else {
	throw new Exception('The user ID must be set on the reset password page!');
}

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();
$mysql_user_factory = Database_MySQLUserFactory::get_instance();

/*
 * Create the database objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$users_table = $database->get_table('hc_admin_users');

$user_row = $users_table->get_row_by_id($user_id);

/*
 * Store the DB objects in the GVM.
 */
$gvm->set('user-row', $user_row);

?>
