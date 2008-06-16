<?php
/**
 * HaddockProjectOrganisation_ModuleDirectoriesHelper
 *
 * @copyright 2008-06-12, RFI
 */

class
	HaddockProjectOrganisation_ModuleDirectoriesHelper
{
	public static function
		get_all_module_directories()
	{
		$project_directory
			= HaddockProjectOrganisation_ProjectDirectoryHelper
				::get_project_directory();
		
		return $project_directory->get_module_directories();
	}
	
	public static function
		get_module_directory_from_cli_choice()
	{
		$module_directories = self::get_all_module_directories();
		
		usort(
			$module_directories,
			create_function(
				'$a, $b',
				'return strcmp($a->get_identifying_name(), $b->get_identifying_name());'
			)
		);
		
		$mds = array();
		$first = TRUE;
		foreach (
			$module_directories
			as
			$module_directory
		) {
			$name = $module_directory->get_identifying_name();
			
			$mds[$name] = $module_directory;
		}
		
		$chosen_module_name
			= CLIScripts_UserInterrogationHelper
				::get_choice_from_string_array(array_keys($mds));
		
		return $mds[$chosen_module_name];
	}
}
?>