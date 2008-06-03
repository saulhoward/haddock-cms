<?php
/**
 * ServerAdminScripts_AddMySQLDumpFilesRemoteServerCLIScript
 *
 * @copyright 2008-06-30, RFI
 */

class
	ServerAdminScripts_AddMySQLDumpFilesRemoteServerCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::add_new_remote_server(
				$this->get_remote_server()
			);
	}
	
	private function
		get_remote_server()
	{
		if ($this->has_arg('remote-server')) {
			return $this->get_arg('remote-server');
		} else {
			echo 'Please enter the new server address:' . PHP_EOL;
			
			return trim(fgets(STDIN));
		}
	}
}
?>