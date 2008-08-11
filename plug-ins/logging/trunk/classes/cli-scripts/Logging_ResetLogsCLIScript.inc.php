<?php
/**
 * Logging_ResetLogsCLIScript
 *
 * @copyright 2008-08-11, Robert Impey
 */

class
	Logging_ResetLogsCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		Logging_LogsHelper::reset_logs();
	}
}
?>