<?php
/**
 * CLIScripts_InterpreterProgramHelper
 *
 * @copyright 2008-05-29, RFI
 */

class
	CLIScripts_InterpreterProgramHelper
{
	public static function
		get_php_cli_interpreter()
	{
		return trim(`which php`);
	}
}
?>