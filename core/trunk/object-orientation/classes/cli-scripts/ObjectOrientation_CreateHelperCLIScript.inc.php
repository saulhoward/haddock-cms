<?php
/**
 * ObjectOrientation_CreateHelperCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	ObjectOrientation_CreateHelperCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$module_directory
			= HaddockProjectOrganisation_ModuleDirectoriesHelper
				::get_module_directory_from_cli_choice();
		
		echo 'Creating a helper for the ' . $module_directory->get_title() . ' module.' . PHP_EOL;
		
		$new_helper_name
			= CLIScripts_UserInterrogationHelper
				::get_validated_input(
					'Please enter the name of the helper: ',
					new ObjectOrientation_HelperNameValidator()
				);
				
		ObjectOrientation_HelpersHelper
			::create_helper(
				$new_helper_name,
				$module_directory
			);
	}
}
?>