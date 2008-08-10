<?php
/**
 * FileSystem_CreateFileClassCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	FileSystem_CreateFileClassCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$module_directory
			= HaddockProjectOrganisation_ModuleDirectoriesHelper
				::get_module_directory_from_cli_choice();
		
		echo 'Creating a file class for the ' . $module_directory->get_title() . ' module.' . PHP_EOL;
		
		$new_file_class_name
			= CLIScripts_UserInterrogationHelper
				::get_validated_input(
					'Please enter the name of the file class: ',
					new FileSystem_FileClassNameValidator()
				);
				
		FileSystem_FileClassesHelper
			::create_file_class(
				$new_file_class_name,
				$module_directory
			);
	}
}
?>