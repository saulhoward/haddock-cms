<?php
/**
 * PublicHTML_PageManager
 *
 * @copyright Clear Line Web Design, 2006-11-26
 */

/**
 * Finds the files to be included in a page.
 */
class
    PublicHTML_PageManager
{
    static private $instance = NULL;
    
    private $section;
    private $module;
    private $page;
    private $type;
    
    private $return_to_url;
    
    private $record_inc_files;
    
    private $inc_files;
    
    #private $current_inc_file;
    
    private $debug;
    
    private function
        __construct()
    {
        $this->inc_files = array();
        
        $this->record_inc_files = FALSE;
        
        $this->debug = FALSE;
        #$this->debug = TRUE;
        
        if ($this->debug) {
            header('Content-type: text/plain');
        }
    }
    
    public static function
        get_instance()
    {
        if (self::$instance == NULL) {
            self::$instance = new PublicHTML_PageManager();
        }
        
        return self::$instance;
    }
    
    public function 
        get_section()
    {
        return isset($this->section)
            #? $this->section : 'project-specific';
            ? $this->section : 'haddock';
    }

    public function 
        set_section($section)
    {
        if ($this->debug) {
            echo "\$section: $section\n";
        }
        
        $this->section = $section;
    }
    
    public function 
        get_module()
    {
        if ($this->get_section() == 'project-specific') {
            throw new Exception('Attempt to find the module when the section is project-specific!');
        } else {
            if (isset($this->module)) {
                return $this->module;
            } else {
                if ($this->get_section() == 'haddock') {
                    return 'public-html';
                } else {
                    throw new Exception('Module not set in ' . $this->get_section() . ' section!');
                }
            }
        }
    }

    public function 
        set_module($module)
    {
        if ($this->get_section() == 'project-specific') {
            throw
                new Exception(
                    'Attempt to set the module in the project-specific section!'
                );
        }
        
        if ($this->debug) {
            echo "\$module: $module\n";
        }
        
        $this->module = $module;
    }

    public function 
        get_page()
    {
        return isset($this->page)
            ? $this->page : 'home';
    }

    public function 
        set_page($page)
    {
        if ($this->debug) {
            echo "\$page: $page\n";
        }
        
        $this->page = $page;
    }

    public function 
        get_type()
    {
        return isset($this->type)
            ? $this->type : 'html';
    }

    public function 
        set_type($type)
    {
        if ($this->debug) {
            echo "\$type: $type\n";
        }
        
        $this->type = $type;
    }
    
    public function
        is_page()
    {
        $module_directory = $this->get_module_directory();
        
        $page = $this->get_page();
        $type = $this->get_type();
        
        $includes_directory = NULL;
        
        //if ($module_directory->has_public_includes_directory()) {
        //    $includes_directory = $module_directory->get_public_includes_directory();
        //}
        /*
         * Perhaps we should consider admin-includes directories as well?
         */
        
        if ($module_directory->has_www_includes_directory()) {
            $includes_directory = $module_directory->get_www_includes_directory();
        }
        
        #echo 'get_class($includes_directory): ' . get_class($includes_directory) . "\n";
        
        if (isset($includes_directory)) {
            #echo 'www includes directory found at ' . $includes_directory->get_name() . "\n";
            
            //if ($includes_directory->has_pages_directory()) {
            //    $pages_directory = $includes_directory->get_pages_directory();
            //    
            //    #echo 'get_class($pages_directory): ' . get_class($pages_directory) . "\n";
            //    
            //    if ($pages_directory->has_page_directory($this->get_page())) {
            //        $page_directory = $pages_directory->get_page_directory($this->get_page());
            //        
            //        //echo 'get_class($page_directory): ' . get_class($page_directory) . "\n";
            //        
            //        return TRUE;
            //    //} else {
            //    //    echo 'No page for ' . $this->get_page() . "\n";
            //    }
            //}
            
            return $includes_directory->has_page($page, $type);
        //} else {
        //    echo "No www includes directory found!\n";
        }
        
        return FALSE;
    }
    
    /**
     * When looking for .inc.php files to require for
     * the project's index.php, we should look in the following
     * places in this order:
     *
     *  - The page folder in project-specific and the page.
     *  - The page-elements folder in project-specific.
     *  - The page-elements of the public-html module.
     *
     * See
     *  http://wiki.haddock-cms.com/index.php/Overrides#Order_of_Precedence
     */
    public function
        get_filename(
            $element,
            $section = NULL,
            $module = NULL,
            $page = NULL,
            $type = NULL
        )
    {
        /*
         * Has this element been set already?
         */
        if (isset($this->inc_files[$element])) {
            return PROJECT_ROOT . $this->inc_files[$element];
	}

        /*
         * Which of the optional arguments have been set?
         */
        if (!isset($section)) {
            $section = $this->get_section();
        }
        
        if ($section != 'project-specific') {
            if (!isset($module)) {
                $module = $this->get_module();
            }
        }
        
        if (!isset($page)) {
            $page = $this->get_page();
        }
        
        if (!isset($type)) {
            $type = $this->get_type();
        }
        
        ///*
        // * Is there a .INC file for this element in the project-specific section?
        // */
        //$inc_directory = PROJECT_ROOT . '/project-specific/public-includes';
        //
        //$inc_filename = NULL;
        //$inc_filename = $this->check_possible_includes_directory($inc_directory, $element, $page, $type);
        //
        //if (isset($inc_filename)) {
        //    return $inc_filename;
        //}
        
        /*
         * Set the first choice directory.
         */
        #if ($section != 'project-specific') {
        if ($section == 'project-specific') {
            /*
             * Is there a .INC file in the ps code?
             */
            #$inc_directory = PROJECT_ROOT . "/$section/$module/public-includes";
            $inc_directory = PROJECT_ROOT . '/project-specific/www-includes';
            
            $inc_filename = NULL;
            $inc_filename = $this->check_possible_includes_directory($inc_directory, $element, $page, $type);
            
            if (isset($inc_filename)) {
                return $inc_filename;
            }
        } else {
            /*
             * Is this file overridden in the project-specific folder?
             */
            $inc_directory = PROJECT_ROOT . "/project-specific/www-override-includes/$section/$module";
            
            $inc_filename = NULL;
            $inc_filename = $this->check_possible_includes_directory($inc_directory, $element, $page, $type);
            
            if (isset($inc_filename)) {
                return $inc_filename;
            }
            
            /*
             * Has this element been overridden for all pages of this type?
             */
            $possible_filenames = array();
            $possible_filenames[] = PROJECT_ROOT . "/project-specific/www-override-includes/haddock/public-html/$type/$element.inc.php";
            $possible_filenames[] = PROJECT_ROOT . "/project-specific/www-override-includes/haddock/public-html/$element.inc.php";
            
            foreach ($possible_filenames as $possible_filename) {
                if ($this->debug) {
                    echo "\$possible_filename: $possible_filename\n";
                }
                
                if (is_file($possible_filename)) {
                    return $possible_filename;
                }
            }
            
            /*
             * Is there a .INC file in this section and module?
             */
            #$inc_directory = PROJECT_ROOT . "/$section/$module/public-includes";
            $inc_directory = PROJECT_ROOT . "/$section/$module/www-includes";
            
            $possible_filename = NULL;
            $possible_filename = $this->check_possible_includes_directory($inc_directory, $element, $page, $type);
            
            if (isset($possible_filename)) {
                return $possible_filename;
            }
        }
        
        /*
         * ---------------------------------------------------------------------
         */
        
        /*
         * Fall back to the defaults.
         */
        $possible_filenames = array();
        $possible_filenames[] = PROJECT_ROOT . "/project-specific/www-override-includes/haddock/public-html/$type/$element.inc.php";;
        $possible_filenames[] = PROJECT_ROOT . "/project-specific/www-override-includes/haddock/public-html/$element.inc.php";;
        $possible_filenames[] = PROJECT_ROOT . "/haddock/public-html/www-includes/$type/$element.inc.php";;
        $possible_filenames[] = PROJECT_ROOT . "/haddock/public-html/www-includes/$element.inc.php";;
        
        foreach ($possible_filenames as $possible_filename) {
            if ($this->debug) {
                echo "\$possible_filename: $possible_filename\n";
            }
            
            if (is_file($possible_filename)) {
                return $possible_filename;
            }
        }
        
        $msg = "No element called $element!";
        
        throw new Exception($msg);
    }
    
    protected function
        check_possible_includes_directory(
            $possible_includes_directory,
            $element,
            $page,
            $type
        )
    {
        $possible_filenames = array();
        //$possible_filenames[] = "$possible_includes_directory/pages/$page/$type/$element.inc.php";
        //$possible_filenames[] = "$possible_includes_directory/pages/$page/$element.inc.php";
        //$possible_filenames[] = "$possible_includes_directory/page-elements/$type/$element.inc.php";
        //$possible_filenames[] = "$possible_includes_directory/page-elements/$element.inc.php";
        
        $possible_filenames[] = "$possible_includes_directory/$type/$page/$element.inc.php";
        $possible_filenames[] = "$possible_includes_directory/$type/$element.inc.php";
        $possible_filenames[] = "$possible_includes_directory/$element.inc.php";
        
        foreach ($possible_filenames as $possible_filename) {
            if ($this->debug) {
                echo "\$possible_filename: $possible_filename\n";
            }
            
            if (is_file($possible_filename)) {
                return $possible_filename;
            }
        }
        
        return NULL;
    }
    
    /**
     * Returns true if there is a page called $page_name
     * either in the project specific public-includes folder
     * or in haddock's public-html public-includes folder.
     */
    //public function is_page()
    //{
    //    $first_choice_inc_directory = '';
    //    
    //    if ($this->get_module() == 'project-specific') {
    //        $first_choice_inc_directory = PROJECT_ROOT
    //            . '/project-specific/public-includes/pages/'
    //            . $this->get_page()
    //            . '/'
    //            . $this->get_type();
    //    } else {
    //        if (is_dir(PROJECT_ROOT . '/plug-ins/' . $this->get_module())) {
    //            $first_choice_inc_directory =
    //                PROJECT_ROOT
    //                . '/plug-ins/'
    //                . $this->get_module()
    //                . '/public-includes/pages/'
    //                . $this->get_page()
    //                . '/'
    //                . $this->get_type();
    //        } elseif (is_dir(PROJECT_ROOT . '/haddock/' . $this->get_module())) {
    //            $first_choice_inc_directory =
    //                PROJECT_ROOT
    //                . '/haddock/'
    //                . $this->get_module()
    //                . '/public-includes/pages/'
    //                . $this->get_page()
    //                . '/'
    //                . $this->get_type();
    //        }
    //    }
    //    
    //    #echo "$first_choice_inc_directory\n";
    //    
    //    $haddock_inc_directory = PROJECT_ROOT
    //        . '/haddock/public-html/public-includes/pages/' . $this->get_page();
    //    
    //    return is_dir($first_choice_inc_directory)
    //        or is_dir($haddock_inc_directory);
    //}
    
    public function
        get_script_uri()
    {
        $script_uri = new HTMLTags_URL();
        
        $script_uri->set_file('/');
        
        $script_uri->set_get_variable('section', $this->get_section());
        
        if ($this->get_section() != 'project-specific') {
            $script_uri->set_get_variable('module', $this->get_module());
        }
        
        $script_uri->set_get_variable('page', $this->get_page());
        
        $script_uri->set_get_variable('type', $this->get_type());
        
        return $script_uri;
    }
    
    public function
        get_current_url()
    {
        $current_url = $this->get_script_uri();
        
        if (isset($_SERVER['HTTPS'])) {
            $current_url->set_scheme('https');
        } else {
            $current_url->set_scheme('http');
        }
        
        $current_url->set_domain($_SERVER['HTTP_HOST']);
        
        return $current_url;
    }
    
    public function 
        get_return_to_url()
    {
        if (!isset($this->return_to_url)) {
            $this->return_to_url = $this->get_script_uri();
        }
        
        return $this->return_to_url;
    }

    public function 
        set_return_to_url(HTMLTags_URL $return_to_url)
    {
#	    echo "PublicHTML_PageManager::set_return_to_url(...) called!\n";
#	    exit;
	    
        $this->return_to_url = $return_to_url;
    }
    
    public function
        get_inc_file_as_string(
            $element,
            $section = NULL,
            $module = NULL,
            $page = NULL,
            $type = NULL
        )
    {
        ob_start();
        
        $this->render_inc_file($element, $section, $module, $page, $type);
        
        $ob = ob_get_contents();
        
        ob_clean();
        
        return $ob;
    }
    
    public function
        render_inc_file(
            $element,
            $section = NULL,
            $module = NULL,
            $page = NULL,
            $type = NULL
        )
    {
        if ($this->debug) {
            echo "----------------------------------------\n";
            echo "\$element: $element\n\n";
        }
        
        $filename = $this->get_filename($element, $section, $module, $page, $type);
        
        if ($this->debug) {
            echo "\n\$filename: $filename\n";
        }
        
        require $filename;
        
        if ($this->debug) {
            echo "----------------------------------------\n";
        }
        
        /*
         * This is only used when collating a list of .INC files
         * for caching optimisation.
         */
        if ($this->record_inc_files) {
            $file = new FileSystem_File($filename);
            
            $this->inc_files[$element] = $file->get_name_relative_to_dir(PROJECT_ROOT);
        }
    }
    
    public function
        set_inc_file($element, $filename)
    {
        $this->inc_files[$element] = $filename;
    }
    
    public function
        set_record_inc_files($record_inc_files)
    {
        $this->record_inc_files = $record_inc_files;
    }
//    
//        public function 
//                get_return_to_url()
//    {
//        if (!isset($this->return_to_url)) {
//            $this->return_to_url = $this->get_script_uri();
//        }
//        
//        return $this->return_to_url;
//    }
    
    public function
        get_inc_files()
    {
        return $this->inc_files;
    }
   
//    public function 
//        set_return_to_url(HTMLTags_URL $return_to_url)
//    {
//        $this->return_to_url = $return_to_url;
//    }
//    
//    public function
//        render_inc_file(
//            $element,
//            $section = NULL,
//            $module = NULL,
//            $page = NULL,
//            $type = NULL
//        )
//    {
//        #echo "----------------------------------------\n";
//        
//        #echo "\$element: $element\n\n";
//        
//        $filename = $this->get_filename($element, $section, $module, $page, $type);
//        
//        #echo "\n\$filename: $filename\n";
//        
//        require $filename;
//        
//        #echo "----------------------------------------\n";
//    }
//    
//    public function
//        get_inc_file_as_string(
//            $element,
//            $section = NULL,
//            $module = NULL,
//            $page = NULL,
//            $type = NULL
//        )
//    {
//        ob_start();
//        
//        $this->render_inc_file($element, $section, $module, $page, $type);
//        
//        $ob = ob_get_contents();
//        
//        ob_clean();
//        
//        return $ob;
//    }
    
    /**
     * @return HaddockProjectOrganisation_ModuleDirectory
     *  The module directory where this page request lives.
     */
    public function
        get_module_directory()
    {
        $pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
        $pd = $pdf->get_project_directory_for_this_project();
        
        if ($this->get_section() == 'project-specific') {
            return $pd->get_project_specific_directory();
        } else {
            if ($this->get_section() == 'plug-ins') {
                return $pd->get_plug_in_module_directory($this->get_module());
            }
            
            if ($this->get_section() == 'haddock') {
                return $pd->get_core_module_directory($this->get_module());
            }
        }
        
        throw new Exception('No module directory found!');
    }
//    
//    public function 
//        set_return_to_url(HTMLTags_URL $return_to_url)
//    {
//        $this->return_to_url = $return_to_url;
//    }
//    
//    public function
//        render_inc_file(
//            $element,
//            $section = NULL,
//            $module = NULL,
//            $page = NULL,
//            $type = NULL
//        )
//    {
//        #echo "----------------------------------------\n";
//        
//        #echo "\$element: $element\n\n";
//        
//        $filename = $this->get_filename($element, $section, $module, $page, $type);
//        
//        #echo "\n\$filename: $filename\n";
//        
//        require $filename;
//        
//        #echo "----------------------------------------\n";
//    }
//    
//    public function
//        get_inc_file_as_string(
//            $element,
//            $section = NULL,
//            $module = NULL,
//            $page = NULL,
//            $type = NULL
//        )
//    {
//        ob_start();
//        
//        $this->render_inc_file($element, $section, $module, $page, $type);
//        
//        $ob = ob_get_contents();
//        
//        ob_clean();
//        
//        return $ob;
//    }
}    
?>
