<?php
/**
 * UserLogin_UsersTable
 *
 * @copyright 2007-08-27, Robert Impey
 */

class
	UserLogin_UsersTable
extends
	Database_Table
{
	/**
	 * Should this list be dependent on who is logged in?
	 */
	public function
		get_admin_users_viewable_by_currently_logged_in_user()
	{
		return $this->get_all_rows();
	}
}
?>
