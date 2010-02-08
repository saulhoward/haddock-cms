<?php
/**
 * HaddockProjectOrganisation_ProjectInformationSettingTests
 *
 * @copyright 2008-06-01, RFI
 */

class
	HaddockProjectOrganisation_ProjectInformationSettingTests
extends
	UnitTests_UnitTests
{
#	#private static function
#	#	back_up_project_config_file()
#	#{
#	#	$project_specific_config_file_name
#	#		= HaddockProjectOrganisation_ProjectInformationHelper
#	#			::get_project_specific_config_file_name();
#	#	
#	#	if (
#	#		file_exists($project_specific_config_file_name)
#	#	) {
#	#		rename(
#	#			$project_specific_config_file_name,
#	#			$project_specific_config_file_name . '_test_back_up'
#	#		);
#	#	}
#	#}
#	#
#	#private static function
#	#	restore_project_config_file()
#	#{
#	#	$project_specific_config_file_name
#	#		= HaddockProjectOrganisation_ProjectInformationHelper
#	#			::get_project_specific_config_file_name();
#	#	
#	#	if (
#	#		file_exists($project_specific_config_file_name . '_test_back_up')
#	#	) {
#	#		rename(
#	#			$project_specific_config_file_name . '_test_back_up',
#	#			$project_specific_config_file_name
#	#		);
#	#	}
#	#}
#	
##	private static function
#	public static function
#		set_up()
#	{
#		$project_information_directory_name = PROJECT_ROOT . '/project-specific/config/haddock-project-organisation';
#		foreach (
#			glob("$project_information_directory_name/*.txt")
#			as
#			$datum_file
#		) {
#			rename(
#				$datum_file,
#				$datum_file . '_bak'
#			);
#		}
#	}
#	
##	private static function
#	public static function
#		tear_down()
#	{
#		$project_information_directory_name = PROJECT_ROOT . '/project-specific/config/haddock-project-organisation';
#		
#		foreach (
#			glob("$project_information_directory_name/*.txt")
#			as
#			$test_file
#		) {
#			unlink($test_file);
#		}
#		
#		foreach (
#			glob("$project_information_directory_name/*.txt_bak")
#			as
#			$back_up_file
#		) {
#			$datum_file = trim($back_up_file, '_bak');
#			rename(
#				$back_up_file,
#				$datum_file
#			);
#		}
#	}
#	
#	/*
#	 * ----------------------------------------
#	 * Tests to do with the project name.
#	 * ----------------------------------------
#	 */
#
#	public static function
#		test_project_name_is_settable()
#	{
#		#self::back_up_project_config_file();
#		#self::set_up();
#		
#		$test_name = 'foo-bar';
#		HaddockProjectOrganisation_ProjectInformationHelper
#			::set_name($test_name);
#		
#		$test_result
#			= HaddockProjectOrganisation_ProjectInformationHelper
#				::get_name()
#			==
#			$test_name;
#			
#		#self::restore_project_config_file();
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	public static function
#		test_project_name_is_settable_at_the_command_line()
#	{
#		#self::back_up_project_config_file();
#		#self::set_up();
#		
#		$test_name = 'foo-bar';
#		
#		system(PROJECT_ROOT . '/bin/HaddockProjectOrganisation_SetProjectInformationCLIScript.php --datum-name="Name" --new-value=' . $test_name);
#		
#		$test_result
#			= HaddockProjectOrganisation_ProjectInformationHelper
#				::get_name()
#			==
#			$test_name;
#			
#		#self::restore_project_config_file();
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	public static function
#		test_project_name_is_not_settable_to_name_with_upper_case_letters()
#	{
#		#self::back_up_project_config_file();
#		#self::set_up();
#		
#		$test_name = 'Foo-Bar';
#		try {
#			HaddockProjectOrganisation_ProjectInformationHelper
#				::set_name($test_name);
#			$test_result = FALSE;
#		} catch (InputValidation_InvalidInputException $e) {
#			$test_result = TRUE;
#		}
#		
#		#self::restore_project_config_file();
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	public static function
#		test_project_name_is_not_settable_to_name_with_spaces()
#	{
#		#self::back_up_project_config_file();
#		#self::set_up();
#		
#		$test_name = 'foo bar';
#		try {
#			HaddockProjectOrganisation_ProjectInformationHelper
#				::set_name($test_name);
#			$test_result = FALSE;
#		} catch (InputValidation_InvalidInputException $e) {
#			$test_result = TRUE;
#		}
#		
#		#self::restore_project_config_file();
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	public static function
#		test_project_name_is_not_settable_to_name_with_underscores()
#	{
#		#self::back_up_project_config_file();
#		#self::set_up();
#		
#		$test_name = 'foo_bar';
#		try {
#			HaddockProjectOrganisation_ProjectInformationHelper
#				::set_name($test_name);
#			$test_result = FALSE;
#		} catch (InputValidation_InvalidInputException $e) {
#			$test_result = TRUE;
#		}
#		
#		#self::restore_project_config_file();
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	public static function
#		test_project_name_is_not_settable_to_zero_length_string()
#	{
#		#self::set_up();
#		
#		$test_name = '';
#		try {
#			HaddockProjectOrganisation_ProjectInformationHelper
#				::set_name($test_name);
#			$test_result = FALSE;
#		} catch (InputValidation_InvalidInputException $e) {
#			$test_result = TRUE;
#		}
#		
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	public static function
#		test_project_name_is_settable_to_name_with_numbers()
#	{
#		#self::back_up_project_config_file();
#		#self::set_up();
#		
#		$test_name = 'f0o-b4r';
#		HaddockProjectOrganisation_ProjectInformationHelper
#			::set_name($test_name);
#		
#		$test_result
#			= HaddockProjectOrganisation_ProjectInformationHelper
#				::get_name()
#			==
#			$test_name;
#			
#		#self::restore_project_config_file();
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	/*
#	 * ----------------------------------------
#	 * Tests to do with the project title.
#	 * ----------------------------------------
#	 */
#
#	public static function
#		test_project_title_is_settable()
#	{
#		#self::set_up();
#		
#		$test_title = 'Foo Bar';
#		HaddockProjectOrganisation_ProjectInformationHelper
#			::set_title($test_title);
#		
#		$test_result
#			= HaddockProjectOrganisation_ProjectInformationHelper
#				::get_title()
#			==
#			$test_title;
#			
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	public static function
#		test_project_title_is_settable_at_the_command_line()
#	{
#		#self::back_up_project_config_file();
#		#self::set_up();
#		
#		$test_title = 'Foo Bar';
#		
#		system(PROJECT_ROOT . '/bin/HaddockProjectOrganisation_SetProjectInformationCLIScript.php --datum-name="Title" --new-value="' . $test_title . '"');
#		
#		$test_result
#			= HaddockProjectOrganisation_ProjectInformationHelper
#				::get_title()
#			==
#			$test_title;
#			
#		#self::restore_project_config_file();
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	/*
#	 * ----------------------------------------
#	 * Tests to do with the project copyright holder.
#	 * ----------------------------------------
#	 */
#
#	public static function
#		test_project_copyright_holder_is_settable()
#	{
#		#self::set_up();
#		
#		$test_copyright_holder = 'Foo Bar';
#		HaddockProjectOrganisation_ProjectInformationHelper
#			::set_copyright_holder($test_copyright_holder);
#		
#		$test_result
#			= HaddockProjectOrganisation_ProjectInformationHelper
#				::get_copyright_holder()
#			==
#			$test_copyright_holder;
#			
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	public static function
#		test_project_copyright_holder_is_settable_at_the_command_line()
#	{
#		#self::set_up();
#		
#		$test_copyright_holder = 'Foo Bar';
#		
#		system(PROJECT_ROOT . '/bin/HaddockProjectOrganisation_SetProjectInformationCLIScript.php --datum-name="Copyright Holder" --new-value="' . $test_copyright_holder . '"');
#		
#		$test_result
#			= HaddockProjectOrganisation_ProjectInformationHelper
#				::get_copyright_holder()
#			==
#			$test_copyright_holder;
#			
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	/*
#	 * ----------------------------------------
#	 * Tests to do with the project version code.
#	 * ----------------------------------------
#	 */
#
#	public static function
#		test_project_version_code_is_settable()
#	{
#		#self::set_up();
#		
#		$test_version_code = '1.2.3';
#		HaddockProjectOrganisation_ProjectInformationHelper
#			::set_version_code($test_version_code);
#		
#		$test_result
#			= HaddockProjectOrganisation_ProjectInformationHelper
#				::get_version_code()
#			==
#			$test_version_code;
#			
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	public static function
#		test_project_version_code_is_settable_at_the_command_line()
#	{
#		#self::set_up();
#		
#		$test_version_code = 'Foo Bar';
#		
#		system(PROJECT_ROOT . '/bin/HaddockProjectOrganisation_SetProjectInformationCLIScript.php --datum-name="Version Code" --new-value="' . $test_version_code . '"');
#		
#		$test_result
#			= HaddockProjectOrganisation_ProjectInformationHelper
#				::get_version_code()
#			==
#			$test_version_code;
#			
#		#self::tear_down();
#		
#		return $test_result;
#	}
#	
#	/*
#	 * ----------------------------------------
#	 * Tests to do with the project camel case root.
#	 * ----------------------------------------
#	 */
#
#	public static function
#		test_project_camel_case_root_is_settable()
#	{
#		#self::set_up();
#		
#		$test_camel_case_root = 'FooBar';
#		HaddockProjectOrganisation_ProjectInformationHelper
#			::set_camel_case_root($test_camel_case_root);
#		
#		$test_result
#			= HaddockProjectOrganisation_ProjectInformationHelper
#				::get_camel_case_root()
#			==
#			$test_camel_case_root;
#			
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	public static function
#		test_project_camel_case_root_is_settable_at_the_command_line()
#	{
#		#self::set_up();
#		
#		$test_camel_case_root = 'FooBar';
#		
#		system(PROJECT_ROOT . '/bin/HaddockProjectOrganisation_SetProjectInformationCLIScript.php --datum-name="Camel Case Root" --new-value="' . $test_camel_case_root . '"');
#		
#		$test_result
#			= HaddockProjectOrganisation_ProjectInformationHelper
#				::get_camel_case_root()
#			==
#			$test_camel_case_root;
#			
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	public static function
#		test_project_camel_case_root_is_not_settable_with_spaces()
#	{
#		#self::set_up();
#		
#		$test_camel_case_root = 'Foo Bar';
#		try {
#			HaddockProjectOrganisation_ProjectInformationHelper
#				::set_camel_case_root($test_camel_case_root);
#			$test_result = FALSE;
#		} catch (InputValidation_InvalidInputException $e) {
#			$test_result = TRUE;
#		}
#		
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	public static function
#		test_project_camel_case_root_is_not_settable_with_underscores()
#	{
#		#self::set_up();
#		
#		$test_camel_case_root = 'Foo_Bar';
#		try {
#			HaddockProjectOrganisation_ProjectInformationHelper
#				::set_camel_case_root($test_camel_case_root);
#			$test_result = FALSE;
#		} catch (InputValidation_InvalidInputException $e) {
#			$test_result = TRUE;
#		}
#		
#		#self::tear_down();
#		
#		return $test_result;
#	}
#
#	public static function
#		test_project_camel_case_root_is_settable_with_numbers()
#	{
#		#self::set_up();
#		
#		$test_camel_case_root = 'F0oB4r';
#		HaddockProjectOrganisation_ProjectInformationHelper
#			::set_camel_case_root($test_camel_case_root);
#		
#		$test_result
#			= HaddockProjectOrganisation_ProjectInformationHelper
#				::get_camel_case_root()
#			==
#			$test_camel_case_root;
#			
#		#self::tear_down();
#		
#		return $test_result;
#	}
}
?>