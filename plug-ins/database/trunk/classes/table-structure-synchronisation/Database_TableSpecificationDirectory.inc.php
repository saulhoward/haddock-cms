<?php
/**
 * Database_TableSpecificationDirectory
 *
 * @copyright Clear Line Web Design, 2007-02-02
 */

#require_once PROJECT_ROOT
#    . '/haddock/database/classes/table-structure-synchronisation/'
#    . 'Database_TableSpecificationFile.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/file-system/classes/'
#    . 'FileSystem_Directory.inc.php';
    
class
    Database_TableSpecificationDirectory
extends
    FileSystem_Directory
{
    private function
        get_filename_for_table(
            Database_Table $table
        )
    {
        return $this->get_name() . '/' . $table->get_name() . '.txt';
    }
    
    public function
        has_file_for_table(
            Database_Table $table
        )
    {
        $file_name = $this->get_filename_for_table($table);
        
        return file_exists($file_name);
    }
    
    public function
        create_file_for_table(
            Database_Table $table
        )
    {
        $file_name = $this->get_filename_for_table($table);
        
        touch($file_name);
    }
    
    public function
        get_file_for_table(
            Database_Table $table
        )
    {
        $file_name = $this->get_filename_for_table($table);
        
        if ($this->has_file_for_table($table)) {
            return new Database_TableSpecificationFile($file_name);
        } else {
            throw new Exception("$file_name does not exist!");
        }
    }
}
?>
