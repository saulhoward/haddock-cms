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
	 *
	 * @return array The user entries.
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
					$user_row['type']
				);
		}
		
		return $all_user_entries;
	}
	
	public static function
		reset_all_users_passwords()
	{
		$all_user_entries = self::get_all_user_entries();
		
		foreach ($all_user_entries as $user_entry) {
			$user_entry->reset_password();
		}
	}
	
	public static function
		reset_user_password(
			Admin_UserEntry $user_entry
		)
	{
		$real_name = $user_entry->get_real_name();
		
		/*
		 * Check that the user has an email address to send the
		 * new password to.
		 */
		if (strlen($user_entry->get_email()) == 0) {
			throw new Exception(
				'Unable to reset the password of ' 
				. $user_entry->get_real_name() 
				. ' as no email address has been set!'
			);
		}

		/*
		 * Generate the new password.
		 */
		$pwg = Security_PasswordGenerator::get_instance();
		$pw = $pwg->get_password();
		
		/*
 		 * Check that there is an admin for this site.
		 */		
		$from_email = '';

		/*
		 * Compose an email.
		 *
		 * How can this be edited and overridden?
		 */
		$email_title = 'New password for ' . $user_entry->get_real_name();
		$to_email = $user_entry->get_email();

		$email_body = <<<EML
Dear $real_name,

Your password has been reset to '$pw'.
EML;
		
		if (mail($to_email, $from_email, $email_body, "From: $from_email;\r\nReply-To: $from_email")) {
			$alm = Admin_LoginManager::get_instance();

			$alm->set_password($user_entry->get_name(), $pw);
		} else {	
			throw new Exception("Unable to send a password reset email to $to_email!");
		}
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the CLI
	 * ----------------------------------------
	 */
	
	public static function
		get_user_entry_from_cli_choice()
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
		return
			$users_hash[
				CLIScripts_UserInterrogationHelper
					::get_choice_from_string_array(
						array_keys($users_hash)
					)
			];
	}
	
	public static function
		show_user_data_on_cli(
			Admin_UserEntry $user_entry
		)
	{
		/*
		 * Preprocess the data into an assoc.
		 */
		$user_assoc = $user_entry->get_assoc();
		#print_r($user_assoc);
		
		/*
		 * Render the data.
		 */
		CLIScripts_DataRenderingHelper
			::render_array_of_assocs_in_table(
				array($user_assoc),
				array(
					'id' => 'ID'
				)
			);
	}
}
?>