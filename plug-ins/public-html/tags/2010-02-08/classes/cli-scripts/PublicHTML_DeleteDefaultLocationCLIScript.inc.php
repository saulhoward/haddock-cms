<?php
/**
 * PublicHTML_DeleteDefaultLocationCLIScript
 *
 * @copyright 2008-12-16, Robert Impey
 */

class
	PublicHTML_DeleteDefaultLocationCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		PublicHTML_DefaultLocationHelper::delete_default_location();
	}
}
?>
