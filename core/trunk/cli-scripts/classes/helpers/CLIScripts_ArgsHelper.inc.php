<?php
/**
 * CLIScripts_ArgsHelper
 *
 * @copyright 2008-05-20, RFI
 */

class
	CLIScripts_ArgsHelper
{
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