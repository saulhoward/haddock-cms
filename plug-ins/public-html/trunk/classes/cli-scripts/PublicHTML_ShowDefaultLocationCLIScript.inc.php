<?php
/**
 * PublicHTML_ShowDefaultLocationCLIScript
 *
 * @copyright 2008-12-16, Robert Impey
 */

class
	PublicHTML_ShowDefaultLocationCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		echo PublicHTML_DefaultLocationHelper
			::get_default_location();
		echo PHP_EOL;
	}
}
?>
