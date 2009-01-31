<?php
/**
 * Database_ResetDatabaseCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	Database_ResetDatabaseCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$root_dbh
			= Database_ConnectionsHelper
				::get_root_connection_using_cli();
		
		Database_DatabaseHelper::reset_database($root_dbh);
	}
}
?>