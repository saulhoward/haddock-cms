<?php
/**
 * CLIScripts_GenerateScriptObjectRunnersCLIScript
 *
 * @copyright 2008-05-20, RFI
 */

class
	CLIScripts_GenerateScriptObjectRunnersCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		CLIScripts_ScriptObjectRunnersHelper
			::generate_script_object_runners();
	}
}
?>