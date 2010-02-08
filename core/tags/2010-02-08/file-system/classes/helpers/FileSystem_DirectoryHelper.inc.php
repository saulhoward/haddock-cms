<?php
/**
 * FileSystem_DirectoryHelper
 *
 * @copyright 2008-06-11, RFI
 */

class
    FileSystem_DirectoryHelper
{
    /**
     * Creates directories nested to an arbitrary depth.
     *
     * TODO Make this portable.
     *
     * @param string $directory_name The name of the directory to create.
     */
    public static function
        mkdir_parents($directory_name)
    {
//        echo '__METHOD__: ' . __METHOD__ . "\n";
//        echo "\$directory_name: $directory_name\n";
        
        //system('mkdir -p ' . $directory_name);

        /*
         * TODO Make this settable in a config file somewhere.
         */
        $mode = 0755;
        $recursive = TRUE;

        mkdir($directory_name, $mode, $recursive);
    }
    
    public static function
        delete_recursively($directory_name)
    {
        system('rm -rf ' . $directory_name);
    }
}
?>