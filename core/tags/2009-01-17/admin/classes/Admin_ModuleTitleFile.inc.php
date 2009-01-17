<?php
/**
 * Admin_ModuleTitleFile
 *
 * © Clear Line Web Design, 2007-01-07
 */

require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_DataFile.inc.php';

class Admin_ModuleTitleFile extends FileSystem_DataFile
{
    public function get_module_title()
    {
        $key_value_pairs = $this->get_key_value_pairs();
        
        return $key_value_pairs['title'];
    }
}
?>
