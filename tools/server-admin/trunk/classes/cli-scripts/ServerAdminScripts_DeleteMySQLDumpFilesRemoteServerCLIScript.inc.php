<?php
/**
 * ServerAdminScripts_DeleteMySQLDumpFilesRemoteServerCLIScript
 *
 * @copyright 2008-06-30, RFI
 */

class
	ServerAdminScripts_DeleteMySQLDumpFilesRemoteServerCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::delete_remote_server(
				$this->get_remote_server()
			);
	}
	
	private function
		get_remote_server()
	{
		if ($this->has_arg('remote-server')) {
			return $this->get_arg('remote-server');
		} else {
			$remote_servers
				= ServerAdminScripts_MySQLDumpsDownloadingHelper
						::get_remote_servers();
			
			if (count($remote_servers) > 0) {
				echo 'Please choose the server address to delete:' . PHP_EOL;
				
				return
					CLIScripts_UserInterrogationHelper
						::get_choice_from_string_array(
							$remote_servers
						);
			}
		}
	}
}
?>