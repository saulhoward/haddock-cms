<?php
/**
 * UnitTests_TestResultsSet
 *
 * @copyright 2008-05-27, RFI
 */

/**
 * A wrapper around an array of assocs with data about
 * which tests passed and which ones failed.
 */
class
	UnitTests_TestResultsSet
{
	private $test_results;
	
	public function
		__construct()
	{
		$this->test_results = array();
	}
	
	public function
		get_test_results()
	{
		return $this->test_results;
	}
	
	public function
		add_test_result(
			$test_result
		)
	{
		$this->test_results[] = $test_result;
	}
	
	public function
		get_summary()
	{
		$summary = array();
		
		$summary['total_passed_tests'] = 0;
		$summary['total_test_functions'] = 0;
		$summary['all_tests_passed'] = TRUE;
		$summary['total_test_time'] = 0.0;
		
		foreach (
			$this->get_test_results()
			as
			$test_result
		) {
			$summary['total_passed_tests']
				+= $test_result['passed_tests_count'];
			$summary['total_test_functions']
				+= $test_result['test_functions_count'];
			$summary['all_tests_passed']
				= $summary['all_tests_passed'] && $test_result['passes_all_tests'];
			$summary['total_test_time']
				+= $test_result['total_test_time'];
		}
		
		return $summary;
	}
}
?>