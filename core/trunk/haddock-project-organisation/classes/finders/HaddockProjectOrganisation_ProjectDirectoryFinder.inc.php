<?php
/**
 * HaddockProjectOrganisation_ProjectDirectoryFinder
 *
 * @copyright Clear Line Web Design, 2006-11-13
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/'
#	. 'HaddockProjectOrganisation_ProjectDirectory.inc.php';

/**
 * Creates the Project Directory objects.
 *
 * Uses the singleton pattern.
 */
class
	HaddockProjectOrganisation_ProjectDirectoryFinder
{
	static private $instance = NULL;
	
	private $project_directories;
	
	private function
		__construct()
	{
	}
	
	public static function
		get_instance()
	{
	if (self::$instance == NULL) {
		self::$instance
		= new HaddockProjectOrganisation_ProjectDirectoryFinder();
	}

	return self::$instance;

#        if (!isset($_SESSION['project-directory-finder'])) {
#            $_SESSION['project-directory-finder']
#                = new HaddockProjectOrganisation_ProjectDirectoryFinder();
#        }
#        
#        return $_SESSION['project-directory-finder'];
	}
	
	public function
		__toString()
	{
		$str = '';
		
		$reflection_object = new ReflectionObject($this);
		
		$str .= 'Start: ' . $reflection_object->getName() . "\n";
		
		$str .= "\$this->project_directories:\n";
		
		if (count($this->project_directories) == 0) {
			$str .= "<Empty List>\n";
		} else {
			foreach ($this->project_directories as $p_d) {
				$str .= $p_d;
				$str .= "\n";
			}
		}
		
		$str .= 'End: ' . $reflection_object->getName() . "\n";
		
		return $str;
	}
	
	public function
		get_project_directory($directory_name)
	{
		if (!isset($this->project_directories[$directory_name])) {
			$this->project_directories[$directory_name]
				= new HaddockProjectOrganisation_ProjectDirectory(
					$directory_name
				);
		}
		
		return $this->project_directories[$directory_name];
	}
	
	public function
		get_project_directory_for_this_project()
	{
		return $this->get_project_directory(PROJECT_ROOT);
	}
}
?>