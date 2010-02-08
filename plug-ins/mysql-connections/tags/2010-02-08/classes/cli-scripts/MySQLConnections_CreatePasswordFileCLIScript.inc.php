<?php
/**
 * MySQLConnections_CreatePasswordFileCLIScript
 *
 * @copyright 2009-01-31, Robert Impey
 */

/*
 * A little script to create the file that contains
 * the password and related info for the connection
 * to the MySQL server for this project.
 *
 * This script started off in the database plug-in.
 */
class
	MySQLConnections_CreatePasswordFileCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		MySQLConnections_PasswordFileHelper
			::create_password_file(
				$this->get_user(),
				$this->get_password(),
				$this->get_database(),
				$this->get_host()
			);
	}
	
	private function
		get_user()
	{
		if ($this->has_arg('user')) {
			return $this->get_arg('user');
		} else {
			return
				CLIScripts_UserInterrogationHelper
					::get_validated_input(
						'Please enter the name of the user:' . PHP_EOL,
						new MySQLConnections_UserNameValidator()
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
						new MySQLConnections_PasswordValidator()
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
						'Please enter the name of the database:' . PHP_EOL,
						new MySQLConnections_DatabaseNameValidator()
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
						'Please enter the name of the host:' . PHP_EOL,
						new MySQLConnections_HostNameValidator()
					);
		}
	}
}
?>