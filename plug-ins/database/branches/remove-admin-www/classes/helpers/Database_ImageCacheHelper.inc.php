<?php
/**
 * Database_ImageCacheHelper
 *
 * @copyright 2008-05-15, RFI
 */

class
	Database_ImageCacheHelper
{
	public static function
		reset_image_cache()
	{
		$image_cache_directory
			= self
				::get_image_cache_directory();
		
		$image_cache_directory->delete_contents();
	}
	
	public static function
		get_image_cache_directory()
	{
		return
			new FileSystem_Directory(
				self
					::get_image_cache_directory_name()
				);
	}
	
	public static function
		get_image_cache_directory_name()
	{
		return PROJECT_ROOT . '/hc-database-img-cache';
	}
}
?>