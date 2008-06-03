<?php
/**
 * ServerAdminScripts_MySQLDumpsDownloadingTests
 *
 * @copyright 2008-06-03, RFI
 */

class
	ServerAdminScripts_MySQLDumpsDownloadingTests
extends
	UnitTests_UnitTests
{
	private static function
		get_remote_servers_file_name()
	{
		#return PROJECT_ROOT . '/config/server-admin-scripts/remote-servers.txt';
		return
			ServerAdminScripts_MySQLDumpsDownloadingHelper
				::get_mysql_dumps_downloading_remote_servers_file_name();
	}
	
	private static function
		get_remote_servers_file_back_up_file_name()
	{
		return self::get_remote_servers_file_name() . '_bak';
	}
	
	public static function
		set_up()
	{		
		$remote_servers_file_name
			= self::get_remote_servers_file_name();
		
		file_exists($remote_servers_file_name)
			&& rename(
				$remote_servers_file_name,
				self::get_remote_servers_file_back_up_file_name()
			);
	}
	
	public static function
		tear_down()
	{
		$remote_servers_file_name = self::get_remote_servers_file_name();
		
		file_exists($remote_servers_file_name)
			&& unlink($remote_servers_file_name);
		
		$remote_servers_file_back_up_file_name
			= self::get_remote_servers_file_back_up_file_name();
			
		file_exists($remote_servers_file_back_up_file_name)
			&& rename(
				$remote_servers_file_back_up_file_name,
				$remote_servers_file_name
			);
	}
	
	/*
	 * ----------------------------------------
	 * The tests.
	 * ----------------------------------------
	 */
	
	public static function
		test_remote_servers_can_be_listed()
	{
		$remote_servers
			= ServerAdminScripts_MySQLDumpsDownloadingHelper
				::get_remote_servers();
		
		return isset($remote_servers) and is_array($remote_servers);
	}
	
	public static function
		test_remote_servers_can_be_added()
	{
		$new_server = 'foo.bar.com';
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::add_new_remote_server($new_server);
		
		$remote_servers
			= ServerAdminScripts_MySQLDumpsDownloadingHelper
				::get_remote_servers();
		
		return in_array($new_server, $remote_servers);
	}
	
	public static function
		test_remote_servers_can_be_deleted()
	{
		$new_server = 'foo.bar.com';
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::add_new_remote_server($new_server);
		
		$remote_servers
			= ServerAdminScripts_MySQLDumpsDownloadingHelper
				::get_remote_servers();
		
		if (in_array($new_server, $remote_servers)) {
			ServerAdminScripts_MySQLDumpsDownloadingHelper
				::delete_remote_server($new_server);
			
			$remote_servers
				= ServerAdminScripts_MySQLDumpsDownloadingHelper
					::get_remote_servers();
			
			return !in_array($new_server, $remote_servers);
		}
		
		return FALSE;
	}
	
	public static function
		test_remote_servers_list_can_be_reset()
	{
		foreach (
			explode(
				' ',
				'foo-bar.com bing-bang.com fi-fy-fo.fum'
			)
			as
			$remote_server
		) {
			ServerAdminScripts_MySQLDumpsDownloadingHelper
				::add_new_remote_server($remote_server);
		}
		
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::delete_all_remote_servers();
			
		$remote_servers
			= ServerAdminScripts_MySQLDumpsDownloadingHelper
				::get_remote_servers();
				
		return count($remote_servers) == 0;
	}
	
	public static function
		test_remote_servers_cannot_be_set_with_spaces()
	{
		try {
			ServerAdminScripts_MySQLDumpsDownloadingHelper
				::add_new_remote_server('foo bar');
			return FALSE;
		} catch (InputValidation_InvalidInputException $e) {
			return TRUE;
		}
	}
	
	public static function
		test_remote_servers_cannot_be_set_to_zls()
	{
		try {
			ServerAdminScripts_MySQLDumpsDownloadingHelper
				::add_new_remote_server('');
			return FALSE;
		} catch (InputValidation_InvalidInputException $e) {
			return TRUE;
		}
	}
	
	public static function
		test_remote_server_can_be_set_to_ipv4()
	{
		$new_server = '0.0.0.0';
		
		ServerAdminScripts_MySQLDumpsDownloadingHelper::add_new_remote_server($new_server);
		
		$remote_servers
			= ServerAdminScripts_MySQLDumpsDownloadingHelper
				::get_remote_servers();
		
		return in_array($new_server, $remote_servers);
	}
	
	public static function
		test_remote_server_can_be_set_to_domain()
	{
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::delete_all_remote_servers();
		$new_server = 'www.haddock-cms.com';
		
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::add_new_remote_server($new_server);
		
		$remote_servers
			= ServerAdminScripts_MySQLDumpsDownloadingHelper
				::get_remote_servers();
		
		return in_array($new_server, $remote_servers);
	}
	
	public static function
		test_that_repeats_are_silently_ignored()
	{
		$new_server = 'www.haddock-cms.com';
		
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::add_new_remote_server($new_server);
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::add_new_remote_server($new_server);
			
		$remote_servers
			= ServerAdminScripts_MySQLDumpsDownloadingHelper
				::get_remote_servers();
		
		return count($remote_servers) == count(array_unique($remote_servers));
	}
	
	public static function
		test_not_existant_remote_servers_deleted_silently()
	{
		$non_existant_server = 'not-there.com';
		
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::delete_remote_server($non_existant_server);
		
		return TRUE;
	}
	
	private static function
		add_several_servers_to_empty_list()
	{
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::delete_all_remote_servers();
			
		$remote_servers
			= explode(
				' ',
				'foo-bar.com bing-bang.com fi-fy-fo.fum'
			);
		
		foreach (
			$remote_servers
			as
			$remote_server
		) {
			ServerAdminScripts_MySQLDumpsDownloadingHelper
				::add_new_remote_server($remote_server);
		}
		
		return $remote_servers;
	}
	
	public static function
		test_adding_several_servers_adds_correct_number()
	{
		$remote_servers = self::add_several_servers_to_empty_list();
			
		$remote_servers_from_helper
			= ServerAdminScripts_MySQLDumpsDownloadingHelper
				::get_remote_servers();
		
		#print_r($remote_servers_from_helper);
		
		return 
			count($remote_servers) == count($remote_servers_from_helper);
	}
	
	public static function
		test_adding_several_servers_adds_correct_content()
	{
		$remote_servers = self::add_several_servers_to_empty_list();
			
		$remote_servers_from_helper
			= ServerAdminScripts_MySQLDumpsDownloadingHelper
				::get_remote_servers();
				
		foreach (
			$remote_servers
			as
			$remote_server
		) {
			if (!in_array($remote_server, $remote_servers_from_helper)) {
				return FALSE;
			}
		}
		
		return TRUE;
	}
	
	public static function
		test_deleting_only_removes_one_server()
	{
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::delete_all_remote_servers();
			
		$server_to_stay = 'to-stay.com';
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::add_new_remote_server($server_to_stay);
		
		
		$server_to_be_deleted = 'to-be-deleted.com';
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::add_new_remote_server($server_to_be_deleted);
		
		ServerAdminScripts_MySQLDumpsDownloadingHelper
			::delete_remote_server($server_to_be_deleted);
		
		$remote_servers
			= ServerAdminScripts_MySQLDumpsDownloadingHelper
				::get_remote_servers();
		
		if (count($remote_servers) != 1) {
			return FALSE;
		}
		
		if ($remote_servers[0] != $server_to_stay) {
			return FALSE;
		}
		
		return TRUE;
	}
}
?>