<?php
/**
 * InputValidation_RegexValidator
 *
 * @copyright 2008-06-13, Robert Impey
 */

abstract class
	InputValidation_RegexValidator
extends
	InputValidation_Validator
{
	public function
		validate($string)
	{
		return
			$this->validate_pattern(
				$string,
				$this->get_regex(),
				$this->get_exception_message()
			);
	}
	
	abstract protected function
		get_regex();
	
	abstract protected function
		get_exception_message();
}
?>