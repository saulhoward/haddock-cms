<?php
/**
 * PublicHTML_ProjectRootDotHTAcessFileTests
 *
 * @copyright 2008-06-12, RFI
 */

class
    PublicHTML_ProjectRootDotHTAcessFileTests
{
    private static function
        get_project_root_dot_htaccess_file_name()
    {
        return PROJECT_ROOT . DIRECTORY_SEPARATOR . '.htaccess';
    }
    
    public static function
        test_dot_htaccess_file_exists()
    {
        $project_root_dot_htaccess_file_name
            = self::get_project_root_dot_htaccess_file_name();
        
        return file_exists($project_root_dot_htaccess_file_name);
    }
}
?>