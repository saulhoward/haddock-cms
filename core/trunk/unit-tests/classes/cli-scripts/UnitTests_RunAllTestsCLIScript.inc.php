<?php
/**
 * UnitTests_RunAllTestsCLIScript
 *
 * @copyright 2008-05-24, RFI
 */

class
	UnitTests_RunAllTestsCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$test_results_set
			= UnitTests_TestsHelper
				::run_all_tests();
		
		#print_r($test_results_set);
		
		$test_results_summary
			= $test_results_set->get_summary();
		
		#print_r($test_results_summary);
		
		echo 'Test Results Summary' . PHP_EOL;
		echo PHP_EOL;
		
		$padding_chars = -25;
		printf(
			'%' . $padding_chars . 's: %d' . PHP_EOL,
			'Total passed test',
			$test_results_summary['total_passed_tests']
		);
		printf(
			'%' . $padding_chars . 's: %d' . PHP_EOL,
			'Total test functions',
			$test_results_summary['total_test_functions']
		);
		printf(
			'%' . $padding_chars . 's: %s' . PHP_EOL,
			'All tests passed',
			$test_results_summary['all_tests_passed'] ? 'Yes' : 'No'
		);
		printf(
			'%' . $padding_chars . 's: %.3f s' . PHP_EOL,
			'Total test time',
			$test_results_summary['total_test_time']
		);
		echo PHP_EOL;
		
		/*
		 * Print off the test results.
		 */
		
		$test_results = $test_results_set->get_test_results();
		
		#print_r($test_results);
		
		echo 'Test Results' . PHP_EOL;
		echo PHP_EOL;
		
		/*
		 * Preformat some of the columns data.
		 */
		for (
			$i = 0;
			$i < count($test_results);
			$i++
		) {
			$test_results[$i]['passes_all_tests']
				= $test_results[$i]['passes_all_tests'] ? 'Yes' : 'No';
				
			$test_results[$i]['total_test_time']
				= sprintf(
					'%.3f',
					$test_results[$i]['total_test_time']
				);
		}
		
		CLIScripts_DataRenderingHelper
			::render_array_of_assocs_in_table(
				$test_results,
				array(
					'total_test_time' => 'Total Test Time (s)'
				)
			);
		
		#$titles = array(
		#	'test_name' => 'Test Name',
		#	'passed_tests_count' => 'Passed Tests Count',
		#	'test_functions_count' => 'Test Functions Count',
		#	'passes_all_tests' => 'Passes All Tests',
		#	'total_test_time' => 'Total Test Time (s)'
		#);
		#
		#$title_str = sprintf(
		#	'%-40s | %5s | %5s | %5s | %3s',
		#	'Test Name',
		#	'Passed Tests Count',
		#	'Test Functions Count',
		#	'Passes All Tests',
		#	'Total Test Time (s)'
		#);
		#
		#$hr = str_repeat(
		#		'-',
		#		strlen($title_str)
		#	);
		#
		#$title_str = "|$title_str|" . PHP_EOL;
		#
		#$hr = "|$hr|" . PHP_EOL;
		#
		#echo $hr;
		#
		#echo $title_str;
		#
		#echo $hr;
		#
		#foreach (
		#	$test_results
		#	as
		#	$test_result
		#) {
		#	printf(
		#		'|%-40s%5d%5d%5s  %.3f|',
		#		$test_result['test_name'],
		#		$test_result['passed_tests_count'],
		#		$test_result['test_functions_count'],
		#		$test_result['passes_all_tests'] ? 'Yes' : 'No',
		#		$test_result['total_test_time']
		#	);
		#	echo PHP_EOL;
		#}
		#
		#echo $hr;
	}
}
?>