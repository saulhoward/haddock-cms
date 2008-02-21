<?php
/**
 * HaddockProjectOrganisation_PublicPageDirectory
 *
 * @copyright Clear Line Web Design, 2007-07-30
 */

class
    HaddockProjectOrganisation_PublicPageDirectory
extends
    FileSystem_Directory
{
    public function
        get_page_name()
    {
        return basename($this->get_name());
    }
    
    public function
        get_types()
    {
        $types = array();
        
        foreach ($this->get_subdirectories() as $sd) {
            $types[] = $sd->basename();
        }
        
        return $types;
    }
}
?>
