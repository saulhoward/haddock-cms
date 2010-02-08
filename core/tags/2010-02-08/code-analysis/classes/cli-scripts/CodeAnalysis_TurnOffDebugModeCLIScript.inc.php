<?php
/**
 * CodeAnalysis_TurnOffDebugModeCLIScript
 *
 * @copyright 2009-10-07, Robert Impey
 */

class
	CodeAnalysis_TurnOffDebugModeCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		CodeAnalysis_DebugModeHelper::turn_off_debug_mode();
	}
}
?>