<?php
class
	PublicHTML_HaddockHTTPResponse
{
	public function
		run()
	{
		$this->send_http_headers();
		$this->run_post_session_header_commands();
	}
	
	public function
		send_http_headers()
	{
		session_start();
	}
	
	/**
	 * The idea is that this should be overridden.
	 *
	 * Is there not a nicer way to do this?
	 */
	public function
		run_post_session_header_commands()
	{
	}
	
	/**
	 * DEPRECATED!
	 *
	 * Use DB::m() instead.
	 */
	public function
		get_dbh()
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
	    $mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();
		
		$dbh = $database->get_database_handle();
		
		return $dbh;
	}
	
	/**
	 * The name of the file that contains the script that is to
	 * be run when a request is sent to the server.
	 */
	protected function
		get_current_url_file_str()
	{
		return '/haddock/public-html/public-html/index.php';
	}
	
	protected function
		get_current_url_just_file()
	{
		$url = new HTMLTags_URL();
		
		$url->set_file($this->get_current_url_file_str());
		
		return $url;
	}
	
	/**
	 * A link to page that this class (or its subclasses) represents
	 * without any additional GET variables set.
	 */
	protected function
		get_current_base_url()
	{
		#$url = $this->get_current_url_just_file();
		#
		#$url->set_get_variable('oo-page');
		#$url->set_get_variable('page-class', get_class($this));
		#
		#return $url;
		
		return PublicHTML_URLFactory::make_local_url(get_class($this));
	}
}
?>