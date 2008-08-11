<?php
/**
 * Pre-html code for the "edit-user" admin page.
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

/*
 * Check that the user's ID has been set.
 */
if (!isset($_GET['user_id'])) {
    throw new Exception('The user\'s ID must be set!');
}

/*
 * Create the Singleton objects.
 */
$login_manager = Admin_LoginManager::get_instance();
$gvm = Caching_GlobalVarManager::get_instance();

/*
 * Get the user row for the given ID.
 */
$users_table = $login_manager->get_users_table();

$user = $users_table->get_row_by_id($_GET['user_id']);

$gvm->set('user', $user);
?>

