<?php
/**
 * UnitTests_CreateUnitTestsClassCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	UnitTests_CreateUnitTestsClassCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$module_directory
			= HaddockProjectOrganisation_ModuleDirectoriesHelper
				::get_module_directory_from_cli_choice();
		
		echo 'Creating a unit tests class for the ' . $module_directory->get_title() . ' module.' . PHP_EOL;
		
		$new_unit_tests_class_name
			= CLIScripts_UserInterrogationHelper
				::get_validated_input(
					'Please enter the name of the unit tests class: ',
					new UnitTests_UnitTestsClassNameValidator()
				);
				
		UnitTests_UnitTestsClassesHelper
			::create_unit_tests_class(
				$new_unit_tests_class_name,
				$module_directory
			);
	}
}
?>