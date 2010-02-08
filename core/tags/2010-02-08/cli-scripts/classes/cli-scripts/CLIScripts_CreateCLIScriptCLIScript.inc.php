<?php
/**
 * CLIScripts_CreateCLIScriptCLIScript
 *
 * @copyright 2008-06-13, RFI
 */

class
	CLIScripts_CreateCLIScriptCLIScript
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
		
		echo 'Creating a CLI script for the ' . $module_directory->get_title() . ' module.' . PHP_EOL;
		
		$new_script_name
			= CLIScripts_UserInterrogationHelper
				::get_validated_input(
					'Please enter the name of the script: ',
					new CLIScripts_NewScriptNameValidator()
				);
		
		CLIScripts_CLIScriptsHelper
			::create_cli_script(
				$new_script_name,
				$module_directory
			);
	}
}
?>