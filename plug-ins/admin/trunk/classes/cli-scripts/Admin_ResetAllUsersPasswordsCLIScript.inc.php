<?php
/**
 * Admin_ResetAllUsersPasswordsCLIScript
 *
 * @copyright 2008-08-10, Robert Impey
 */

class
	Admin_ResetAllUsersPasswordsCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		Admin_UsersHelper::reset_all_users_passwords();
	}
}
?>