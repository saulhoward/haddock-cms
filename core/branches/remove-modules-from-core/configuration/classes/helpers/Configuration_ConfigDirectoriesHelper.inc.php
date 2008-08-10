<?php
/**
 * Configuration_ConfigDirectoriesHelper
 *
 * @copyright 2008-05-30, RFI
 */

class
	Configuration_ConfigDirectoriesHelper
{
	public static function
		get_instance_specific_config_directory()
	{
		$instance_specific_config_directory
			= new Configuration_InstanceSpecificConfigDirectory(
				self::get_instance_specific_config_directory_name()
			);
			
		if (!$instance_specific_config_directory->exists()) {
			$instance_specific_config_directory->commit();
		}
		
		return $instance_specific_config_directory;
	}
	
	public static function
		get_instance_specific_config_directory_name()
	{
		return PROJECT_ROOT . DIRECTORY_SEPARATOR . 'config';
	}
	
	public static function
		make_sure_instance_specific_config_directory_exists()
	{
		/*
		 * Create the instance specific config dir if necessary.
		 */
		$instance_specific_config_directory_name
			= self::get_instance_specific_config_directory_name();
			
		if (!is_dir($instance_specific_config_directory_name)) {
			mkdir($instance_specific_config_directory_name);
		}
		
		/*
		 * Restrict access to the folder if necessary.
		 */
		
		/*
		 * Create a date string.
		 */
		$date = date('Y-m-d');

		/*
		 * Write the .htaccess file.
		 */
		$instance_specific_directory_htaccess_file_name
			= $instance_specific_config_directory_name . DIRECTORY_SEPARATOR .  '.htaccess';
		if (!is_file($instance_specific_directory_htaccess_file_name)) { 
			$htaccess = <<<HTA
# Restrict Access to the instance specific config folder.
# © $date

Order Deny,Allow
Deny from all

HTA;

			if (
				$fh
					= fopen(
						$instance_specific_directory_htaccess_file_name,
						'w'
					)
			) {
				fwrite($fh, $htaccess);
				
				fclose($fh);
			}
		}
	}
	
	public static function
		make_sure_instance_specific_config_directory_for_project_exists()
	{
		self::make_sure_instance_specific_config_directory_exists();
		
		$instance_specific_config_directory_for_project_name
			= self
				::get_instance_specific_config_directory_for_project_name();
		
		is_dir($instance_specific_config_directory_for_project_name)
			|| mkdir($instance_specific_config_directory_for_project_name);
	}
	
	public static function
		get_instance_specific_config_directory_for_project_name()
	{
		return
			self::get_instance_specific_config_directory_name()
			. DIRECTORY_SEPARATOR
			. HaddockProjectOrganisation_ProjectInformationHelper
				::get_name();
	}
}
?>