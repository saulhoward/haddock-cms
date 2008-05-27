<?php
/**
 * Database_PasswordFile
 *
 * @copyright 2006-11-16, RFI
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#	. '/haddock/file-system/classes/'
#	. 'FileSystem_PHPIncFile.inc.php';

/**
 * Used to extract and store the data used to
 * log onto the database.
 */
class
	Database_PasswordFile
extends
	FileSystem_PHPIncFile
{
	private $host;
	private $database;
	private $username;
	private $password;
	
	public function
		get_host()
	{
		if (!isset($this->host)) {
			$this->require_once_self();
			
			#$key_value_pairs = $this->get_key_value_pairs();
			#$this->host = $key_value_pairs['host'];
			
			$this->host = DB_HOST;
		}
		
		return $this->host;
	}
	
	public function
		set_host($host)
	{
		$this->host = $host;
	}
	
	public function
		get_database()
	{
		if (!isset($this->database)) {
			$this->require_once_self();
			
			#$key_value_pairs = $this->get_key_value_pairs();
			#$this->database = $key_value_pairs['database'];
			
			$this->database = DB_DATABASE;
		}
		
		return $this->database;
	}

	public function
		set_database($database)
	{
		$this->database = $database;
	}
	
	public function
		get_username()
	{
		if (!isset($this->username)) {
			$this->require_once_self();
			
			#$key_value_pairs = $this->get_key_value_pairs();
			#$this->username = $key_value_pairs['username'];
			
			$this->username = DB_USERNAME;
		}
		
		return $this->username;
	}

	public function
		set_username($username)
	{
		$this->username = $username;
	}
	
	public function
		get_password()
	{
		if (!isset($this->password)) {
			$this->require_once_self();
			
			#$key_value_pairs = $this->get_key_value_pairs();
			#$this->password = $key_value_pairs['password'];
			
			$this->password = DB_PASSWORD;
		}
		
		return $this->password;
	}

	public function
		set_password($password)
	{
		$this->password = $password;
	}
	
	public function
		commit()
	{
		$file_handle = fopen($this->get_name(), 'w');
		
		fwrite($file_handle, "<?php\n");
		
		$date = date('Y-m-d');
		
		# Set the date.
		fwrite($file_handle, "# $date\n");
		
		#fwrite($file_handle, 'host=' . $this->get_host() . "\n");
		#fwrite($file_handle, 'database=' . $this->get_database() . "\n");
		#fwrite($file_handle, 'username=' . $this->get_username() . "\n");
		#fwrite($file_handle, 'password=' . $this->get_password() . "\n");

		fwrite($file_handle, "define('DB_HOST', '" . $this->get_host() . "');\n");
		fwrite($file_handle, "define('DB_DATABASE', '" . $this->get_database() . "');\n");
		fwrite($file_handle, "define('DB_USERNAME', '" . $this->get_username() . "');\n");
		fwrite($file_handle, "define('DB_PASSWORD', '" . $this->get_password() . "');\n");
		
		fwrite($file_handle, "?>\n");
		
		fclose($file_handle);
	}
}
?>