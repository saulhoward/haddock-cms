<?php
/**
 * ServerAdminScripts_ListServersFromWhichToDownloadMySQLDumpFilesCLIScript
 *
 * @copyright 2008-06-03, RFI
 */

class
	ServerAdminScripts_ListServersFromWhichToDownloadMySQLDumpFilesCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		foreach (
			ServerAdminScripts_MySQLDumpsDownloadingHelper
				::get_remote_servers()
			as
			$remote_server
		) {
			echo $remote_server . PHP_EOL;
		}
	}
}
?>