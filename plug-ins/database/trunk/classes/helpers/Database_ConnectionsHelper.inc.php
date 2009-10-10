<?php
/**
 * Database_ConnectionsHelper
 *
 * @copyright 2008-05-29, RFI
 */

class
	Database_ConnectionsHelper
{
	private static $root_password;
	
	public static function
		get_database_handle()
	{
		#$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		#$mysql_user = $mysql_user_factory->get_for_this_project();
		#$database = $mysql_user->get_database();
		#
		#$dbh = $database->get_database_handle();
		
		$passwords_file
			= Database_PasswordsFileHelper
				::get_passwords_file();
		
		return $passwords_file->get_database_handle();
	}
	
	public static function
		get_root_connection(
			$root_password,
			$root_username = NULL
		)
	{
		if (!isset($root_username)) {
			$root_username = 'root';
		}
		
		$passwords_file
			= Database_PasswordsFileHelper
				::get_passwords_file();
		
		$dbh = mysql_connect(
			$passwords_file->get_host(),
			$root_username,
			$root_password
		);
		
		if (!$dbh) {
			throw
				new Database_UnableToMakeConnectionException(
					$root_username,
					$passwords_file->get_host()
				);
		}
		
		if (
			mysql_select_db(
				$passwords_file->get_database(),
				$dbh
			)
		) {
			return $dbh;
		} else {
			throw new Database_MySQLException($dbh);
		}
	}
	
	public static function
		get_root_connection_using_cli(
			$root_username = NULL
		)
	{
		if (!isset(self::$root_password)) {
			fwrite(
				STDERR,
				'Please enter the root password: ' . PHP_EOL
			);
			
			self::$root_password = trim(fgets(STDIN));
		}
		
		return
			self
				::get_root_connection(
					self::$root_password,
					$root_username
				);
	}
	
	public static function
		is_database_selectable()
	{
		try {
			self::get_database_handle();
		} catch (Database_UnableToMakeConnectionException $e) {
			return FALSE;
		} catch (Database_MySQLException $e) {
			switch ($e->get_error_number()) {
				case 1049:
					/*
					 * Unknown database
					 */
					return FALSE;
			}
		}
		
		return TRUE;
	}
}
?>