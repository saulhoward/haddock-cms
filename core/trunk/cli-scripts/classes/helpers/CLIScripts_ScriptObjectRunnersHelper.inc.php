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
		
		if (
			!is_dir($script_object_runners_directory_name)
		) {
			mkdir($script_object_runners_directory_name);
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