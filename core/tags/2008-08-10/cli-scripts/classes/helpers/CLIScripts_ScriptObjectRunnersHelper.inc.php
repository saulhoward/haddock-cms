<?php
/**
 * CLIScripts_ScriptObjectRunnersHelper
 *
 * @copyright 2008-05-20, RFI
 */

class
	CLIScripts_ScriptObjectRunnersHelper
{
	public static function
		generate_script_object_runners()
	{
		$script_object_runners_directory
			= self
				::get_script_object_runners_directory();
		
		/*
		 * Create the new runners.
		 */
		$script_object_runners_directory->generate_script_object_runners();
	}
	
	public static function
		get_script_object_runners_directory()
	{
		$script_object_runners_directory_name
			= self
				::get_script_object_runners_directory_name();
		
		/*
		 * Make the directory, if it's not there already.
		 */
		if (
			!is_dir($script_object_runners_directory_name)
		) {
			mkdir($script_object_runners_directory_name);
		}
		
		/*
		 * Restrict access to the directory on the web server.
		 */
		$date = date('Y-m-d');

		/*
		 * Write the .htaccess file.
		 */
		$htaccess_file_name = "$script_object_runners_directory_name/.htaccess";
 
		$htaccess = <<<HTA
# Restrict Access to the bin folder.
# © $date

Order Deny,Allow
Deny from all

HTA;

		if ($fh = fopen($htaccess_file_name, 'w')) {
			fwrite($fh, $htaccess);
			
			fclose($fh);
		}
		
		return
			new CLIScripts_ScriptObjectRunnersDirectory(
				self
					::get_script_object_runners_directory_name()
			);
	}
	
	private static function
		get_script_object_runners_directory_name()
	{
		return PROJECT_ROOT . '/bin';
	}
}
?>