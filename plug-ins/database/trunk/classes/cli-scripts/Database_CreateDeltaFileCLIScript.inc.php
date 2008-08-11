<?php
/**
 * Database_CreateDeltaFileCLIScript
 *
 * @copyright 2008-06-13, RFI
 */

class
	Database_CreateDeltaFileCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		/*
		 * Get the module directory.
		 */
		$module_directory
			= HaddockProjectOrganisation_ModuleDirectoriesHelper
				::get_module_directory_from_cli_choice();
		
		echo 'Creating a delta file for the ' . $module_directory->get_title() . ' module.' . PHP_EOL;
		
		Database_DeltaFilesHelper::create_delta_file($module_directory);
	}
}
?>