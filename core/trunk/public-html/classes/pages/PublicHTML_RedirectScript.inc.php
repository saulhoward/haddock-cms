<?php
/**
 * PublicHTML_RedirectScript
 * 
 * @copyright 2007-12-18, RFI
 */

abstract class
	PublicHTML_RedirectScript
extends
	PublicHTML_HaddockHTTPResponse
{
	private $return_to_url = NULL;
	
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
		
	
	/*
	 * ----------------------------------------
	 * Functions to do with redirecting the browser after the code has run.
	 * ----------------------------------------
	 */
	
	protected function
		get_return_to_url()
	{
		if (!isset($this->return_to_url)) {
			if (isset($_GET['return_to'])) {
				$this->return_to_url
					= HTMLTags_URL
						::parse_and_make_url($_GET['return_to']);
			} else {
				#$return_to = $this->get_current_url_file_str();
				
				if (isset($_SERVER['HTTP_REFERER'])) {
					$this->return_to_url
						= HTMLTags_URL
							::parse_and_make_url($_SERVER['HTTP_REFERER']);
				} else {
					$this->return_to_url
						= HTMLTags_URL
							::parse_and_make_url('/');
				}
			}
		}
		
		return $this->return_to_url;
	}
	
	protected function
		set_return_to($return_to)
	{
		#$this->return_to_url = $return_to;
		
		$this->set_return_to_url(
			HTMLTags_URL::parse_and_make_url($return_to)
		);
	}
	
	protected function
		set_return_to_url(
			HTMLTags_URL $return_to_url
		)
	{
		#$this->set_return_to($return_to_url->get_as_string());
		
		$this->return_to_url = $return_to_url;
	}
	
	protected function
		redirect_to_return_to()
	{
		#if (isset($this->return_to)) {
		#	$return_to = $this->return_to;
		#} elseif (isset($_GET['return_to'])) {
		#	$return_to = $_GET['return_to'];
		#} else {
		#	$return_to = $this->get_current_url_file_str();
		#}
		#
		##echo $return_to;
		##exit;
		#
		#header("Location: $return_to");
		#exit;
		
		$return_to_url = $this->get_return_to_url();
		
		#print_r($return_to_url); exit;
		
		$return_to_url->make_absolute_for_current_server();
		
		PublicHTML_RedirectionHelper
			::redirect_to_url($return_to_url);
	}
}
?>