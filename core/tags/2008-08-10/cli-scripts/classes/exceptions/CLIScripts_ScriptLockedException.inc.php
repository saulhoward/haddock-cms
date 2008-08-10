<?php
/**
 * CLIScripts_ScriptLockedException
 *
 * @copyright 2008-05-15, RFI
 */

class
	CLIScripts_ScriptLockedException
extends
	ErrorHandling_SprintfException
{
	public function
        __construct(
			$locked_script_name
		)
	{
		$cs_cm
			= Configuration_ConfigManagerHelper
				::get_config_manager(
					'haddock',
					'cli-scripts'
				);
		
		parent::__construct(
			$cs_cm->get_script_locked_exception_format_string(),
			$locked_script_name
		);
	}
}
?>