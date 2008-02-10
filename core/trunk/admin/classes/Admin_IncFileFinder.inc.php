<?php
/**
 * Admin_IncFileFinder
 *
 * @copyright Clear Line Web Design, 2006-11-20
 */

/**
 * Finds the files to be included in a page.
 */
class
    Admin_IncFileFinder
{
    static private $instance = NULL;
    
    private function __construct()
    {
    }
    
    public static function get_instance()
    {
        if (self::$instance == NULL) {
            self::$instance = new Admin_IncFileFinder();
        }
        
        return self::$instance;
    }
    
    /**
     * When looking for .inc.php files to require for
     * admin's index.php, we should look in the following
     * places in this order:
     *
     *  - The admin page folder for the module and the page.
     *  - The admin page-elements folder of the module.
     *  - The page folder for the admin module.
     *  - The page-elements of the admin module.
     */
    public function get_filename($element_name)
    {
        $filename = '';
        
        #$possible_file_name =
        #    PROJECT_ROOT
        #    . '/haddock/'
        #    . MODULE
        #    . '/admin-includes/pages/'
        #    . PAGE
        #    . '/'
        #    . $element_name
        #    . '.inc.php';
        #if (file_exists($possible_file_name)) {
        #    $filename = $possible_file_name;
        #} else {
        #    $possible_file_name =
        #        PROJECT_ROOT
        #        . '/haddock/'
        #        . MODULE
        #        . '/admin-includes/page-elements/'
        #        . $element_name
        #        . '.inc.php';
        #    if (file_exists($possible_file_name)) {
        #        $filename = $possible_file_name;
        #    } else {
        #        $filename =
        #            PROJECT_ROOT
        #            . '/haddock/admin/admin-includes/page-elements/'
        #            . $element_name
        #            . '.inc.php';
        #    }
        #}
        
        if (MODULE == 'project-specific') {
            $possible_file_name =
                PROJECT_ROOT
                . '/project-specific/'
                . '/admin-includes/pages/'
                . PAGE
                . '/'
                . $element_name
                . '.inc.php';
            
            if (file_exists($possible_file_name)) {
                $filename = $possible_file_name;
            } else {
                $possible_file_name =
                    PROJECT_ROOT
                    . '/project-specific/'
                    . '/admin-includes/page-elements/'
                    . $element_name
                    . '.inc.php';
                    
                if (file_exists($possible_file_name)) {
                    $filename = $possible_file_name;
                }
            }
        } else {
            /*
             * Core modules
             */
            $possible_file_name =
                PROJECT_ROOT
                . '/haddock/'
                . MODULE
                . '/admin-includes/pages/'
                . PAGE
                . '/'
                . $element_name
                . '.inc.php';
            
            if (file_exists($possible_file_name)) {
                $filename = $possible_file_name;
            } else {
                $possible_file_name =
                    PROJECT_ROOT
                    . '/haddock/'
                    . MODULE
                    . '/admin-includes/page-elements/'
                    . $element_name
                    . '.inc.php';
                    
                if (file_exists($possible_file_name)) {
                    $filename = $possible_file_name;
                }
            }
            
            if (strlen($filename) == 0) {
                /*
                 * Plug-in modules
                 */
                $possible_file_name =
                    PROJECT_ROOT
                    . '/plug-ins/'
                    . MODULE
                    . '/admin-includes/pages/'
                    . PAGE
                    . '/'
                    . $element_name
                    . '.inc.php';
                
                #echo "\$possible_file_name: $possible_file_name\n";
                
                if (file_exists($possible_file_name)) {
                    $filename = $possible_file_name;
                } else {
                    $possible_file_name =
                        PROJECT_ROOT
                        . '/plug-ins/'
                        . MODULE
                        . '/admin-includes/page-elements/'
                        . $element_name
                        . '.inc.php';
                        
                    if (file_exists($possible_file_name)) {
                        $filename = $possible_file_name;
                    }
                }
            }
        }
        
        if (strlen($filename) == 0) {
            $possible_file_name =
                PROJECT_ROOT
                . '/haddock/admin/admin-includes/pages/'
                . PAGE
                . '/'
                . $element_name
                . '.inc.php';
            
            if (file_exists($possible_file_name)) {
                $filename = $possible_file_name;
            } else {
                $possible_file_name =
                    PROJECT_ROOT
                    . '/haddock/admin/admin-includes/page-elements/'
                    . $element_name
                    . '.inc.php';
                    
                if (file_exists($possible_file_name)) {
                    $filename = $possible_file_name;
                }
            }
        }
        
        return $filename;
    }
    
    public function is_page($page_name)
    {
        $project_specific_inc_directory = PROJECT_ROOT
            . '/project-specific/admin-includes/pages/' . $page_name;
        $haddock_inc_directory = PROJECT_ROOT
            . '/haddock/' . MODULE . '/admin-includes/pages/' . $page_name;
        $plug_in_inc_directory = PROJECT_ROOT
            . '/plug-ins/' . MODULE . '/admin-includes/pages/' . $page_name;
        $admin_inc_directory = PROJECT_ROOT
            . '/haddock/admin/admin-includes/pages/' . $page_name;
        
        #echo "\$haddock_inc_directory: $haddock_inc_directory\n";
        
        return is_dir($project_specific_inc_directory)
            or is_dir($haddock_inc_directory)
            or is_dir($plug_in_inc_directory)
            or is_dir($admin_inc_directory);
    }
}
?>
