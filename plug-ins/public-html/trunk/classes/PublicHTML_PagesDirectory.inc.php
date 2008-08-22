<?php
/**
 * PublicHTML_PagesDirectory
 *
 * @copyright Clear Line Web Design, 2007-08-01
 */

class
	PublicHTML_PagesDirectory
extends
    HaddockProjectOrganisation_PagesDirectory
{
    public function
        get_page_directories()
    {
        $page_directories = array();
        
        foreach ($this->get_subdirectories() as $sd) {
            $page_directories[] = new PublicHTML_PageDirectory(
                $sd->get_name(),
                $this
            );
        }
        
        return $page_directories;
    }
	
	public function
		get_page_directory($page_name)
	{
		return new PublicHTML_PageDirectory($this->get_name() . "/$page_name", $this);
	}
}
?>
