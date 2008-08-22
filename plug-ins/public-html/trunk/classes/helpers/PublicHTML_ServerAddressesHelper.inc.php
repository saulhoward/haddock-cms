<?php
/**
 * PublicHTML_ServerAddressesHelper
 *
 * @copyright 2008-05-30, RFI
 */

class
	PublicHTML_ServerAddressesHelper
{
	public static function
		set_server_address($server_address)
	{
		#$server_address_file = self::get_server_address_file();
		#$server_address_file->set_server_address($server_address);
		Configuration_ConfigDirectoriesHelper
			::make_sure_instance_specific_config_directory_exists();
		
		/*
		 * Create the folder for the public-html module, if necessary.
		 */
		$is_ph_cd
			= PROJECT_ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR .  'pubic-html';
		
		if (!is_dir($is_ph_cd)) {
			mkdir($is_ph_cd);
		}
		
		/*
		 * Write the config file.
		 */
		$server_address_file_name
			= $is_ph_cd . DIRECTORY_SEPARATOR .  'server-address.txt';
		
		if (is_file($server_address_file_name)) {
			unlink($server_address_file_name);
		}
		
		if ($fh = fopen($server_address_file_name, 'w')) {
			$server_address_file_content = <<<CNF
$server_address
CNF;


			fwrite($fh, $server_address_file_content);
			
			fclose($fh);
		}
	}
	
	public static function
		get_server_address()
	{
		#$server_address_file = self::get_server_address_file();
		#return $server_address_file->get_server_address();
		$is_ph_cd
			= PROJECT_ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR .  'pubic-html';
			
		$server_address_file_name
			= $is_ph_cd . DIRECTORY_SEPARATOR .  'server-address.txt';
		
		if (!is_file($server_address_file_name)) {
			throw new FileSystem_FileNotFoundException($server_address_file_name);
		}
		
		$server_address = file_get_contents($server_address_file_name);
		
		return trim($server_address);
	}
	
	public static function
		get_server_address_file()
	{
		#$instance_specific_config_directory
		#	= Configuration_ConfigDirectoriesHelper
		#		::get_instance_specific_config_directory();
		#
		##echo __FILE__ . ':' . __LINE__ . PHP_EOL;
		##echo $instance_specific_config_directory->exists(). PHP_EOL; exit;
		#
		#if (
		#	!$instance_specific_config_directory
		#		->has_config_file(
		#			'public-html',
		#			'server-address.xml'
		#		)
		#) {
		#	$instance_specific_config_directory
		#		->create_config_file(
		#			'public-html',
		#			'server-address.xml'
		#		);
		#}
		#
		#$server_address_file
		#	= $instance_specific_config_directory
		#		->get_config_file(
		#			'public-html',
		#			'server-address.xml'
		#		);
		#
		#return
		#	new PublicHTML_ServerAddressFile(
		#		$server_address_file->get_name()
		#	);
	}
}
?>