<?php
/**
 * PublicHTML_SetServerAddressCLIScript
 *
 * @copyright 2008-05-29, RFI
 */

class
	PublicHTML_SetServerAddressCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$server_address = $this->get_server_address();
		
		#$ph_cm = Configuration_ConfigManagerHelper
		#	::get_config_manager('haddock', 'public-html');
		#
		#$ph_cm->save_server_address($server_address, 'instance');
		
		PublicHTML_ServerAddressesHelper
			::set_server_address($server_address);
	}
	
	private function
		get_server_address()
	{
		if ($this->has_arg('server-address')) {
			return $this->get_arg('server-address');
		} else {
			return
				CLIScripts_UserInterrogationHelper
					::get_validated_input(
						'Please enter the server-address:' . PHP_EOL,
						new PublicHTML_ServerAddressValidator()
					);
		}
	}
}
?>