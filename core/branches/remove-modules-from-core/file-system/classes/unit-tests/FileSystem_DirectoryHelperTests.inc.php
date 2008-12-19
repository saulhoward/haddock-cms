<?php
/**
 * FileSystem_DirectoryHelperTests
 *
 * @copyright 2008-06-11, RFI
 */

/**
 * Tests for the FileSystem_DirectoryHelper class.
 *
 * TODO Make this code more portable.
 */
class
    FileSystem_DirectoryHelperTests
extends
    UnitTests_UnitTests
{
    private static function
        get_test_dir_name()
    {
        return '/tmp/haddock-file-system-tests';
    }
    
    public static function
        set_up()
    {
        mkdir(self::get_test_dir_name());
    }
    
    public static function
        tear_down()
    {
        system(
            'rm -rf ' . self::get_test_dir_name()
        );
    }
    
    /*
     * ----------------------------------------
     * The test.
     * ----------------------------------------
     */
    
    public function
        test_mkdir_parents_three_levels_deep()
    {
        $tld_dir_name
            = self::get_test_dir_name()
                . DIRECTORY_SEPARATOR . 'bing'
                . DIRECTORY_SEPARATOR . 'bang'
                . DIRECTORY_SEPARATOR . 'bong';
        
        FileSystem_DirectoryHelper::mkdir_parents($tld_dir_name);
        
        return is_dir($tld_dir_name);
    }
}
?>