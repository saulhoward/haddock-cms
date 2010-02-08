<?php
/**
 * HaddockProjectOrganisation_CreateHaddockClassNameValidatorCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	HaddockProjectOrganisation_CreateHaddockClassNameValidatorCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$module_directory
			= HaddockProjectOrganisation_ModuleDirectoriesHelper
				::get_module_directory_from_cli_choice();
		
		echo 'Creating an Haddock class name validator for the '
			. $module_directory->get_title() . ' module.' . PHP_EOL;
		
		$new_haddock_class_name_validator_name
			= CLIScripts_UserInterrogationHelper
				::get_validated_input(
					'Please enter the name of the Haddock class name validator: ',
					new HaddockProjectOrganisation_HaddockClassNameValidatorNameValidator()
				);
				
		HaddockProjectOrganisation_HaddockClassNameValidatorsHelper
			::create_haddock_class_name_validator(
				$new_haddock_class_name_validator_name,
				$module_directory
			);
	}
}
?>