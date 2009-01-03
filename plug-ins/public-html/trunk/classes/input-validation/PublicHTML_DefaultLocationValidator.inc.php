<?php
/**
 * PublicHTML_DefaultLocationValidator
 *
 * @copyright 2008-12-16, Robert Impey
 */

class
	PublicHTML_DefaultLocationValidator
extends
	InputValidation_RegexValidator
{
	protected function
		get_regex()
	{
		/*
		 * Write the regex here.
		 */
		return '/^[\/\?#&\w]+$/';
	}
	
	protected function
		get_exception_message()
	{
		/*
		 * Write a more informative exception message here.
		 */
		return 'Please set a valid default location!';
	}
}
?>
