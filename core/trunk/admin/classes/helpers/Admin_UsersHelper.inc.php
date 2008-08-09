<?php
/**
 * Admin_UsersHelper
 *
 * @copyright 2008-08-09, Robert Impey
 */

/**
 * A collection of functions to do with the admin users
 * of the site.
 */
class
	Admin_UsersHelper
{
	public static function
		delete_all_users()
	{
		Database_TableHelper::empty_table('hc_admin_users');
	}
}
?>