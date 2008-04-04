<?php
/**
 * HTMLTags_URL
 *
 * @copyright 2006-11-29, RFI
 */

class
	HTMLTags_URL
{
	private $scheme;
	private $domain;
	private $port;
	private $remote_part;
	
	private $file;
	private $get_variables;
	private $local_part;
	
	private $url;
	
	public function __construct($url = null)
	{
		if (isset($url)) {
			$this->url = $url;
		} else {
			$this->port = NULL;
			$this->get_variables = array();
		}
	}
	
	public function
		__toString()
	{
		return 'HTMLTags_URL';
	}
	
	public function
		set_scheme($scheme)
	{
		$this->scheme = $scheme;
	}
	
	public function
		set_domain($domain)
	{
		$this->domain = $domain;
	}

	public function
		set_port($port)
	{
		if (is_numeric($port)) {
			$this->port = $port;
		} else {
			throw new Exception("The port of a URL must be a number, '$port' given!");
		}
	}    

	public function
		set_remote_part($remote_part)
	{
		$this->remote_part = $remote_part;
	}
	
	public function 
		has_remote_part()
	{
		return isset($this->remote_part) or isset($this->domain);
	}
	
	public function
		get_remote_part()
	{
		if ($this->has_remote_part()) {
		if (isset($this->remote_part)) {
			return $this->remote_part;
		} else {
			$remote_part = '';
			
			if (isset($this->scheme)) {
				$remote_part .= $this->scheme;
			} else {
				$remote_part .= 'http';
			}
			
			$remote_part .= '://';
			
			$remote_part .= $this->domain;
				
		if (isset($this->port)) {
			$remote_part .= ':' . $this->port;
		}
		
				return $remote_part;
			}
		} else {
			throw new Exception('This URL doesn\'t have remote part!');
		}
	}
	
	public function
		set_file($file)
	{
		$this->file = $file;
	}
	
	public function
		get_file()
	{
		return $this->file;
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with GET variables.
	 * ----------------------------------------
	 */
	
	public function
		set_get_variable($key, $value = 1)
	{
		$this->get_variables[$key] = $value;
	}
	
	private function
		has_get_variables()
	{
		return count($this->get_variables) > 0;
	}
	
	public function
		get_get_variables()
	{
		return $this->get_variables;
	}
	
	public function
		is_get_variable_set($key)
	{
		return isset($this->get_variables[$key]);
	}
	
	public function
		get_get_variable($key)
	{
		if ($this->is_get_variable_set($key)) {
			return $this->get_variables[$key];
		} else {
			throw new Exception("Cannot access unset GET variable '$key'!");
		}
	}
	
	public function
		unset_get_variable($key)
	{
		if ($this->is_get_variable_set($key)) {
			unset($this->get_variables[$key]);
			return TRUE;
		} else {
			throw new Exception("Cannot unset unset GET variable '$key'!");
		}
	}
	
	private function
		get_get_variables_string()
	{
		$get_variables_string = '';
		
		$first = true;
		foreach (array_keys($this->get_variables) as $get_var_key) {
			if ($first) {
				$first = false;
			} else {
				$get_variables_string .= '&';
				#$get_variables_string .= '&amp;';
			}
			
			$get_variables_string .= $get_var_key;
			$get_variables_string .= '=';
			$get_variables_string .= $this->get_variables[$get_var_key];
		}
		
		return $get_variables_string;
	}
	
	public function
		delete_all_get_variables()
	{
		$this->get_variables = array();
	}
	
	/*
	 * ----------------------------------------
	 * Putting the local part together.
	 * ----------------------------------------
	 */
	
	public function
		set_local_part($local_part)
	{
		$this->local_part = $local_part;
	}
	
	private function
		get_local_part()
	{
		if (isset($this->local_part) or isset($this->file)) {
			if (isset($this->local_part)) {
				return $this->local_part;
			} else {
				$local_part = $this->file;
				
				if ($this->has_get_variables()) {
					$local_part .= '?';
					$local_part .= $this->get_get_variables_string();
				}
				
				#echo "\$local_part: $local_part\n";
				
				return $local_part;
			}
		} else {
			throw new Exception('The local part of this URL has not been set!');
		}
	}
	
	public function
		set_url($url)
	{
		$this->url = $url;
	}
	
	public function
		get_as_string()
	{
		if (isset($this->url)) {
			return $this->url;
		} else {
			$url = '';
			
			if ($this->has_remote_part()) {
				$url .= $this->get_remote_part();
				#$url .= '/';
				
				$local_part = $this->get_local_part();
				
				#echo "\$local_part: $local_part\n";
				
				$local_part = ltrim($local_part);
				
				#echo "\$local_part: $local_part\n";
				
				$url .= $local_part;
			} else {
				$url .= $this->get_local_part();
			}
			
			return $url;
		}
	}
	
	/**
	 * Parses a URL using preg_*.
	 *
	 * Incomplete.
	 */
	public function
		parse_url($url)
	{
		#echo "\$url: $url\n";
		
		#^(?:([a-z]+)(?:://))?([-\w.]+)?
		if (preg_match('{(/[-\w.]*)\?((?:[^=]+=[^=&]+)(?:&[^=]+=[^=&]+)*)}', $url, $matches)) {
			#echo 'print_r($matches): ' . "\n";
			#print_r($matches);
			
			$file = $matches[1];
			$get_vars = $matches[2];
			
			$this->set_file($file);
			
			foreach (explode('&', $get_vars) as $key_value_pair) {
				if (preg_match('/([^=]+)=([^=]+)/', $key_value_pair, $matches)) {
					$this->set_get_variable($matches[1], $matches[2]);
				}
			}
		//} else {
		//    echo "No match!\n";
		}
		
	}
	
	/**
	 * Parse a URL string and create an object.
	 *
	 * It makes more sense for this to be a static factory function
	 * like this that the method above.
	 */
	public static function
		parse_and_make_url($url_str)
	{
		$url = new HTMLTags_URL();
		
		#echo "\$url_str: $url_str\n";
		
		/*
		 * Is the scheme set?
		 */
		if (preg_match('{^([a-zA-Z]+)://(.+)}', $url_str, $matches)) {
			$url->set_scheme($matches[1]);
			
			$url_without_scheme_and_punc = $matches[2];
			
			if (preg_match('{^([^/]+)(.+)}', $url_without_scheme_and_punc, $matches)) {
				$url->set_domain($matches[1]);
				
				$url_str = $matches[2];
			}
		}
		
		if (preg_match('{([^?]*)(?:\?((?:[^=]+=[^=&]+)(?:&[^=]+=[^=&]+)*))?}', $url_str, $matches)) {
			#echo 'print_r($matches): ' . "\n";
			#print_r($matches);
			
			$file = $matches[1];
			$get_vars = $matches[2];
			
			$url->set_file($file);
			
			foreach (explode('&', $get_vars) as $key_value_pair) {
				if (preg_match('/([^=]+)=([^=]+)/', $key_value_pair, $matches)) {
					$url->set_get_variable($matches[1], $matches[2]);
				}
			}
		}		
		
		#print_r($url);
		#
		#exit;
		
		return $url;
	}
}
?>