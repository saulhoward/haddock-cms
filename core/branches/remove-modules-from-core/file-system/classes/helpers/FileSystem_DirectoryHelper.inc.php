<?php
/**
 * FileSystem_DirectoryHelper
 *
 * @copyright 2008-06-11, RFI
 */

class
    FileSystem_DirectoryHelper
{
    public static function
        mkdir_parents($directory_name)
    {
        system('mkdir -p ' . $directory_name);
    }
    
    public static function
        delete_recursively($directory_name)
    {
        system('rm -rf ' . $directory_name);
    }
}
?>