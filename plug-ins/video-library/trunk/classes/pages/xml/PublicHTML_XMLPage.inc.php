<?php
/**
 * PublicHTML_XMLPage
 *
 * @copyright 2008-02-05, RFI
 */

abstract class
	PublicHTML_XMLPage
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
		$this->render_doctype();
		$this->render_xml();
	}
	
	public function
		render_doctype()
	{
echo <<<XML
<?xml version="1.0" encoding="ISO-8859-1"?>
XML;

	}
	
	public function
		render_xml()
	{

	}
}
?>
