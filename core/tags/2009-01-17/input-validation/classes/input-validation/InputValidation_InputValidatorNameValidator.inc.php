<?php
/**
 * InputValidation_InputValidatorNameValidator
 *
 * @copyright 2008-06-16, RFI
 */

class
	InputValidation_InputValidatorNameValidator
extends
	InputValidation_Validator
{
	public function
		validate($string)
	{
		$regex = '/^(:?[A-Z0-9][A-Za-z0-9]*)*$/';
		$exception_message = 'Input validator names must be upper camel case!';
		
		return
			$this->validate_pattern(
				$string,
				$regex,
				$exception_message
			);
	}
}
?>