<?php
/**
 * Database_SyncDatabaseWithTableSpecificationCLIScript
 *
 * @copyright 2008-06-12, RFI
 */

class
	Database_SyncDatabaseWithTableSpecificationCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		Database_TableSpecificationHelper
			::sync_database_with_table_specification();
	}
	
	protected function
		get_help_message()
	{
		$help_message = parent::get_help_message();
		
		$help_message .= PHP_EOL;
		
		$help_message .= 'Makes the table specification like the database.' . PHP_EOL;
		
		return $help_message;
	}
}
?>