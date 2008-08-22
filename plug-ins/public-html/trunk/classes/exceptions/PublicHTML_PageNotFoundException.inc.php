<?php
class
	PublicHTML_PageNotFoundException
extends
	PublicHTML_Exception
{
	public function
		__construct($request_uri)
	{
		parent::__construct("Page \"$request_uri\" not found!\n");
	}
}
?>