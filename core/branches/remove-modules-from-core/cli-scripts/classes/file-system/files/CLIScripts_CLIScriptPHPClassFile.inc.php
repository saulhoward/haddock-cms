<?php
/**
 * CLIScripts_CLIScriptPHPClassFile
 *
 * @copyright 2008-05-23, RFI
 */

/**
 * Represents the PHP file that contains the class definition
 * of a CLI script.
 */
class
	CLIScripts_CLIScriptPHPClassFile
extends
	FileSystem_PHPClassFile
{
	public function
		generate_script_object_runner()
	{
		#echo __METHOD__ . "\n";
		#echo '$this->get_name(): ' . "\n" . $this->get_name() . "\n";
		
		$script_object_runner_file
			= new CLIScripts_ScriptObjectRunnerFile(
				$this->get_script_object_runner_file_name()
			);
		
		$script_object_runner_file
			->set_cli_script_class_name(
				$this->get_php_class_name()
			);
		
		$script_object_runner_file->commit();
	}
	
	public function
		get_script_object_runner_file_name()
	{
		$script_object_runners_directory
			= CLIScripts_ScriptObjectRunnersHelper
				::get_script_object_runners_directory();
		
		return
			$script_object_runners_directory->get_name()
			. '/'
			. $this->get_php_class_name()
			. '.php';
	}
}
?>