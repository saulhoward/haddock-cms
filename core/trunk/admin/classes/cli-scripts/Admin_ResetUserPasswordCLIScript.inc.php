<?php
/**
 * Admin_ResetUserPasswordCLIScript
 *
 * @copyright 2008-08-10, Robert Impey
 */

class
	Admin_ResetUserPasswordCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		/*
		 * Get the user's choice of user.
		 */
		$chosen_user
			= Admin_UsersHelper
				::get_user_entry_from_cli_choice();
		
		/*
		 * Reset the password.
		 */
		$chosen_user->reset_password();
	}
}
?>