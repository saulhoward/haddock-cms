<?php
/**
 * CodeAnalysis_TurnOnDebugModeCLIScript
 *
 * @copyright 2009-10-07, Robert Impey
 */

class
	CodeAnalysis_TurnOnDebugModeCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		CodeAnalysis_DebugModeHelper::turn_on_debug_mode();
	}
}
?>