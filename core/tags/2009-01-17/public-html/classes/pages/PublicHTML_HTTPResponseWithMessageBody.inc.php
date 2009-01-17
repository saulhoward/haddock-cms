<?php
/**
 * PublicHTML_HTTPResponseWithMessageBody
 *
 * @copyright 2008-04-11, RFI
 */

abstract class
	PublicHTML_HTTPResponseWithMessageBody
extends
	PublicHTML_HaddockHTTPResponse
{
	public function
		run()
	{
		parent::run();
		$this->render();
	}
	
	/**
	 * Render the response message body.
	 */
	abstract public function
		render();
}
?>