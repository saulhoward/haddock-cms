<?php
/**
 * Configuration_ConfigFilesHelper
 *
 * @copyright 2008-05-30, RFI
 */

class
	Configuration_ConfigFilesHelper
{
	public static function
		get_all_config_files()
	{
		$all_config_files = array();
		
		$project_directory
			= HaddockProjectOrganisation_ProjectDirectoryHelper
				::get_project_directory();
		
		/*
		 * Get the config files in the module directories.
		 */
		foreach (
			$project_directory
				->get_module_directories()
			as
			$module_directory
		) {
			if (
				$module_directory
					->has_config_directory()
			) {
				$config_directory
					= $module_directory
						->get_config_directory();
				
				$all_config_files = array_merge(
					$all_config_files,
					$config_directory
						->get_all_config_files()
				);
			}
		}
		
		/*
		 * Get the config files that are specific to this
		 * instance of the project.
		 */
		$instance_specific_config_directory
			= Configuration_ConfigDirectoriesHelper
				::get_instance_specific_config_directory();
		
		$all_config_files = array_merge(
			$all_config_files,
			$instance_specific_config_directory
				->get_all_config_files()
		);
		
		#usort(
		#	$all_config_files,
		#	create_function(
		#		'$a, $b',
		#		'strcmp($a->get_name(), $b->get_name());'
		#	)
		#);
		
		return $all_config_files;
	}
}
?>