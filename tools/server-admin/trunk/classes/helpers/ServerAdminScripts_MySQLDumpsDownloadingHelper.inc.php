<?php
/**
 * ServerAdminScripts_MySQLDumpsDownloadingHelper
 *
 * @copyright 2008-06-03, RFI
 */

class
	ServerAdminScripts_MySQLDumpsDownloadingHelper
{
	public static function
		get_mysql_dumps_downloading_remote_servers_file_name()
	{
		return
			Configuration_ConfigDirectoriesHelper
				::get_instance_specific_config_directory_for_project_name()
			. DIRECTORY_SEPARATOR
			. 'mysql-dumps-downloading-remote-servers.txt';
	}
	
	public static function
		get_remote_servers()
	{
		$remote_servers = array();
		
		$remote_servers_file_name
			= self
				::get_mysql_dumps_downloading_remote_servers_file_name();
		
		if (is_file($remote_servers_file_name)) {
			if ($fh = fopen($remote_servers_file_name, 'r')) {
				while (!feof($fh)) {
					$buffer = fgets($fh, 4096);
					$remote_server = trim($buffer);
					
					if (strlen($remote_server) > 0) {
						$remote_servers[] = $remote_server;
					}
				}
				
				#$remote_servers = array_unique($remote_servers);
				
				fclose($fh);
			}
		}
		
		return $remote_servers;
	}
	
	public static function
		add_new_remote_server($new_server)
	{
		$validator
			= new ServerAdminScripts_MySQLDumpsDownloadingRemoteServerValidator();
		
		if ($validator->validate($new_server)) {
			if (
				!in_array(
					$new_server,
					self
						::get_remote_servers()
				)
			) {
				Configuration_ConfigDirectoriesHelper
					::make_sure_instance_specific_config_directory_for_project_exists();
					
				$remote_servers_file_name
					= self
						::get_mysql_dumps_downloading_remote_servers_file_name();
				
				if ($fh = fopen($remote_servers_file_name, 'a')) {
					fwrite(
						$fh,
						$new_server . PHP_EOL
					);
					
					fclose($fh);
				}
			}
		}
	}
	
	public static function
		delete_all_remote_servers()
	{
		$remote_servers_file_name
			= self
				::get_mysql_dumps_downloading_remote_servers_file_name();
		
		file_exists($remote_servers_file_name)
			&& unlink($remote_servers_file_name);
	}
	
	public static function
		delete_remote_server($remote_server_to_delete)
	{
		$remote_servers = self::get_remote_servers();
		
		if (in_array($remote_server_to_delete, $remote_servers)) {
			self::delete_all_remote_servers();
			
			foreach ($remote_servers as $remote_server) {
				if ($remote_server != $remote_server_to_delete) {
					self::add_new_remote_server($remote_server);
				}
			}
		}
	}
}
?>