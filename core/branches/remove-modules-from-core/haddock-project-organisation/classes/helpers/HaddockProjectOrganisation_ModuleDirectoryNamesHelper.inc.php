<?php
/**
 * HaddockProjectOrganisation_ModuleDirectoryNamesHelper
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	HaddockProjectOrganisation_ModuleDirectoryNamesHelper
{
	public static function
		get_module_name(
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		/*
		 * Does the module have name file?
		 */
		$name_file_name
			= self
				::get_name_file_name(
					$module_directory
				);
				
		if (is_file($name_file_name)) {
			return trim(file_get_contents($name_file_name));
		}
		
		/*
		 * Does this module have a module config file?
		 */
		if ($module_directory->has_module_config_file()) {
			
			$module_config_file = $module_directory->get_module_config_file();
			
			if ($module_config_file->has_module_name()) {
				return $module_config_file->get_module_name();
			}
		}
		
		/*
		 * There isn't a module name set in the file,
		 * so we should work out the name algorithmically.
		 */
		if (preg_match('{([^\\\\/]+)$}', $module_directory->get_name(), $matches)) {
			$c_c_m_n_l_o_ws
				= Formatting_ListOfWordsHelper
					::get_list_of_words_for_string($matches[1], '-');
					
			return $c_c_m_n_l_o_ws->get_words_as_capitalised_string();
		}
		
		return '';
	}
	
		
	private static function
		get_name_file_name(
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$config_directory_name = $module_directory->get_config_directory_name();
		
		$haddock_project_organisation_config_directory_name
			= $config_directory_name
				. DIRECTORY_SEPARATOR . 'haddock-project-organisation';
		
		$name_file_name
			= $haddock_project_organisation_config_directory_name
				. DIRECTORY_SEPARATOR . 'name.txt';
		
		return $name_file_name;
	}
}
?>