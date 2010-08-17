<?php
/**
 * Markdown_TranslationHelper
 *
 * @copyright 2009-02-08, Robert Impey
 */

class
	Markdown_TranslationHelper
{
	public static function
		translate_markdown_to_html($textile_text)
	{
		#$textile_text = stripslashes($textile_text);
        require_once( PROJECT_ROOT . '/plug-ins/markdown/classes/Markdown_Markdown.inc.php');
		return Markdown($textile_text);
	}
}
?>
