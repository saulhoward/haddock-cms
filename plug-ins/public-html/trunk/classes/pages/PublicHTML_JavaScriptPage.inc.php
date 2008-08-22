<?php
abstract class
	PublicHTML_JavaScriptPage
extends
	PublicHTML_HTTPResponseWithMessageBody
{
	public function
		send_http_headers()
	{
		parent::send_http_headers();
		header('Content-type: text/javascript');
	}
}
?>