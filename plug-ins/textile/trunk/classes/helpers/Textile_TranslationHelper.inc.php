<?php
/**
 * Textile_TranslationHelper
 *
 * @copyright 2009-02-08, Robert Impey
 */

class
	Textile_TranslationHelper
{
	public static function
		translate_textile_to_html($textile_text)
	{
		$textile = new Textile_Textile();
		
		return $textile->TextileThis($textile_text);
	}
}
?>