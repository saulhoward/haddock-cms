<?php
/**
 * ObjectOrientation_UpperCamelCaseValidator
 *
 * @copyright 2008-06-13, Robert Impey
 */

abstract class
	ObjectOrientation_UpperCamelCaseValidator
extends
	InputValidation_RegexValidator
{
	protected function
		get_regex()
	{
		return '/^(:?[A-Z0-9][A-Za-z0-9]*)+$/';
	}
}
?>