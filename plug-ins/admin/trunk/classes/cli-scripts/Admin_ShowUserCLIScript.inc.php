<?php
/**
 * Admin_ShowUserCLIScript
 *
 * @copyright 2008-08-10, Robert Impey
 */

class
	Admin_ShowUserCLIScript
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
		 * Show the data of the user.
		 */
		$chosen_user->show_data_on_cli();
	}
}
?>