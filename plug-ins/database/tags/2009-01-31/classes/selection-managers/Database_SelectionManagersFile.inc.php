<?php
/**
 * Database_SelectionManagersFile
 *
 * @copyright Clear Line Web Design, 2007-03-16
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_DataFile.inc.php';

class
    Database_SelectionManagersFile
extends
    FileSystem_DataFile
{
    public function
        has_selection_manager($table)
    {
        #echo "In Database_SelectionManagersFile::has_selection_manager(...)\n";
        
        return $this->has_value_for($table);
    }
    
    public function
        get_selection_manager_filename($table)
    {
        if ($this->has_selection_manager($table)) {
            return PROJECT_ROOT . $this->get_value_for($table);
        } else {
            throw new Exception("No selection for $table!");
        }
    }
}
?>
