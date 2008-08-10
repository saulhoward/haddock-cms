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
	
	/**
	 * Returns all the persistent user entries.
	 */
	public static function
		get_all_user_entries()
	{
		$all_user_entries = array();
		
		$user_rows
			= Database_FetchingHelper
				::get_all_rows_in_table(
					'hc_admin_users',
					'name',
					'ASC'
				);
		#print_r($user_rows);
		
		foreach ($user_rows as $user_row) {
			$all_user_entries[]
				= new Admin_UserEntry(
					$user_row['id'],
					$user_row['name'],
					$user_row['email'],
					$user_row['real_name'],
					$user_row['email']
				);
		}
		
		return $all_user_entries;
	}
}
?>