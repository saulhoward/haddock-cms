<?php
/**
 * CLIScripts_ArgsHelper
 *
 * @copyright 2008-05-20, RFI
 */

/**
 * A collection of functions to help with CLI script arguments.
 */
class
	CLIScripts_ArgsHelper
{
	/**
	 * Parses the arguments from the command line.
	 *
	 * Arguments can be set as follows:
	 *
	 * 	php KishKash_BingBangBongCLIScript --foo-arg=123 --bar-arg
	 * 	
	 * Giving such arguments to a script and then passing argv to this function
	 * would result in an array with 'foo-arg' set to '123' and 'bar-arg' set to
	 * TRUE.
	 */
	public static function
		parse_argv(
			$argv
		)
	{
		$args = array();
		
		for ($i = 0; $i < count($argv); $i++) {
			if (
				preg_match(
					'/^--([\w-]+)(?:=(.+))?$/',
					$argv[$i],
					$matches
				)
			) {
				if (isset($matches[2])) {
					$args[$matches[1]] = $matches[2];
				} else {
					$args[$matches[1]] = TRUE;
				}
			}
		}
		
		return $args;
	}
}
?>
