<?php
/**
 * HaddockProjectOrganisation_SetModuleDirectoryCamelCaseRootCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	HaddockProjectOrganisation_SetModuleDirectoryCamelCaseRootCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$module_directory
			= HaddockProjectOrganisation_ModuleDirectoriesHelper
				::get_module_directory_from_cli_choice();
		
		echo 'Setting the camel case root for the ' . $module_directory->get_title() . ' module.' . PHP_EOL;
		
		$camel_case_root
			= CLIScripts_UserInterrogationHelper
				::get_validated_input(
					'Please enter the upper camel case root: ',
					new HaddockProjectOrganisation_ModuleDirectoryCamelCaseRootValidator()
				);
				
		HaddockProjectOrganisation_ModuleDirectoriesCamelCaseRootsHelper
			::set_camel_case_root(
				$camel_case_root,
				$module_directory
			);
	}
}
?>