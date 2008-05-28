<?php
/**
 * Breaks the naming convention but it's used about a billion
 * times a day, so there.
 *
 * @copyright 2007-12-10, RFI
 */

class
	DB
{
	public static function
		m()
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
	    $mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();
		
		$dbh = $database->get_database_handle();
		
		return $dbh;
	}
}
?>