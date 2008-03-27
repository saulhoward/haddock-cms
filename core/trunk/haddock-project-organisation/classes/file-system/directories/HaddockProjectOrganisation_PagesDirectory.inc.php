<?php
/**
 * HaddockProjectOrganisation_PagesDirectory
 *
 * @copyright Clear Line Web Design, 2007-08-01
 */

abstract class
	HaddockProjectOrganisation_PagesDirectory
extends
    FileSystem_Directory
{
    private $includes_directory;
    
    public function
        __construct(
            $name,
            HaddockProjectOrganisation_IncludesDirectory $includes_directory
        )
    {
        parent::__construct($name);
        
        $this->includes_directory = $includes_directory;
    }
    
    public function
        get_includes_directory()
    {
        return $this->includes_directory;
    }
    
    //public function
    //    get_page_directories()
    //{
    //    $page_directories = array();
    //    
    //    foreach ($this->get_subdirectories() as $sd) {
    //        $page_directories[] = new HaddockProjectOrganisation_PageDirectory(
    //            $sd->get_name(),
    //            $this
    //        );
    //    }
    //    
    //    return $page_directories;
    //}
    abstract public function
        get_page_directories();
    
    public function
        has_page_directory($page_name)
    {
        return is_dir($this->get_name() . "/$page_name");
    }
    
    abstract public function
        get_page_directory($page_name);
}
?>
