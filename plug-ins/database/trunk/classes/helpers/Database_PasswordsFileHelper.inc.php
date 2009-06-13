<?php
/**
 * Database_PasswordsFileHelper
 *
 * @copyright 2008-05-27, RFI
 */

class
	Database_PasswordsFileHelper
{
	public static function
		create_passwords_file(
			$username,
			$password,
			$database,
			$host
		)
	{
		$directory = PROJECT_ROOT;
		
		/*
		 * Create the passwords directory if necessary.
		 */
		$passwords_directory = PROJECT_ROOT . '/passwords';
		if (!is_dir($passwords_directory)) {
			mkdir($passwords_directory);
		}

		/*
		 * Create a date string.
		 */
		$date = date('Y-m-d');

		/*
		 * Write the .htaccess file.
		 */
		$passwords_directory_htaccess_file = "$passwords_directory/.htaccess";
		if (!is_file($passwords_directory_htaccess_file)) { 
			$htaccess = <<<HTA
# Restrict Access to the passwords folder.
# © $date

Order Deny,Allow
Deny from all

HTA;

			if ($fh = fopen($passwords_directory_htaccess_file, 'w')) {
				fwrite($fh, $htaccess);
				
				fclose($fh);
			}
		}
		
		/*
		 * Write the passwords .INC file.
		 */
		$passwords_file = "$passwords_directory/passwords.inc.php";
		if (!is_file($passwords_file)) {    
			$pw_file = <<<PWF
<?php
/**
 * Passwords for accessing $database on $host.
 *
 * @copyright $date
 */

define('DB_USERNAME', '$username');
define('DB_PASSWORD', '$password');
define('DB_DATABASE', '$database');
define('DB_HOST', '$host');

?>
PWF;

			if ($fh = fopen($passwords_file, 'w')) {
				fwrite($fh, $pw_file);
				
				fclose($fh);
			}
		}
    }
	
	public static function
		get_passwords_file()
	{
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo 'File: ' . __FILE__ . PHP_EOL;
			echo 'Line: ' . __LINE__ . PHP_EOL;
			echo 'Method: ' . __METHOD__ . PHP_EOL;
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		#$project_directory_finder
		#	= HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
		#	
		#$project_directory
		#	= $project_directory_finder->get_project_directory_for_this_project();
		$project_directory
			= HaddockProjectOrganisation_ProjectDirectoryHelper
				::get_project_directory();
		
		$passwords_file = $project_directory->get_passwords_file();
		
		return $passwords_file;
	}
}
?>