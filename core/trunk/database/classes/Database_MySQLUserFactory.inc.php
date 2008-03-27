<?php
/**
 * Database_MySQLUserFactory
 * 
 * @copyright 2006-09-17, RFI
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/'
#    . 'Database_MySQLUser.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/'
#    . 'Database_PasswordFile.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/'
#    . 'Database_MySQLRootUser.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

/**
 * Produces MySQL users.
 *
 * Uses the Singleton Pattern.
 */
class
	Database_MySQLUserFactory
{
	/**
	 * The only instance of this class.
	 */
	static private $instance = NULL;
	
	/**
	 * A cache of MySQL user objects.
	 * The key of the array is the name of the 
	 * file that stores the password data.
	 */
	private $mysql_users;
	
	/**
	 * The constructor is private to limit the
	 * number of instances to one (see get_instance()).
	 */
	private function
		__construct()
	{
		$this->mysql_users = array();
	}
	
	/**
	 * Calling
	 *
	 * Database_MySQLUserFactory::get_instance()
	 * 
	 * repeatedly, anywhere in the code, will always
	 * return the same object.
	 */
	public static function
		get_instance()
	{
		#if (self::$instance == NULL) {
		#    self::$instance = new Database_MySQLUserFactory();
		#}
		#
		#return self::$instance;
		if (!isset($_SESSION['mysql-user-factory'])) {
			$_SESSION['mysql-user-factory']
				= new Database_MySQLUserFactory();
		}
		
		return $_SESSION['mysql-user-factory'];
	}
	
	public function
		get_for_pw_file(
			Database_PasswordFile $pw_file
		)
	{
		if (!isset($this->mysql_users[$pw_file->get_name()])) {
			$this->mysql_users[$pw_file->get_name()]
				= new Database_MySQLUser($pw_file);
		}
		
		return $this->mysql_users[$pw_file->get_name()];
	}
	
	private function
		get_passwords_file_for_this_project()
	{
		$project_directory_finder
			= HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

		$project_directory
			= $project_directory_finder->get_project_directory_for_this_project();
		
		//$project_specific_directory
		//    = $project_directory->get_project_specific_directory();
		//
		//$passwords_file = $project_specific_directory->get_passwords_file();
		
		$passwords_file = $project_directory->get_passwords_file();
		
		return $passwords_file;
	}
	
	public function
		get_for_this_project()
	{
		$passwords_file = $this->get_passwords_file_for_this_project();
		
		$mysql_user = $this->get_for_pw_file($passwords_file);
		
		return $mysql_user;
	}
	
	public function
		get_root_user_for_this_project()
	{
		$passwords_file = $this->get_passwords_file_for_this_project();
		
		$root_user = new Database_MySQLRootUser($passwords_file);
		
		return $root_user;
	}
}
?>