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
		#$url = new HTMLTags_URL($local_part);
		$url = HTMLTags_URL::parse_and_make_url($local_part);
		
		self::redirect_to_url($url);
	}
	
	public static function
		redirect_to_url(
			HTMLTags_URL $url
		)
	{
		#throw new Exception('Testing exception handling');
	
		#print_r($url);
		
		$url_as_string = $url->get_as_string();
		
		#echo "\$url_as_string: $url_as_string\n";
		#
		#exit;
		
		#/*
		# * See http://uk.php.net/manual/en/function.header.php#73583
		# */
		#header('Pragma: private');
		#header('Cache-control: private, must-revalidate');
		
		$header_directive = 'Location: ' . $url_as_string;
		
		#echo "\$header_directive: $header_directive\n";
		#exit;
		
		header($header_directive);
		exit;
	}
}
?>
