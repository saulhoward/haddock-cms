<?php
/**
 * PublicHTML_ShowServerAddressCLIScript
 *
 * @copyright 2008-05-30, RFI
 */

class
	PublicHTML_ShowServerAddressCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		echo PublicHTML_ServerAddressesHelper
			::get_server_address();
		echo PHP_EOL;
	}
}
?>