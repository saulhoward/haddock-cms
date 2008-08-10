<?php
/**
 * CLIScripts_CLIScriptFilesHelper
 *
 * @copyright 2008-05-23, RFI
 */

class
	CLIScripts_CLIScriptFilesHelper
{
	public static function
		get_cli_script_class_files()
	{
		/*
		 * Get a list of all the non-abstract subclasses of
		 * 'CLIScripts_CLIScript' for the whole project.
		 */
		
		$project_directory_finder
			= HaddockProjectOrganisation_ProjectDirectoryFinder
				::get_instance();
		$project_directory
			= $project_directory_finder->get_project_directory_for_this_project();
		
		$cli_script_subclasses_files
			= $project_directory
				->get_php_subclass_files(
					'CLIScripts_CLIScript',
					$include_parent_class = FALSE,
					$include_abstract_classes = FALSE	
				);
		
		return
			array_map(
				array(
					'CLIScripts_CLIScriptFilesHelper',
					'convert_php_class_file_to_cli_script_php_class_file'
				),
				$cli_script_subclasses_files
			);
	}
	
	public static function
		convert_php_class_file_to_cli_script_php_class_file(
			FileSystem_PHPClassFile $php_class_file
		)
	{
		return new CLIScripts_CLIScriptPHPClassFile(
			$php_class_file->get_name()
		);
	}
}
?>