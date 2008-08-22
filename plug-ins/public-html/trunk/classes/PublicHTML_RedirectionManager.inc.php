<?php
/**
 * PublicHTML_RedirectionManager
 *
 * @copyright 2007-08-19, RFI
 */

class
	PublicHTML_RedirectionManager
{
	private $url;
	
	public function
		__construct()
	{
		$this->url = new HTMLTags_URL();
		
		if ($_SERVER['HTTPS']) {
			$this->url->set_scheme('https');
		} else {
			$this->url->set_scheme('http');            
		}
		
		$this->url->set_domain($_SERVER['HTTP_HOST']);
	}
	
	public function
		get_url()
	{
		return $this->url;
	}
	
	public function
		get_current_url()
	{
		$current_url = new HTMLTags_URL();
		
		if ($_SERVER['HTTPS']) {
				$current_url->set_scheme('https');
			} else {
				$current_url->set_scheme('http');
			}
		
		if (preg_match('/([-\w.]+):(\d+)/', $_SERVER['HTTP_HOST'], $matches)) {
			$current_url->set_domain($matches[1]);
			$current_url->set_port($matches[2]);
		} else {
			$current_url->set_domain($_SERVER['HTTP_HOST']);
		}
	
		$file = $_SERVER['REQUEST_URI'];
		
		if (preg_match('/(.*)\?/', $file, $matches)) {
			$file = $matches[1];
		}
		
		$current_url->set_file($file);
		
		foreach (array_keys($_GET) as $get_var_key) {
			$current_url->set_get_variable($get_var_key, $_GET[$get_var_key]);
		}

		return $current_url;
	}	
}
?>