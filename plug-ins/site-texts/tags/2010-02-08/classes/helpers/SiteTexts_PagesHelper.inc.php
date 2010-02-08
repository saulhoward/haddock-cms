<?php
/**
 * SiteTexts_PagesHelper
 *
 * @copyright 2009-06-07, Robert Impey
 */

class
	SiteTexts_PagesHelper
{
	/*
	 * ----------------------------------------
	 * Functions to do with the name of the HTML page class.
	 * ----------------------------------------
	 */
	
	public static function
		get_page_class_name()
	{
		$page_class_file_name = self::get_html_page_class_file_name();
		
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo '__METHOD__: ' . __METHOD__ . "\n";
			echo '__LINE__: ' . __LINE__ . "\n";
			echo '$page_class_file_name: ' . $page_class_file_name . "\n";
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		if (!is_file($page_class_file_name)) {
			throw new FileSystem_FileNotFoundException($page_class_file_name);
		}
		
		return trim(file_get_contents($page_class_file_name));
	}
	
	private static function
		get_html_page_class_file_name()
	{
		return
			self::get_project_specific_config_directory_name()
			. 'page-class-name.txt';
	}
	
	private static function
		get_project_specific_config_directory_name()
	{
		return PROJECT_ROOT
			. DIRECTORY_SEPARATOR . 'project-specific'
			. DIRECTORY_SEPARATOR . 'config'
			. DIRECTORY_SEPARATOR . 'site-texts'
			. DIRECTORY_SEPARATOR;
	}
	
	public static function
		set_page_class_name(
			$page_class_name
		)
	{
		$page_class_name = trim($page_class_name);
		
		$validator = new SiteTexts_PageClassNameValidator();
		
		if ($validator->validate($page_class_name)) {
			#echo $page_class_name;
			
			$project_specific_config_directory_name
				= self::get_project_specific_config_directory_name();
			
			if (!is_dir($project_specific_config_directory_name)) {
				FileSystem_DirectoryHelper
					::mkdir_parents(
						$project_specific_config_directory_name
					);
			}
			
			$class_file_name = self::get_html_page_class_file_name();
			
			if ($fh = fopen($class_file_name, 'w')) {
				fwrite($fh, $page_class_name . PHP_EOL);
				fclose($fh);
			}
		}
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with handling requests.
	 * ----------------------------------------
	 */
	
	public static function
		get_content_for_current_page()
	{
		if (isset($_GET['page'])) {

			$page_name = $_GET['page'];

			if (isset($_GET['language'])) {
				$language_code = $_GET['language'];
			} else {
				$language_code = NULL;
			}
			
			/*
			 * TO DO: Check that the page name is nice.
			 */
			
			return SiteTexts_SiteTextsHelper
				::get_site_text($page_name, 'content', $language_code);
		} else {
			throw Exception('The page name must be set!');
		}
	}
}
?>
