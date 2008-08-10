<?php
/**
 * FileSystem_CreateDirectoryClassCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	FileSystem_CreateDirectoryClassCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$module_directory
			= HaddockProjectOrganisation_ModuleDirectoriesHelper
				::get_module_directory_from_cli_choice();
		
		echo 'Creating a directory class for the ' . $module_directory->get_title() . ' module.' . PHP_EOL;
		
		$new_directory_class_name
			= CLIScripts_UserInterrogationHelper
				::get_validated_input(
					'Please enter the name of the directory class: ',
					new FileSystem_DirectoryClassNameValidator()
				);
				
		FileSystem_DirectoryClassesHelper
			::create_directory_class(
				$new_directory_class_name,
				$module_directory
			);
	}
}
?>