<?php
/**
 * FileSystem_PHPIncFile
 *
 * @copyright Clear Line Web Design, 2007-05-30
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_TextFile.inc.php';

/**
 * A class to represent a PHP .INC file.
 */
class
    FileSystem_PHPIncFile
extends
    FileSystem_TextFile
{
    public function
        include_self()
    {
        include $this->get_name();
    }
    
    public function
        include_once_self()
    {
        include_once $this->get_name();
    }
    
    public function
        require_self()
    {
        require $this->get_name();
    }
    
    public function
        require_once_self()
    {
        require_once $this->get_name();
    }
}
?>
