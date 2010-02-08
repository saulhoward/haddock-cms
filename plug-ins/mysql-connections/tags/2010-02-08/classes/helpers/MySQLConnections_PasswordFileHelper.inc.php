<?php
/**
 * MySQLConnections_PasswordFileHelper
 *
 * @copyright 2009-01-31, Robert Impey
 */

class
	MySQLConnections_PasswordFileHelper
{
	public static function
		create_password_file(
			$user,
			$password,
			$database,
			$host
		)
	{
		/*
		 * Create the passwords directory if necessary.
		 */
		if (!is_dir(self::get_password_directory_name())) {
			self::create_password_directory();
		}

		/*
		 * Write the passwords .INC file.
		 */
		$password_file_name = self::get_password_file_name();
		if (!is_file($password_file_name)) {
			$copyright_string = self::get_copyright_string();
			
			$password_file_content = <<<PWF
<?php
/**
 * Database for accessing $database on $host as $user.
 *
 * @copyright $copyright_string
 */

define('MYSQL_CONNECTIONS_USER', '$user');
define('MYSQL_CONNECTIONS_PASSWORD', '$password');
define('MYSQL_CONNECTIONS_DATABASE', '$database');
define('MYSQL_CONNECTIONS_HOST', '$host');

?>
PWF;

			if ($fh = fopen($password_file_name, 'w')) {
				fwrite($fh, $password_file_content);
				
				fclose($fh);
			}
		}
    }
	
	public static function
		define_password_data()
	{
		require_once self::get_password_file_name();
	}
	
	private static function
		get_password_file_name()
	{
		$password_file_name
			= self::get_password_directory_name() . '/password.inc.php';
		
		return $password_file_name;
	}
	
	private static function
		get_password_directory_name()
	{
		return PROJECT_ROOT . '/mysql-connections-password';
	}
	
	private static function
		create_password_directory()
	{
		$password_directory_name = self::get_password_directory_name();
		
		mkdir($password_directory_name);
		
		$copyright_string = self::get_copyright_string();
		
		/*
		 * Write the .htaccess file.
		 */
		$password_directory_htaccess_file_name
			= "$password_directory_name/.htaccess";
		if (!is_file($password_directory_htaccess_file_name)) { 
			$htaccess = <<<HTA
# Restrict access to the password folder.
# © $copyright_string

Order Deny,Allow
Deny from all

HTA;

			if ($fh = fopen($password_directory_htaccess_file_name, 'w')) {
				fwrite($fh, $htaccess);
				
				fclose($fh);
			}
		}
	}
	
	private static function
		get_copyright_string()
	{
		$copyright_string = '';
		
		/*
		 * Create a date string.
		 */
		$date = date('Y-m-d');
		
		/*
		 * Get the name of the copyright holder of the project.
		 */
		$copyright_holder
			= HaddockProjectOrganisation_ProjectInformationHelper
				::get_copyright_holder();
		
		$copyright_string .= "$date, $copyright_holder";
		
		return $copyright_string;
	}
}
?>