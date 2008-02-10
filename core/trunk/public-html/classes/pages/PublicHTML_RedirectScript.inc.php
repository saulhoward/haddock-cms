<?php
/**
 * PublicHTML_RedirectScript
 * 
 * @copyright RFI 2007-12-18
 */

abstract class
	PublicHTML_RedirectScript
extends
	PublicHTML_HaddockHTTPResponse
{
	private $return_to = NULL;
	
	public function
		run()
	{
		$this->send_http_headers();
		$this->run_post_session_header_commands();
		
		#try {
			$this->do_actions();
		#} catch (Exception $e) {
		#	$return_to = PublicHTML_ExceptionHelper
		#		::set_session_and_get_exception_page_url($e);
		#	
		#	$this->set_return_to($return_to->get_as_string());
		#}
		
		
		$this->redirect_to_return_to();
	}
	
	abstract protected function
		do_actions();
		
	protected function
		set_return_to($return_to)
	{
		$this->return_to = $return_to;
	}
	
	protected function
		redirect_to_return_to()
	{
		if (isset($this->return_to)) {
			$return_to = $this->return_to;
		} elseif (isset($_GET['return_to'])) {
			$return_to = $_GET['return_to'];
		} else {
			$return_to = $this->get_current_url_file_str();
		}
		
		#echo $return_to;
		#exit;
		
		header("Location: $return_to");
		exit;
	}
}
?>