<?php
/**
 * Admin_DeleteAllUsersCLIScript
 *
 * @copyright 2008-08-09, Robert Impey
 */

/**
 * A script to delete all the admin users from the
 * RDMS.
 */
class
	Admin_DeleteAllUsersCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		Admin_UsersHelper::delete_all_users();
	}
}
?>