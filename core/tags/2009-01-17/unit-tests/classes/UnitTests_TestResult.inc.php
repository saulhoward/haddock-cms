<?php
/**
 * UnitTests_TestResult
 *
 * @copyright 2008-05-28, RFI
 */

class
	UnitTests_TestResult
{
	private $class_name;
	private $function_name;
	private $passes;
	private $time;

	public function 
		__construct(
			$class_name,
			$function_name,
			$passes,
			$time
		)
	{
		$this->class_name = $class_name;
		$this->function_name = $function_name;
		$this->passes = $passes;
		$this->time = $time;
	}

	public function 
		get_class_name()
	{
		return $this->class_name;
	}

	public function 
		set_class_name($class_name)
	{
		$this->class_name = $class_name;
	}

	public function 
		get_function_name()
	{
		return $this->function_name;
	}

	public function 
		set_function_name($function_name)
	{
		$this->function_name = $function_name;
	}

	public function 
		get_passes()
	{
		return $this->passes;
	}

	public function 
		set_passes($passes)
	{
		$this->passes = $passes;
	}

	public function 
		get_time()
	{
		return $this->time;
	}

	public function 
		set_time($time)
	{
		$this->time = $time;
	}
}
?>