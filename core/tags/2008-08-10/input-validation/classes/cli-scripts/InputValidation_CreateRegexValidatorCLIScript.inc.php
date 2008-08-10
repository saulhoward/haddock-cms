<?php
/**
 * InputValidation_CreateRegexValidatorCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	InputValidation_CreateRegexValidatorCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$module_directory
			= HaddockProjectOrganisation_ModuleDirectoriesHelper
				::get_module_directory_from_cli_choice();
		
		echo 'Creating a regex validator for the ' . $module_directory->get_title() . ' module.' . PHP_EOL;
		
		$new_regex_validator_name
			= CLIScripts_UserInterrogationHelper
				::get_validated_input(
					'Please enter the name of the regex validator: ',
					new InputValidation_InputValidatorNameValidator()
				);
				
		InputValidation_InputValidatorsHelper
			::create_regex_validator(
				$new_regex_validator_name,
				$module_directory
			);
	}
}
?>