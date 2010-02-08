<?php
/**
 * CLIScripts_ShowServerCLIScript
 *
 * @copyright 2008-05-23, RFI
 */

class
	CLIScripts_ShowServerCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		print_r($_SERVER);
		
//		/*
//		 * Require a user response before exiting.
//		 */
//		echo "Press \"ENTER\" to exit.\n";
//		$reply = trim(fgets(STDIN));
	}
}
?>