<?php
/**
 * CLIScripts_ConfigManager
 *
 * @copyright 2008-05-15, RFI
 */

class
	CLIScripts_ConfigManager
extends
	Configuration_ConfigManager
{
	protected function
		get_module_prefix_string()
	{
		return '/haddock/cli-scripts/';
	}
	
	public function
		get_script_locked_exception_format_string()
	{
		return $this->get_config_value('exception_format_strings/script_locked');
	}
}
?>