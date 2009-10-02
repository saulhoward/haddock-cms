<?php
/**
 * VideoLibrary_PagesHelper
 *
 * @copyright 2009-06-07, Robert Impey
 * @copyright 2009-02-10, Saul Howard
 */

class
	VideoLibrary_PagesHelper
{
	public static function
		get_video_page_class_name()
	{
		$page_class_file_name = self::get_video_page_class_file_name();
		
		if (!is_file($page_class_file_name)) {
			throw new FileSystem_FileNotFoundException($page_class_file_name);
		}
		
		return trim(file_get_contents($page_class_file_name));
	}
	
	private static function
		get_video_page_class_file_name()
	{
		return PROJECT_ROOT
			. DIRECTORY_SEPARATOR . 'project-specific'
			. DIRECTORY_SEPARATOR . 'config'
			. DIRECTORY_SEPARATOR . 'video-library'
			. DIRECTORY_SEPARATOR . 'video-page-class-name.txt';
	}

	public static function
		get_search_page_class_name()
	{
		$page_class_file_name = self::get_search_page_class_file_name();
		
		if (!is_file($page_class_file_name)) {
			throw new FileSystem_FileNotFoundException($page_class_file_name);
		}
		
		return trim(file_get_contents($page_class_file_name));
	}
	
	private static function
		get_search_page_class_file_name()
	{
		return PROJECT_ROOT
			. DIRECTORY_SEPARATOR . 'project-specific'
			. DIRECTORY_SEPARATOR . 'config'
			. DIRECTORY_SEPARATOR . 'video-library'
			. DIRECTORY_SEPARATOR . 'search-page-class-name.txt';
	}
}
?>
