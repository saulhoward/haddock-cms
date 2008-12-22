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
        //system('mkdir -p ' . $directory_name);

        $umask = umask();
        //echo "\$umask: $umask\n";

        $recursive = TRUE;

        mkdir($directory_name, $umask, $recursive);
    }
    
    public static function
        delete_recursively($directory_name)
    {
        system('rm -rf ' . $directory_name);
    }
}
?>