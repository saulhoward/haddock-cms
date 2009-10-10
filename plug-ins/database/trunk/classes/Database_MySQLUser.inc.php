<?php
/**
 * Database_MySQLUser
 * 
 * @copyright Clear Line Web Design, 2006-09-17
 */

/**
 * Every server, project and purpose has its own MySQL user.
 *
 * Each of these users has a username, password, database and host
 * for connecting to a MySQL database.
 */
class
	Database_MySQLUser
{
	private $password_file;
	
	private $dbh;
	
	private $database;
	
	public function
		__construct($password_file)
	{
		$this->password_file = $password_file;
	}
	
	public function
		get_password_file()
	{
		return $this->password_file;
	}
	
	public function
		get_dbh_no_db_selected()
	{
		$password_file = $this->get_password_file();
		
		$dbh = mysql_pconnect(
			$password_file->get_host(),
			$password_file->get_username(),
			$password_file->get_password()
		);
		
		if (!isset($dbh)) {
			throw new Exception(
				'Unable to connect as '
				. $password_file->get_username()
				. '@'
				. $password_file->get_host()
				. '!'
			);
		}
		
		return $dbh;
	}
	
	public function
		get_database_handle()
	{
		#return $this->get_dbh_private_member();
		return $this->get_dbh_new_instance();
	}
	
	private function
		get_dbh_private_member()
	{
		if (!isset($this->dbh)) {
			$password_file = $this->get_password_file();
			
			$this->dbh = $this->get_dbh_no_db_selected();
			
			$rv = mysql_select_db($password_file->get_database(), $this->dbh);
			
			if (!$rv) {
				throw new Exception(
					'Unable to select '
					. $password_file->get_database()
					. '!'
				);
			}
		}
		
		#echo "MySQL host info: \n" . mysql_get_host_info($this->dbh) . "\n";
		
		return $this->dbh;
	}
	
	private function
		get_dbh_new_instance()
	{
		$password_file = $this->get_password_file();
		
		$dbh = $this->get_dbh_no_db_selected();
		
		$rv = mysql_select_db($password_file->get_database(), $dbh);
		
		if (!$rv) {
			throw new Exception(
				'Unable to select '
				. $password_file->get_database()
				. '!'
			);
		}
		
		#echo "MySQL host info: \n" . mysql_get_host_info($dbh) . "\n";
		
		return $dbh;
	}
	
	public function
		can_log_on()
	{
		try {
			$dbh = $this->get_dbh_no_db_selected();
			
			return isset($dbh);
		} catch (Exception $e) {
			return FALSE;
		}
	}
	
	public function
		get_database()
	{       
		if (!isset($this->database)) {
			$password_file = $this->get_password_file();
			$database_name = $password_file->get_database();
			
			$database_class_factory
				= Database_DatabaseClassFactory::get_instance();
			
			$database_class = $database_class_factory->get_database_class();
			
			$this->database
				= $database_class->newInstance($this, $database_name);
		}
		
		return $this->database;
	}
}
?>