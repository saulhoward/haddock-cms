<?php
/**
 * CLIScripts_NewScriptNameValidator
 *
 * @copyright 2008-06-16, RFI
 */

class
	CLIScripts_NewScriptNameValidator
extends
	ObjectOrientation_UpperCamelCaseValidator
{
	protected function
		get_exception_message()
	{
		return 'CLI script names must be upper camel case!';
	}
}
?>