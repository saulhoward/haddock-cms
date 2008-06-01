<?php
/**
 * HaddockProjectOrganisation_ProjectInformationHelper
 *
 * @copyright 2008-05-30, RFI
 */

class
	HaddockProjectOrganisation_ProjectInformationHelper
{
	public static function
		get_project_specific_config_file()
	{
		$project_specific_directory
			= HaddockProjectOrganisation_ProjectSpecificDirectoryHelper
				::get_project_specific_directory();
		
		return $project_specific_directory->get_config_file();
	}
	
	public static function
		get_name()
	{
		$config_file = self::get_project_specific_config_file();
		return $config_file->get_project_name();
	}
	
	public static function
		get_copyright_holder()
	{
		$config_file = self::get_project_specific_config_file();
		return $config_file->get_copyright_holder();
	}
	
	public static function
		get_title()
	{
		$config_file = self::get_project_specific_config_file();
		return $config_file->get_project_title();
	}
	
	public static function
		get_version_code()
	{
		$config_file = self::get_project_specific_config_file();
		return $config_file->get_version_code();
	}
	
	public static function
		get_camel_case_root()
	{
		$config_file = self::get_project_specific_config_file();
		return $config_file->get_camel_case_root();
	}
}
?>