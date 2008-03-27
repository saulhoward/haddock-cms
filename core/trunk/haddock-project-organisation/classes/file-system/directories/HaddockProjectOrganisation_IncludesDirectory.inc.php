<?php
/**
 * HaddockProjectOrganisation_IncludesDirectory
 *
 * @copyright 2007-01-23, RFI
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/file-system/classes/'
#    . 'FileSystem_Directory.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_NavigationLinksFile.inc.php';

/**
 * Represents a directory called:
 *
 * /<MODULE>/(public|admin)-includes/
 *
 * The class is declared abstract because there are
 * different sub-classes for the public and admin
 * includes directories.
 */
abstract class
	HaddockProjectOrganisation_IncludesDirectory
extends
	FileSystem_Directory
{
	private $module_directory;
	
	public function
		__construct(
			$name,
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		parent::__construct($name);
		
		$this->module_directory = $module_directory;
	}
	
	public function
		get_module_directory()
	{
		return $this->module_directory;
	}
	
	##############################################################
	# For finding the navigation links file.
	
	//protected function
	//    get_navigation_links_filename()
	//{
	//    return $this->get_name() . '/pages/navigation-links.txt';
	//}
	//
	//public function
	//    has_navigation_links_file()
	//{
	//    return file_exists($this->get_navigation_links_filename());
	//}
	
	/**
	 * @return
	 *  HaddockProjectOrganisation_NavigationLinksFile
	 *  The navigation links file for this directory.
	 * @throws
	 *  Exception
	 *  If this directory doesn't have a navigation links file.
	 */
	//abstract public function
	//    get_navigation_links_file();
	
	//protected function
	//    get_page_directory_name($page_directory_basename)
	//{
	//    return $this->get_name() . "/pages/$page_directory_basename";
	//}
	//
	//public function
	//    has_page_directory($page_directory_basename)
	//{
	//    return is_dir(
	//        $this->get_page_directory_name($page_directory_basename)
	//    );
	//}
	//
	///**
	// * @param
	// *  string
	// *  $page_directory_basename
	// *  The name of the page whose directory we want.
	// * @return
	// *  HaddockProjectOrganisation_PageDirectory
	// * @throws
	// *  Exception
	// *  If there isn't a directory with this name.
	// */
	//abstract public function
	//    get_page_directory($page_directory_basename);
	
	/*
	 * Functions to do with the pages directory.
	 */
	protected function
		get_pages_directory_name()
	{
		return $this->get_name() . '/pages';
	}
	
	public function
		has_pages_directory()
	{
		return is_dir($this->get_pages_directory_name());
	}
	
	//public function
	//    get_pages_directory()
	//{
	//    if ($this->has_pages_directory()) {
	//        return new HaddockProjectOrganisation_PagesDirectory(
	//            $this->get_pages_directory_name(),
	//            $this
	//        );
	//    } else {
	//        throw new Exception('No pages directory!');
	//    }
	//}
	//abstract public function
	//    get_pages_directory();
}
?>