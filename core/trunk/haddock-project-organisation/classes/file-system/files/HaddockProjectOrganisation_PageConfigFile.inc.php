<?php
/**
 * HaddockProjectOrganisation_PageConfigFile
 *
 * @copyright Clear Line Web Design, 2007-01-16
 */

require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_DataFile.inc.php';

class
    HaddockProjectOrganisation_PageConfigFile
extends
    FileSystem_DataFile
{
    public function
        has_page_title()
    {
        return $this->has_value_for('page-title', '=');
    }
    
    public function
        get_page_title()
    {
        return $this->get_value_for('page-title', '=');
    }
}
?>
