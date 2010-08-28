<?php
/**
 * SiteTexts_SiteTextsHelper
 *
 * @copyright 2009-02-08, Robert Impey
 */

/**
 * A collection of functions to do with the site texts.
 */
class
	SiteTexts_SiteTextsHelper
{
	/**
	 * Searches for the relevant file and returns and proceses the text.
	 *
	 * @param string $page_name The name of the page that we are on.
	 * @param string $section_name The section of the page that we want.
	 * @param string $language_code The code of the language that we want.
	 */
	public static function
		get_site_text(
			$page_name, 
			$section_name,
			$language_code = NULL
		)
	{
		/*
		 * Find the current code for the language that is desired.
		 */
		if (!isset($language_code)) {
			$language_code = self::get_current_language_code();
		}
		
		$site_text_file_name = self::get_site_text_file_name(
			$page_name,
			$section_name,
			$language_code
		);
		
		#echo "\$site_text_file_name: $site_text_file_name\n"; exit;
		
		/*
		 * Tests for whether the file exists.
		 *
		 * If the file does not exist, check whether the same text exists
		 * in the default language for the site.
		 *
		 * If not, throw an exception.
		 */
		if (
			!file_exists($site_text_file_name)
		) {
			$site_text_file_name = self::get_site_text_file_name(
				$page_name,
				$section_name,
				self::get_default_language_code()
			);
			
			#echo "\$site_text_file_name: $site_text_file_name\n"; exit;
			
			if (
				!file_exists($site_text_file_name) 
			) {
				throw new Exception(
					"No '$section_name' section for the '$page_name'."
				);
			}
		}
		
		#echo "\$site_text_file_name: $site_text_file_name\n"; exit;
		
		/*
		 * Process the file.
		 */
		$site_text = self::process_site_text_file($site_text_file_name);
		
		#echo "\$site_text: $site_text\n"; exit;
		
		return $site_text;
	}
	
	public static function
		get_current_language_code()
    {
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            return $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        } else {
            return self::get_default_language_code();
        }
    }
	
	public static function
		get_site_text_file_name(
			$page_name,
			$section_name,
			$language_code
		)
	{
		return PROJECT_ROOT
			. DIRECTORY_SEPARATOR . 'site-texts'
			. DIRECTORY_SEPARATOR . $page_name
			. DIRECTORY_SEPARATOR . $section_name
			. DIRECTORY_SEPARATOR . $language_code
			. '.txt';
	}
	
	/**
	 * Processes a site text file.
	 *
	 * The format of the file is as follows.
	 *
	 * The first line should be PHP code that can render a string variable called
	 * $text.
	 *
	 * This renderering code should be followed by a blank line and then
	 * text in the specified format.
	 *
	 * e.g.
	 *
	 * <code>
	 * return Textile_TranslationHelper::translate_textile_to_html($text);
	 *
	 * h1. Some Textile!
	 * </code>
	 * 
	 * If the file does not exists, the function silently does nothing.
	 * Perhaps it should throw an exception instead.
	 * 
	 * @param string $site_text_file_name The name of the file to process.
	 */
	public static function
		process_site_text_file(
			$site_text_file_name
		)
	{
		$rendering_code = 'return $text;';
		$text = '';
		
		if ($file_handle = fopen($site_text_file_name, 'r')) {
			/*
			 * Read the rendering code.
			 */
			$rendering_code = fgets($file_handle);
			$blank_line = fgets($file_handle);
			
			while(!feof($file_handle)) {
				$text .= fgets($file_handle);
			}
			
			fclose($file_handle);
		}
		
		#echo "\$rendering_code: $rendering_code\n";
		#echo "\$text: $text\n";
		
		return eval(
			$rendering_code
		);
	}
	
	/**
	 * This should be settable on a project by project basis.
	 *
	 * @see http://code.google.com/p/haddock-cms/issues/detail?id=96
	 * 
	 * @return string The default language code for the project.
	 */
	public static function
		get_default_language_code()
	{
		return 'en';
	}
}
?>
