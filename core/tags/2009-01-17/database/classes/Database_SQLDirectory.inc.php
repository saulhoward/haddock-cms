<?php
/**
 * Database_SQLDirectory
 *
 * @copyright Clear Line Web Design, 2007-01-26
 */

require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_Directory.inc.php';

class
    Database_SQLDirectory
extends
    FileSystem_Directory
{
    ##################################################################
    # For finding the database class names override files.
    
    private function get_database_class_name_override_filename()
    {
        $database_class_name_override_filename
            = $this->get_name() . '/sql/database-class-name-overrides.txt';
        
        return $database_class_name_override_filename;
    }
    
    public function has_database_class_name_override_file()
    {
        return is_file($this->get_database_class_name_override_filename());
    }
    
    public function get_database_class_name_override_file()
    {
        if ($this->has_database_class_name_override_file()) {
            return
                new Database_ElementSubclassOverrideFile(
                    $this,
                    $this->get_database_class_name_override_filename()
                );
        }
        
        return null;
    }
}
?>
