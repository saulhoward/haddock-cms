<?php
/**
 * Admin_PagesDirectory
 *
 * @copyright Clear Line Web Design, 2007-08-03
 */

class
	Admin_PagesDirectory
extends
    HaddockProjectOrganisation_PagesDirectory
{
    public function
        get_page_directories()
    {
        $page_directories = array();
        
        foreach ($this->get_subdirectories() as $sd) {
            $page_directories[] = new Admin_PageDirectory($sd->get_name(), $this);
        }
        
        return $page_directories;
    }
    
    public function
		get_page_directory($page_name)
	{
		return new Admin_PageDirectory($this->get_name() . "/$page_name", $this);
	}
}
?>
