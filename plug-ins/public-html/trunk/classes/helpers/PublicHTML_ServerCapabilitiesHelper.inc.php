<?php
/**
 * PublicHTML_ServerCapabilitiesHelper
 *
 * @copyright 2008-05-07, RFI
 */

class
	PublicHTML_ServerCapabilitiesHelper
{
	public static function
		has_mod_rewrite()
	{
		if (function_exists('apache_get_modules')) {
			$modules = apache_get_modules();
			
			#echo __METHOD__ . "\n";
			#print_r($modules);
			
			return in_array(
				'mod_rewrite',
				$modules
			);
		}
		
		return FALSE;
	}
}
?>