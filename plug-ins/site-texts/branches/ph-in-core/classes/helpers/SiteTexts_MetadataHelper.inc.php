<?php
/**
 * SiteTexts_MetadataHelper
 *
 * @copyright 2010-09-10, Saul Howard
 */

/**
 * A collection of functions for returning simpleXMLData object of 
 * metadata to be used in a page's <head> or whereever  needed
 */
class
    SiteTexts_MetadataHelper
{

    public static function
        get_metadata(
            $page_name,
            $language_code = NULL
        )
    {
		/*
         * Find the current code for the language that is desired.
		 */
        if (!isset($language_code)) {
            $language_code = self::get_current_language_code();
        }
		
		$metadata_file_name = self::get_metadata_file_name(
			$page_name,
			$language_code
		);
		
		#echo "\$site_text_file_name: $site_text_file_name\n"; exit;
		
		/**
		 * Tests for whether the file exists.
		 *
		 * If the file does not exist, check whether the same text exists
		 * in the default language for the site.
		 *
		 * If not, throw an exception.
		 */
		if (
			!file_exists($metadata_file_name)
		) {
			$metadata_file_name = self::get_metadata_file_name(
				$page_name,
				$section_name,
				self::get_default_language_code()
			);
			
			#echo "\$metadata_file_name: $metadata_file_name\n"; exit;
			
			if (
				!file_exists($metadata_file_name) 
			) {
				throw new Exception(
					"No metadata for page '$page_name'."
				);
			}
		}
		
		#echo "\$metadata_file_name: $metadata_file_name\n"; exit;
		
		/**
		 * Process the file.
		 */
		$metadata = self::extract_metadata_from_file($metadata_file_name);
		#echo "\$metadata: $metadata\n"; exit;
		return $metadata;
	}

	public static function
		get_current_language_code()
    {
        return SiteTexts_SiteTextsHelper::get_current_language_code();
    }
	
	public static function
		get_metadata_file_name(
			$page_name,
			$language_code
		)
	{
		return PROJECT_ROOT
			. DIRECTORY_SEPARATOR . 'site-texts'
			. DIRECTORY_SEPARATOR . $page_name
			. DIRECTORY_SEPARATOR . $language_code
			. '.xml';
	}
	
	/**
	 * Processes a metadata file.
	 *
	 * The format of the file is as follows.
     *
	 * <?xml version="1.0" encoding="UTF-8"?>
     * <metadata>
     *     <title>
	 *         Page Title
     *     </title>
     *     <description>
     *         Page Description
     *     </description>
     * </metadata>
	 *
	 * If the file does not exists, the function silently does nothing.
	 * Perhaps it should throw an exception instead.
	 * 
	 * @param string $metadata_file_name The name of the file to process.
	 */
	public static function
		extract_metadata_from_file(
			$metadata_file_name
		)
	{
        if (file_exists($metadata_file_name)) {
                return simplexml_load_file($metadata_file_name);
        } else {
            throw new Exception(
                "File not found."
            );
        }
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
