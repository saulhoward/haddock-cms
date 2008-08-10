<?php
/**
 * HaddockProjectOrganisation_ModuleNameTests
 *
 * @copyright 2008-06-02, RFI
 */

class
	HaddockProjectOrganisation_ModuleNameTests
extends
	UnitTests_UnitTests
{
	private static function
		check_that_method_returns_value_for_all_modules($anonymous_function)
	{
		$project_directory
			= HaddockProjectOrganisation_ProjectDirectoryHelper
				::get_project_directory();
		
		foreach (
			$project_directory->get_module_directories()
			as
			$module_directory
		) {
			$value
				= call_user_func(
					create_function(
						'$md',
						$anonymous_function
					),
					$module_directory
				);
			
			#echo $value . PHP_EOL; exit;
			
			if (!isset($value) || (strlen($value) < 1)) {
				return FALSE;
			}
		}
		
		return TRUE;
	}
	
	/*
	 * ----------------------------------------
	 * Tests to do with the identifying name.
	 * ----------------------------------------
	 */
	
	public static function
		test_all_modules_have_identifying_names()
	{
		return
			self
				::check_that_method_returns_value_for_all_modules(
					'return $md->get_identifying_name();'
				);
	}
	
	public static function
		test_identifying_names_for_all_modules_are_unique()
	{
		$identifying_names = array();
		
		$project_directory
			= HaddockProjectOrganisation_ProjectDirectoryHelper
				::get_project_directory();
		
		foreach (
			$project_directory->get_module_directories()
			as
			$module_directory
		) {
			$identifying_names[] = $module_directory->get_identifying_name();
		}
		
		return
			count($identifying_names)
			==
			count(
				array_unique($identifying_names)
			);
	}
	
	/*
	 * ----------------------------------------
	 * Tests to do with the camel case root.
	 * ----------------------------------------
	 */
	
	public static function
		test_all_modules_have_camel_case_roots()
	{
		return
			self
				::check_that_method_returns_value_for_all_modules(
					'return $md->get_camel_case_root();'
				);
	}
	
	/*
	 * ----------------------------------------
	 * Tests to do with the title.
	 * ----------------------------------------
	 */
	
	public static function
		test_all_modules_have_titles()
	{
		return
			self
				::check_that_method_returns_value_for_all_modules(
					'return $md->get_title();'
				);
	}
}
?>