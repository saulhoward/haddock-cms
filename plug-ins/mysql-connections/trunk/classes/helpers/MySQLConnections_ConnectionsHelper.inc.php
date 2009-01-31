<?php
/**
 * MySQLConnections_ConnectionsHelper
 *
 * @copyright 2009-01-31, Robert Impey
 */

class
	MySQLConnections_ConnectionsHelper
{
	public static function
		get_connection(
			$persistent = TRUE
		)
	{
		MySQLConnections_PasswordFileHelper::define_password_data();
		
		if ($persistent) {
			$connection = mysql_pconnect(
				MYSQL_CONNECTIONS_HOST,
				MYSQL_CONNECTIONS_USER,
				MYSQL_CONNECTIONS_PASSWORD
			);	
		} else {
			$connection = mysql_connect(
				MYSQL_CONNECTIONS_HOST,
				MYSQL_CONNECTIONS_USER,
				MYSQL_CONNECTIONS_PASSWORD
			);
		}
		
		if (
			$connection
			&&
			mysql_select_db(
				MYSQL_CONNECTIONS_DATABASE,
				$connection
			)
		) {
			return $connection;
		} else {
			throw new Exception('Unable to get a connection to the database!');
		}
	}
}
?>