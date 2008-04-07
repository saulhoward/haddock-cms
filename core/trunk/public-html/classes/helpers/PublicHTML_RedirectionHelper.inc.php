<?php
/**
 * PublicHTML_RedirectionHelper
 *
 * @copyright 2008-02-21, RFI
 */

class
	PublicHTML_RedirectionHelper
{
	/**
	 * Takes the local part of a URL
	 * and turns it into an absolute URL (by looking at the current HTTP env)
	 * and redirects the browser to the URL.
	 */
	public static function
		redirect_to_absolute_location($local_part)
	{
		$url = new HTMLTags_URL($local_part);
		
		self::redirect_to_url($url);
	}
	
	public static function
		redirect_to_url(HTMLTags_URL $url)
	{
		header('Location: ' . $url->get_as_string());
		exit;
	}
}
?>