<?php
/**
 * ServerAdminScripts_DeleteAllMySQLDumpFilesRemoteServersCLIScript
 *
 * @copyright 2008-06-30, RFI
 */

class
	ServerAdminScripts_DeleteAllMySQLDumpFilesRemoteServersCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::delete_all_remote_servers();
	}
}
?>