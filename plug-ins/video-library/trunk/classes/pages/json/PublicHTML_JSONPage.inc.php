<?php
/**
 * PublicHTML_JSONPage
 *
 * @copyright 2008-02-05, RFI
 */

abstract class
	PublicHTML_JSONPage
extends
	PublicHTML_HTTPResponseWithMessageBody
{
	#public function
	#	send_http_headers()
	#{
	#	parent::send_http_headers();
	#	#header('Content-type: application/xhtml+xml');
	#}
	
	public function
		render()
	{
		$this->render_json();
	}
	
	public function
		render_json()
	{

	}
}
?>
