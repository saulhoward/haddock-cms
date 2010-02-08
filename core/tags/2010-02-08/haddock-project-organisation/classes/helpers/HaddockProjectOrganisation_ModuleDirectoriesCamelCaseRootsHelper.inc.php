<?php
/**
 * HaddockProjectOrganisation_ModuleDirectoriesCamelCaseRootsHelper
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	HaddockProjectOrganisation_ModuleDirectoriesCamelCaseRootsHelper
{
	public static function
		get_camel_case_root(
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$camel_case_root_file_name
			= self
				::get_camel_case_root_file_name(
					$module_directory
				);
				
		if (is_file($camel_case_root_file_name)) {
			return trim(file_get_contents($camel_case_root_file_name));
		}
		
		if ($module_directory->has_module_config_file()) {
			$module_config_file = $module_directory->get_module_config_file();
			
			if ($module_config_file->has_camel_case_root()) {
				return $module_config_file->get_camel_case_root();
			}
		}

		$name_as_l_o_w = $module_directory->get_module_name_as_l_o_w();

		return $name_as_l_o_w->get_words_as_camel_case_string();
	}
	
	public static function
		set_camel_case_root(
			$camel_case_root,
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$validator = new HaddockProjectOrganisation_ModuleDirectoryCamelCaseRootValidator();
		
		if ($validator->validate($camel_case_root)) {
			$module_directory->make_sure_config_directory_exists();
			
			$config_directory_name = $module_directory->get_config_directory_name();
			
			$haddock_project_organisation_config_directory_name
				= $config_directory_name
					. DIRECTORY_SEPARATOR . 'haddock-project-organisation';
			
			if (!is_dir($haddock_project_organisation_config_directory_name)) {
				FileSystem_DirectoryHelper
					::mkdir_parents(
						$haddock_project_organisation_config_directory_name
					);
			}
			
			$camel_case_root_file_name
				= self::get_camel_case_root_file_name($module_directory);
			
			if ($fh = fopen($camel_case_root_file_name, 'w')) {
				fwrite(
					$fh,
					$camel_case_root . PHP_EOL
				);
				
				fclose($fh);
			}
		}
	}
	
	private static function
		get_camel_case_root_file_name(
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$config_directory_name = $module_directory->get_config_directory_name();
		
		$haddock_project_organisation_config_directory_name
			= $config_directory_name
				. DIRECTORY_SEPARATOR . 'haddock-project-organisation';
		
		#if (!is_dir($haddock_project_organisation_config_directory_name)) {
		#	FileSystem_DirectoryHelper
		#		::mkdir_parents(
		#			$haddock_project_organisation_config_directory_name
		#		);
		#}
		
		$camel_case_root_file_name
			= $haddock_project_organisation_config_directory_name
				. DIRECTORY_SEPARATOR . 'camel-case-root.txt';
		
		return $camel_case_root_file_name;
	}
}
?>