<?php
/**
 * HaddockProjectOrganisation_ModuleDirectoryHelper
 *
 * @copyright 2008-05-29, RFI
 */

class
	HaddockProjectOrganisation_ModuleDirectoryHelper
{
	public static function
		get_module_directory_of_object(
			$object
		)
	{
		$camel_case_module_root = ObjectOrientation_ModulesHelper
			::get_camel_case_module_root_of_object(
				$object
			);
		
		#echo "$camel_case_module_root\n"; exit;
		
		return
			self
				::get_module_directory_for_camel_case_root(
					$camel_case_module_root
				);
	}
	
	public static function
		get_module_directory_for_camel_case_root(
			$camel_case_module_root
		)
	{
		$project_directory
			= HaddockProjectOrganisation_ProjectDirectoryHelper
				::get_project_directory();
		
		foreach (
			$project_directory->get_module_directories()
			as
			$module_directory
		) {
			if (
				$module_directory->get_camel_case_root()
				==
				$camel_case_module_root
			) {
				return $module_directory;
			}
		}
		
		throw
			new ErrorHandling_SprintfException(
				'Unable to module directory for \'%s\'!',
				array(
					$camel_case_module_name
				)
			);
	}
}
?>