<?php
/**
 * InputValidation_Validator
 *
 * @copyright 2007-09-19, RFI
 */

abstract class
	InputValidation_Validator
{
	/**
	 * Should return TRUE or throw an InputValidation_InvalidInputException.
	 */
	public abstract function
		validate($string);
	
	protected function
		validate_pattern(
			$string,
			$regex,
			$exception_message
		)
	{
		if (!preg_match($regex, $string)) {
			throw new InputValidation_InvalidInputException(
				sprintf($exception_message, $string)
			);            
		}
		
		return TRUE;
	}
}
?>