<?php
/**
 * Database_CreatePasswordsFileCLIScript
 *
 * @copyright 2008-05-27, RFI
 */

class
	Database_CreatePasswordsFileCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		Database_PasswordsFileHelper
			::create_passwords_file(
				$this->get_username(),
				$this->get_password(),
				$this->get_database(),
				$this->get_host()
			);
	}
	
	private function
		get_username()
	{
		if ($this->has_arg('username')) {
			return $this->get_arg('username');
		} else {
			return
				CLIScripts_UserInterrogationHelper
					::get_validated_input(
						'Please enter the username:' . PHP_EOL,
						new Database_UsernameValidator()
					);
		}
	}
	
	private function
		get_password()
	{
		if ($this->has_arg('password')) {
			return $this->get_arg('password');
		} else {
			return
				CLIScripts_UserInterrogationHelper
					::get_validated_input(
						'Please enter the password:' . PHP_EOL,
						new Database_PasswordValidator()
					);
		}
	}
	
	private function
		get_database()
	{
		if ($this->has_arg('database')) {
			return $this->get_arg('database');
		} else {
			return
				CLIScripts_UserInterrogationHelper
					::get_validated_input(
						'Please enter the database name:' . PHP_EOL,
						new Database_DatabaseNameValidator()
					);
		}
	}
	
	private function
		get_host()
	{
		if ($this->has_arg('host')) {
			return $this->get_arg('host');
		} else {
			return
				CLIScripts_UserInterrogationHelper
					::get_validated_input(
						'Please enter the host name:' . PHP_EOL,
						new Database_HostNameValidator()
					);
		}
	}
}
?>