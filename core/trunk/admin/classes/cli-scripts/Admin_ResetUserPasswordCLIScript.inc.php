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
		 * Get the array of users.
		 */
		$all_user_entries = Admin_UsersHelper::get_all_user_entries();
		
		/*
		 * Do a bit of array manipulation to put users
		 * into a hash with the names as the key.
		 */
		$users_hash = array();
		
		foreach ($all_user_entries as $user_entry) {
			$users_hash[$user_entry->get_name()] = $user_entry;
		}
		
		/*
		 * Get the user's choice of user.
		 */
		$chosen_user
			= $users_hash[
				CLIScripts_UserInterrogationHelper
					::get_choice_from_string_array(
						array_keys($users_hash)
					)
			];
		
		/*
		 * Reset the password.
		 */
		$chosen_user->reset_password();
	}
}
?>