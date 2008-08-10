<?php
/**
 * HaddockProjectOrganisation_ProjectTitleInferenceTests
 *
 * @copyright 2008-06-02, RFI
 */

class
	HaddockProjectOrganisation_ProjectTitleInferenceTests
extends
	UnitTests_UnitTests
{
	private static function
		get_title_file_name()
	{
		return
			PROJECT_ROOT
			. '/project-specific/config/haddock-project-organisation/title.txt';
	}
	
	private static function
		get_title_back_up_file_name()
	{
		return self::get_title_file_name() . '_bak';
	}
	
	public static function
		set_up()
	{
		if (
			file_exists(self::get_title_file_name())
		) {
			rename(
				self::get_title_file_name(),
				self::get_title_back_up_file_name()
			);
		}
	}
	
	public static function
		tear_down()
	{
		if (
			file_exists(self::get_title_back_up_file_name())
		) {
			rename(
				self::get_title_back_up_file_name(),
				self::get_title_file_name()
			);
		}
	}
	
	/*
	 * ----------------------------------------
	 * The tests.
	 * ----------------------------------------
	 */
	
	public static function
		test_project_title_can_be_worked_out_from_the_project_name()
	{
		self::set_up();
		
		$title
			= HaddockProjectOrganisation_ProjectInformationHelper
				::get_title();
		
		$test_result = isset($title) && strlen($title) > 0;
		
		if (file_exists($title_back_up_file_name)) {
			rename(
				$title_back_up_file_name,
				$title_file_name
			);
		}
		
		self::tear_down();
		
		return $test_result;
	}
}
?>