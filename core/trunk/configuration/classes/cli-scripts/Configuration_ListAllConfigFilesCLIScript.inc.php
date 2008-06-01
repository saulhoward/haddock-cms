<?php
/**
 * Configuration_ListAllConfigFilesCLIScript
 *
 * @copyright 2008-05-30, RFI
 */

class
	Configuration_ListAllConfigFilesCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$config_files
			= Configuration_ConfigFilesHelper
				::get_all_config_files();
		
		#print_r($config_files);
		
		foreach (
			$config_files
			as
			$config_file
		) {
			echo $config_file->get_name() . PHP_EOL;
		}
	}
}
?>