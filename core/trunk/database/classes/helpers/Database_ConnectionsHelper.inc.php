<?php
/**
 * Database_ConnectionsHelper
 *
 * @copyright 2008-05-29, RFI
 */

class
	Database_ConnectionsHelper
{
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
}
?>