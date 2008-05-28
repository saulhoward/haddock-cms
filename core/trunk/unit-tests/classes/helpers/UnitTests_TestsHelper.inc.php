<?php
/**
 * UnitTests_TestsHelper
 *
 * @copyright 2008-05-24, RFI
 */

class
	UnitTests_TestsHelper
{
	/**
	 * Runs all the tests in the project and returns an assoc
	 * with data about the test results.
	 *
	 * @return UnitTests_TestResultsSet The test results set.
	 */
	public static function
		run_all_tests()
	{
		#$test_results = array();
		$test_results_set = new UnitTests_TestResultsSet();
		
		$unit_tests_php_class_files
			= self
				::get_all_unit_tests_php_class_files();
		
		foreach (
			$unit_tests_php_class_files
			as
			$unit_tests_php_class_file
		) {
			#$test_result = array();
			
			#$test_result['test_name']
			#	= $unit_tests_php_class_file->get_test_name();
			#
			#$test_result['passed_tests_count']
			#	= $unit_tests_php_class_file->count_passed_tests();
			#
			#$test_result['test_functions_count']
			#	= $unit_tests_php_class_file->count_test_functions();
			#
			#$test_result['passes_all_tests']
			#	= $unit_tests_php_class_file->passes_all_tests();
			#
			#$test_result['total_test_time']
			#	= $unit_tests_php_class_file->get_total_test_time();
			
			#$test_results[] = $test_result;
			
			$test_results
				= $unit_tests_php_class_file
					->run_all_tests();
			
			foreach ($test_results as $test_result) {
				$test_results_set->add_test_result($test_result);
			}
		}
		
		#return $test_results;
		return $test_results_set;
	}
	
	public static function
		get_all_unit_tests_php_class_files()
	{
		$project_directory_finder
			= HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
		
		$project_directory
			= $project_directory_finder->get_project_directory_for_this_project();
		
		return
			$project_directory
				->get_all_unit_tests_php_class_files();
	}
}
?>