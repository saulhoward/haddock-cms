<?php
/**
 * Database_CRUDAdminManager
 *
 * @copyright RFI 2007-12-18
 */

/**
 * Coordinates the CRUD admin page with the CRUD admin redirect script.
 */
abstract class
	Database_CRUDAdminManager
{
	/**
	 * Cache the row that we're dealing with at the moment.
	 */
	private $hash_for_something;
	
	public function
		__construct()
	{
		$this->hash_for_something = NULL;
	}
	
	/**
	 * The name of the class that implements the code that renders the HTML
	 * that is used to manage whatever it is we're dealing with.
	 */
	abstract public function
		get_admin_page_class_name();
		
	/**
	 * The name of the class that implements the functions
	 * that manage the database.
	 */
	abstract public function
		get_admin_redirect_script_class_name();
		
	public function
		get_form_session_variables_array_name()
	{
		return 'form-variables';
	}
	
	public function
		set_form_session_var($key, $value)
	{
		$_SESSION[$this->get_form_session_variables_array_name()][$key] = $value;
	}
	
	public function
		get_form_session_var($key)
	{
		return $_SESSION[$this->get_form_session_variables_array_name()][$key];
	}
	
	public function
		has_form_session_var($key)
	{
		return isset($_SESSION[$this->get_form_session_variables_array_name()][$key]);
	}
	
	public function
		get_current_var($key)
	{
		if (isset($_SESSION[$this->get_form_session_variables_array_name()][$key])) {
			return $_SESSION[$this->get_form_session_variables_array_name()][$key];
		}
		
		$something = $this->get_hash_for_something();
		
		if (isset($something[$key])) {
			return $something[$key];
		}
		
		return NULL;
	}
	
	public function
		has_current_var($key)
	{
		if (isset($_SESSION[$this->get_form_session_variables_array_name()][$key])) {
			return TRUE;
		}
		
		$something = $this->get_hash_for_something();
		
		if (isset($something[$key])) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function
		clear_form()
	{
		#print_r($_SESSION[$this->get_form_session_variables_array_name()]); exit;
		
		$_SESSION[$this->get_form_session_variables_array_name()] = array();
	}
	
	/**
	 * 'something' might be a row in a table or a view.
	 * ¿Quién sabe?
	 *
	 * On the whole, it will be identified by the primary key of
	 * a table called 'id'.
	 *
	 * Sometimes the key will be several columns.
	 */
	public function
		get_key_columns_for_something()
	{
		return array('id');
	}
	
	/**
	 * Returns the row from the table or view or whatever that
	 * we are dealing with at the moment.
	 */
	public function
		get_hash_for_something()
	{
		if (!isset($this->hash_for_something)) {
			$dbh = DB::m();
			
			$query = $this->get_query_for_something();
			
			#echo $query; exit;
			
			$result = mysql_query($query, $dbh);
			
			if ($result) {
				$num_rows = mysql_num_rows($result);
				if ($num_rows > 1) {
					throw new Exception('More than one row found!');
				} elseif($num_rows < 1) {
					throw new Exception('No rows found!');
				} else {
					$this->hash_for_something = mysql_fetch_assoc($result);
				}
			} else {
				throw new Database_MySQLException($dbh);
			}
		}
		
		return $this->hash_for_something;
	}
	
	/**
	 * The select query that gets one of whatever it is we're
	 * dealing with.
	 */
	abstract public function
		get_query_for_something();
		
	public function
		get_key_values_from_get_vars()
	{
		$cs = $this->get_key_columns_for_something();
		
		$vs = array();
		
		$dbh = DB::m();
		
		foreach ($cs as $c) {
			if (isset($_GET[$c])) {
				$vs[$c] = mysql_real_escape_string($_GET[$c], $dbh);
			} else {
				throw new Exception("$c must be set!");
			}
		}
		
		return $vs;
	}
	
	/**
	 * Takes a URL and adds get variables that will be used to identify
	 * the thing that is in questions.
	 * 
	 * Horrible, use OO!
	 * e.g. Have a class that represents a url.
	 * Maybe that would be less flexible.
	 *
	 * This is used in:
	 * 
	 * 	Database_CRUDAdminPage::get_edit_something_redirect_script_url()
	 * 	Database_CRUDAdminPage::get_delete_something_redirect_script_url()
	 * 	
	 */
	public function
		add_get_vars_to_identify_current_thing(
			HTMLTags_URL $url,
			$somthing
		)
	{
		$ks = $this->get_key_columns_for_something();
		
		foreach ($ks as $k) {
			$url->set_get_variable($k, $somthing[$k]);
		}
		
		return $url;
	}
}
?>