<?php
/**
 * Database_SyncTableSpecificationWithDatabaseCLIScript
 *
 * @copyright 2008-06-12, RFI
 */

class
	Database_SyncTableSpecificationWithDatabaseCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		#Database_TableSpecificationHelper
		#	::sync_table_specification_with_database(
		#		$this->get_root_password()
		#	);
		fwrite(
			STDERR,
			'Currently disabled. Use Database_ApplyUnappliedDeltaFilesCLIScript instead.' . PHP_EOL
		);
	}
	
	protected function
		get_help_message()
	{
		$help_message = parent::get_help_message();
		
		$help_message .= PHP_EOL;
		
		$help_message .= 'Makes the database like the table specification.' . PHP_EOL;
		
		return $help_message;
	}
	
	private function
		get_root_password()
	{
		if ($this->has_arg('root-password')) {
			return $this->get_arg('root-password');
		} else {
			fwrite(
				STDERR,
				'Please enter the database root password: ' . PHP_EOL
			);
			
			return trim(fgets(STDIN));
		}
	}
}
?>