<?php
/**
 * PublicHTML_PNGImage
 *
 * @copyright 2008-04-11, RFI
 */

class
	PublicHTML_PNGImage
extends
	PublicHTML_HTTPResponseWithMessageBody
{

	/**
	 * Render the response message body.
	 */
	public function
		render()
	{

	}
	
	public function
		send_http_headers()
	{
		parent::send_http_headers();
		
		header('Content-Type: image/png');
	}
	
}
?>
