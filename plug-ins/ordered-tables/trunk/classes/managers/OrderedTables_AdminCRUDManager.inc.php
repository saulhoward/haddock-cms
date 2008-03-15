<?php
/**
 * OrderedTables_AdminCRUDManager
 *
 * @copyright 2008-03-13, RFI
 */

class
	OrderedTables_AdminCRUDManager
{
	/*
	 * To make this a singleton class.
	 */
	private static $instance;
	
	/*
	 * Instance variables.
	 */
	private $redirect_script_url;
	private $ordering_field_name;
	private $key_fields;
	private $table_name;
	
	/**
	 * The constructor sets the instance variables to usable defaults.
	 */
	private function
		__construct()
	{
		$this->redirect_script_url
			= PublicHTML_URLHelper
				::get_oo_page_url(
					'OrderedTables_AdminCRUDShiftRedirectScript'
				);
		
		$this->ordering_field_name = 'sort_order';
		$this->key_fields = array('id');
		
		$this->table_name = NULL;
	}
	
	public static function
		get_instance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new OrderedTables_AdminCRUDManager();
		}
		
		return self::$instance;
	}
	
	/*
	 * ----------------------------------------
	 * Accessors and mutators.
	 * ----------------------------------------
	 */
	
	public function
		get_redirect_script_url()
	{
		return $this->redirect_script_url;
	}
	
	public function
		set_redirect_script_url($redirect_script_url)
	{
		$this->redirect_script_url = $redirect_script_url;
	}
	
	public function
		get_ordering_field_name()
	{
		return $this->ordering_field_name;
	}
	
	public function
		set_ordering_field_name($ordering_field_name)
	{
		$this->ordering_field_name = $ordering_field_name;
	}
	
	public function
		get_key_fields()
	{
		return $this->key_fields;
	}
	
	public function
		set_key_fields($key_fields)
	{
		$this->key_fields = $key_fields;
	}
	
	public function
		get_table_name()
	{
		if (!isset($this->table_name)) {
			throw new Exception('The table name must be set!');
		}
		
		return $this->table_name;
	}
	
	public function
		set_table_name($table_name)
	{
		$this->table_name = $table_name;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with finding out about the
	 * extremes of the sortable values.
	 * ----------------------------------------
	 */
	
	private function
		get_key_of_current_max()
	{
		return $this->get_key_of_current_extreme('DESC');
	}
	
	private function
		get_key_of_current_min()
	{
		return $this->get_key_of_current_extreme('ASC');
	}
	
	private function
		get_key_of_current_extreme($direction)
	{
		$table_name = $this->get_table_name();
		$ordering_field_name = $this->get_ordering_field_name();
		$key_fields = $this->get_key_fields();
		
		$dbh = DB::m();
		
		$table_name = mysql_real_escape_string($table_name, $dbh);
		$direction = mysql_real_escape_string($direction, $dbh);
		$ordering_field_name = mysql_real_escape_string($ordering_field_name, $dbh);
		
		for ($i = 0; $i < count($key_fields); $i++) {
			$key_fields[$i] = mysql_real_escape_string($key_fields[$i], $dbh);
		}
		
		$query = 'SELECT ';
		
		$first = TRUE;
		foreach ($key_fields as $key_field) {
			if ($first) {
				$first = FALSE;
			} else {
				$query .= ' , ';
			}
			
			$query .= $key_field;
		}
		
		$query .= " FROM $table_name ";
		
		$query .= " ORDER BY $ordering_field_name $direction ";
		
		$query .= " LIMIT 0, 1 ";
		
		#echo $query; exit;
		
		$result = mysql_query($query, $dbh);
		
		if ($row = mysql_fetch_assoc($result)) {
			return $row;
		} else {
			throw new Database_MySQLException($dbh);
		}
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with altering the array of admin
	 * page action link descriptors.
	 * ----------------------------------------
	 */
	
	private function
		get_shift_action($direction)
	{
		$name = 'shift_' . $direction;
		
		$filter = '';
		
		$filter .= 'return OrderedTables_AdminCRUDHelper::make_content_for_action_td(';
		
		$filter .= "'$name'";
		$filter .= ' , ';
		
		$key_fields = $this->get_key_fields();
		
		$first = TRUE;
		foreach ($key_fields as $key_field) {
			if ($first) {
				$filter .= 'array(';
				$first = FALSE;
			} else {
				$filter .= ' , ';
			}
			
			$filter .= '\'' . $key_field . '\'';
			
			$filter .= ' => ';
			
			$filter .= ' $row[\'' . $key_field . '\']';
		}
		$filter .= ')';
		$filter .= ');';
		
		$shift_action = array(
			'name' => $name,
			'filter' => $filter
		);
		
		return $shift_action;
	}
	
	public function
		prepend_shift_actions(
			&$data_table_actions
		)
	{
		array_unshift(
			$data_table_actions,
			$this->get_shift_action('back')
		);
		
		array_unshift(
			$data_table_actions,
			$this->get_shift_action('forward')
		);
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with making the links to the
	 * redirect script from the admin CRUD page.
	 * ----------------------------------------
	 */
	
	/**
	 * Makes the content of the action TD.
	 *
	 * Refactor common elements with
	 * 	Database_CRUDAdminPage::make_content_for_action_td_for_item
	 *
	 */
	public function
		make_content_for_action_td(
			$action_name,
			$identifiers
		)
	{
		#print_r($identifiers);
		#exit;
		
		switch ($action_name) {
			case 'shift_back':
				$non_link_key = $this->get_key_of_current_max();
				break;
			case 'shift_forward':
				$non_link_key = $this->get_key_of_current_min();
				break;
			default:
				throw new Exception('Unknown action name!');
		}
		
		#print_r($non_link_key);
		
		$non_link = TRUE;
		
		foreach ($non_link_key as $k => $v) {
			if ($identifiers[$k] != $v) {
				$non_link = FALSE;
				break;
			}
		}
		
		if ($non_link) {
			return '&nbsp;';
		} else {
			$c
				= Formatting_ListOfWords
					::capitalise_delimited_string(
						$action_name,
						'_'
					);
				
			$a = new HTMLTags_A($c);
			
			$url = $this->get_action_redirect_script_url(
				$action_name,
				$identifiers
			);
			
			$a->set_href($url);
			
			return $a->get_as_string();
		}
	}
	
	public function
		get_action_redirect_script_url(
			$action_name,
			$identifiers
		)
	{
		$redirect_script_url = $this->get_redirect_script_url();
		
		$redirect_script_url->set_get_variable('action', $action_name);
		
		foreach ($identifiers as $k => $v) {
			$redirect_script_url->set_get_variable($k, $v);
		}
		
		$redirect_script_url->set_get_variable(
			'table_name',
			$this->get_table_name()
		);
		
		$redirect_script_url->set_get_variable(
			'return_to',
			urlencode($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'])
		);
		
		return $redirect_script_url;
	}
}
?>