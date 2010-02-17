<?php
/**
 * PublicHTML_CascadingStyleSheet
 *
 * @copyright 2010-02-08, Robert Impey
 */

abstract class
	PublicHTML_CascadingStyleSheet
extends
	PublicHTML_HTTPResponseWithMessageBody
{
	public function
		send_http_headers()
	{
		parent::send_http_headers();
		
		header('Content-Type: text/css');
	}
}
?>
