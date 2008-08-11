<?php
/**
 * Database_CreateMySQLUserAndDatabaseCLIScript
 *
 * @copyright 2008-05-29, RFI
 */

class
	Database_CreateMySQLUserAndDatabaseCLIScript
extends
	CLIScripts_CLIScript
{
	protected function
		get_help_message()
	{
		return <<<HLP
Creates a MySQL User and Database for this project.

Uses the values from the DB passwords file.

The DB passwords file must have been created before you
run this script!

HLP;

	}
	
	public function
		do_actions()
	{
		if (
			Database_ConnectionsHelper
				::is_database_selectable()
		) {
			fwrite(
				STDERR,
				'MySQL User and Database are already online, exiting.' . PHP_EOL
			);
		} else {
			$passwords_file
				= Database_PasswordsFileHelper
					::get_passwords_file();
			
			/*
			 * Get the root password for the mysql server
			 */
			printf(
				'Please enter the root password for \'%s\'' . PHP_EOL,
				$passwords_file->get_host()
			);

			$root_password = trim(fgets(STDIN));

			$root_dbh = mysql_connect(
				$passwords_file->get_host(),
				'root',
				$root_password
			);
			
			/*
			 * Don't use this function - the
			 * database hasn't been created yet!
			 */
			#$root_dbh
			#	= Database_ConnectionsHelper
			#		::get_root_connection_using_cli();
			
			$username = $passwords_file->get_username();
			$password = $passwords_file->get_password();
			$database = $passwords_file->get_database();
			
			/*
			 * Shouldn't this be settable?
			 */
			$accessing_host = 'localhost';
			
			/*
			 * Create the user.
			 */
			mysql_query(
				<<<SQL
CREATE USER
    '$username'@'$accessing_host'
IDENTIFIED BY
    '$password'
SQL

				,
				$root_dbh
			);
			
			/*
			 * Create the database.
			 */
			mysql_query(
				<<<SQL
CREATE DATABASE
    $database
SQL

				,
				$root_dbh
			);
			
			/*
			 * Grant a minimal set of permissions on the database for the user.
			 */
			mysql_query(
				<<<SQL
GRANT
    SELECT,
    INSERT,
    UPDATE,
    DELETE
ON
    $database.*
TO
    '$username'@'$accessing_host'
SQL

				,
				$root_dbh
			);
		}
	}
}
?>