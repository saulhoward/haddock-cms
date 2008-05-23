<?php
/**
 * CLIScripts_ScriptObjectRunnersDirectory
 *
 * @copyright 2008-05-20, RFI
 */

class
	CLIScripts_ScriptObjectRunnersDirectory
extends
	FileSystem_Directory
{
	public function
		generate_script_object_runners()
	{
		/*
		 * Get rid of the old files.
		 */
		$this->delete_files();
		
		/*
		 * Get all files for the non-abstract subclasses of 'CLIScripts_CLIScript'.
		 */
		$cli_script_class_files
			= CLIScripts_CLIScriptFilesHelper
				::get_cli_script_class_files();
		#print_r($cli_script_class_files); exit;
		
		array_walk(
			$cli_script_class_files,
			create_function(
				'$cli_script_class_file',
				'$cli_script_class_file->generate_script_object_runner();'
			)
		);
	}
}
?>