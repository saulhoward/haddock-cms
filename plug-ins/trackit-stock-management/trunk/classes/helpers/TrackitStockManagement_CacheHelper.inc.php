<?php
/**
 * TrackitStockManagement_CacheHelper
 *
 * @copyright 2008-04-23, RFI
 */

class
	TrackitStockManagement_CacheHelper
{
	public static function
		get_cache_dir_name()
	{
		$tsm_cm
			= Configuration_ConfigManagerHelper
				::get_config_manager(
					'plug-ins',
					'trackit-stock-management'
				);
		
		$cache_dir_name = $tsm_cm->get_cache_dir_name();
		
		return $cache_dir_name;
	}
	
	public static function
		get_cache_directory()
	{
		$cache_dir_name = self::get_cache_dir_name();
		
		return new FileSystem_Directory($cache_dir_name);
	}
	
	public static function
		delete_all_cache_files()
	{
		$cache_directory = self::get_cache_directory();
		
		$cache_directory->delete_contents();
	}
}
?>