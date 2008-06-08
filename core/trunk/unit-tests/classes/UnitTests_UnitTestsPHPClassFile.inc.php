<?php
/**
 * UnitTests_UnitTestsPHPClassFile
 *
 * @copyright 2007-03-21, RFI
 */

class
	UnitTests_UnitTestsPHPClassFile
extends
	FileSystem_PHPClassFile
{
	private $test_function_names;
	private $test_times;
	
	public function
		get_test_function_names()
	{
		if (!isset($this->test_function_names)) {
			$reflection_class = $this->get_reflection_class();
			
			$relection_methods = $reflection_class->getMethods();
			
			$this->test_function_names = array();
			
			foreach ($relection_methods as $reflection_method) {
				if (preg_match('/^test_/', $reflection_method->getName())) {
					$this->test_function_names[]
						= $reflection_method->getName();
				}
			}
		}
		
		return $this->test_function_names;
	}
	
	public function
		count_test_functions()
	{
		$test_function_names = $this->get_test_function_names();
		
		return count($test_function_names);
	}
	
	public function
		count_passed_tests()
	{
		#$reflection_class = $this->get_reflection_class();
		#$class = $reflection_class->newInstance();
		
		$passed_tests = 0;
		
		foreach ($this->get_test_function_names() as $t_f_n) {
			$start = microtime(TRUE);
			
			$call_back = array(
				$this->get_php_class_name(),
				$t_f_n
			);
			
			#print_r($call_back);
			
			#$passes = $t_f_m->invoke($class);
			$passes = call_user_func(
				$call_back
			);
			
			$finish = microtime(TRUE);
			
			$this->test_times[$t_f_n] = $finish - $start;
			
			if ($passes) {
				$passed_tests++;
			}
		}
		
		return $passed_tests;
	}
	
	public function
		passes_all_tests()
	{
		return
			$this->count_test_functions()
			==
			$this->count_passed_tests();
	}
	
	public function
		get_total_test_time()
	{
		if (isset($this->test_times)) {
			$total_test_time = 0;
			
			foreach ($this->test_times as $t_t) {
				$total_test_time += $t_t;
			}
			
			return $total_test_time;
		} else {
			throw new Exception('Total test times requested before the tests have been run!');
		}
	}
	
	public function
		get_test_name()
	{
		return $this->get_php_class_name();
	}
	
	/**
	 * Runs all the tests contained in this file and returns
	 * an array of <code>UnitTests_TestResult</code> objects containing
	 * the data about which tests passed and times.
	 *
	 * @return UnitTests_TestResult Data about the tests.
	 */
	public function
		run_all_tests()
	{
		$test_results = array();
		
		$test_function_names
			= $this->get_test_function_names();
		
		foreach ($test_function_names as $test_function_name) {
			echo $this->get_php_class_name() . '::' . $test_function_name . PHP_EOL;
			/*
			 * Is there a set_up function?
			 */
			
			$reflection_class = $this->get_reflection_class();
			
			if ($reflection_class->hasMethod('set_up')) {
				call_user_func(
					array(
						$this->get_php_class_name(),
						'set_up'
					)
				);
			}
			
			$start = microtime(TRUE);
			
			$call_back = array(
				$this->get_php_class_name(),
				$test_function_name
			);
			
			#print_r($call_back);
			
			$passes = call_user_func(
				$call_back
			);
			
			$finish = microtime(TRUE);
			
			if ($reflection_class->hasMethod('tear_down')) {
				call_user_func(
					array(
						$this->get_php_class_name(),
						'tear_down'
					)
				);
			}
			
			$time = $finish - $start;
			
			$test_results[]
				= new UnitTests_TestResult(
					$this->get_php_class_name(),
					$test_function_name,
					$passes,
					$time
				);
		}
		
		return $test_results;
	}
}
?>
