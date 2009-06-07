<?php
/**
 * SiteTexts_PagesHelper
 *
 * @copyright 2009-06-07, Robert Impey
 */

class
	SiteTexts_PagesHelper
{
	public static function
		get_page_class_name()
	{
		$page_class_file_name = self::get_class_file_name();
		
		if (!is_file($page_class_file_name)) {
			throw new FileSystem_FileNotFoundException($page_class_file_name);
		}
		
		return trim(file_get_contents($page_class_file_name));
	}
	
	private static function
		get_class_file_name()
	{
		return PROJECT_ROOT
			. DIRECTORY_SEPARATOR . 'project-specific'
			. DIRECTORY_SEPARATOR . 'config'
			. DIRECTORY_SEPARATOR . 'site-texts'
			. DIRECTORY_SEPARATOR . 'page-class-name.txt';
	}
	
	public static function
		get_content_for_current_page()
	{
		if (isset($_GET['page'])) {
			$page_name = $_GET['page'];
			
			/*
			 * TO DO: Check that the page name is nice.
			 */
			
			return SiteTexts_SiteTextsHelper
				::get_site_text($page_name, 'content');
		} else {
			throw Exception('The page name must be set!');
		}
	}
}
?>