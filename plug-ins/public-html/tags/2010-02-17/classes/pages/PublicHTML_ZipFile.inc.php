<?php
/**
 * PublicHTML_ZipFile
 *
 * @copyright 2010-01-29, Robert Impey
 */

abstract class
	PublicHTML_ZipFile
extends
	PublicHTML_HTTPResponseWithMessageBody
{
	private $save_as_name;
	
	public function
		run_post_session_header_commands()
	{
		header('Expires: 0');
		header('Pragma: cache');
		header('Cache-Control: private');
		
		header('Content-Type: application/zip');
		
		$content_disposition = 'Content-disposition: attachment';
		
		if (isset($this->save_as_name)) {
			$content_disposition .= '; filename=' . $this->save_as_name;
		}
		
		header($content_disposition);
	}
	
	protected function
		get_save_as_name()
	{
		return $this->save_as_name;
	}
	
	protected function
		set_save_as_name($save_as_name)
	{
		$this->save_as_name = $save_as_name;
	}
}
?>