<?php
/**
 * InputValidation_CreateInputValidatorCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	InputValidation_CreateInputValidatorCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$module_directory
			= HaddockProjectOrganisation_ModuleDirectoriesHelper
				::get_module_directory_from_cli_choice();
		
		echo 'Creating an input validator for the ' . $module_directory->get_title() . ' module.' . PHP_EOL;
		
		$new_input_validator_name
			= CLIScripts_UserInterrogationHelper
				::get_validated_input(
					'Please enter the name of the input validator: ',
					new InputValidation_InputValidatorNameValidator()
				);
				
		InputValidation_InputValidatorsHelper
			::create_input_validator(
				$new_input_validator_name,
				$module_directory
			);
	}
}
?>