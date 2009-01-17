<?php
/**
 * Redirect script for the "reset-password" admin page.
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

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

if (isset($_GET['reset_password'])) {
	if (isset($_GET['user_id'])) {
		$user_row = $users_table->get_row_by_id($_GET['user_id']);	

		$user_row->reset_password();
	} else {
		throw new Exception('The password cannot be reset if the user\'s ID is not set!');
	}
}

?>

