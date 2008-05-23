<?php
/**
 * HaddockProjectOrganisation_AutoloadHelper
 *
 * @copyright 2008-05-23, RFI
 */

class
	HaddockProjectOrganisation_AutoloadHelper
{
	/**
	 * Defines an __autoload function if one hasn't already been set.
	 *
	 * This function runs much more slowly than the function that might be
	 * defined in the autoload.inc.php file in the project specific directory
	 * but does not depend on any other files, so it can act as a back up
	 * until the autoload file has been generated.
	 */
	public static function
		conditionally_define_default_autoload_function()
	{
		if (function_exists('__autoload')) {
			/*
			 * Nothing to do!
			 */
		} else {
			self::define_default_autoload_function();
		}
	}
	
	public static function
		define_default_autoload_function()
	{
	}
}
?>