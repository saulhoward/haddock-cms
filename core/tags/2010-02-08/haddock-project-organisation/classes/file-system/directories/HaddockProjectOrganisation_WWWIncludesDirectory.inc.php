<?php
/**
 * HaddockProjectOrganisation_WWWIncludesDirectory
 *
 * @copyright 2007-08-10, RFI
 */

#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/'
#	. 'HaddockProjectOrganisation_IncludesDirectory.inc.php';

/**
 * Should this be moved to the core/public-html module?
 */
class
	HaddockProjectOrganisation_WWWIncludesDirectory
extends
	HaddockProjectOrganisation_IncludesDirectory
{
	private function
		get_page_dir_name($page, $type)
	{
		$page_dir_name = $this->get_name() . "/$type/$page";
		
		#echo "\$page_dir_name: $page_dir_name\n";
		
		return $page_dir_name;
	}
	
	public function
		has_page($page, $type)
	{
		return is_dir($this->get_page_dir_name($page, $type));
	}
	
	public function
		create_page_directory($page_name, $page_type)
	{
		if ($this->has_page($page_name, $page_type)) {
			#echo "Already has a dir for a page called $page_name of type $page_type.\n";
		} else {
			#echo "Creating a dir for a page called $page_name of type $page_type.\n";
			
			$pdn = $this->get_page_dir_name($page_name, $page_type);
			
			#echo "\$pdn: $pdn\n";
			
			mkdir($pdn, 0755, TRUE);
		}
	}
	
	public function
		get_page_directory($page_name, $page_type)
	{
		if ($this->has_page($page_name, $page_type)) {
			$page_directory = new HaddockProjectOrganisation_WWWPageDirectory(
				$this->get_page_dir_name($page_name, $page_type),
				$this
			);
			
			return $page_directory;
		} else {
			throw new Exception("No dir for a page called $page_name of type $page_type!");
		}
	}
}
?>