<?php
/**
 * HaddockProjectOrganisation_AutoloadIncFile
 *
 * @copyright Clear Line Web Design, 2007-05-11
 */

require_once PROJECT_ROOT
	. '/haddock/file-system/classes/'
	. 'FileSystem_PHPIncFile.inc.php';

require_once PROJECT_ROOT
	. '/haddock/haddock-project-organisation/classes/'
	. 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';
	
class
	HaddockProjectOrganisation_AutoloadIncFile
extends
	FileSystem_PHPIncFile
{
	public function
		get_project_directory()
	{
		$project_directory_finder
			= HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
		
		$project_directory
			= $project_directory_finder->get_project_directory_for_this_project();
		
		return $project_directory;
	}
		
	public function
		refresh()
	{
		unlink($this->get_name());
		
		#touch($this->get_name());
		
		$contents = '';
		$date = date('Y-m-d');
		
		$contents .= <<<CNT
<?php
/**
 * __autoload .INC file
 *
 * Last Modified: $date
 */

function __autoload(\$class_name)
{
	switch (\$class_name) {
	
CNT;
		
		$project_directory = $this->get_project_directory();
		
		$php_class_files = $project_directory->get_php_class_files();
		
		foreach ($php_class_files as $p_c_f) {
			$contents .= "\n\t\tcase('" . $p_c_f->get_php_class_name() . "'): \n";
			
			$contents .= "\t\t\trequire_once PROJECT_ROOT . '" . $p_c_f->get_name_relative_to_dir(PROJECT_ROOT) . "';\n";
			
			$contents .= "\t\t\tbreak;\n";
		}
		
		$contents .= <<<CNT
		
	}
}

?>

CNT;
		
		file_put_contents($this->get_name(), $contents);
	}
}
?>