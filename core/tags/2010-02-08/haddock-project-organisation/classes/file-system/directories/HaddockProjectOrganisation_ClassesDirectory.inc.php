<?php
/**
 * HaddockProjectOrganisation_ClassesDirectory
 *
 * @copyright Clear Line Web Design, 2007-01-26
 */

require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_Directory.inc.php';

class
    HaddockProjectOrganisation_ClassesDirectory
extends
    FileSystem_Directory
{
    /**
     * @var
     *  HaddockProjectOrganisation_ModuleDirectory
     *  The directory of the module that defines these classes.
     */
    private $module_directory;
    
    public function
        __construct(
            $name,
            HaddockProjectOrganisation_ModuleDirectory $module_directory
        )
    {
        parent::__construct($name);
        
        $this->module_directory = $module_directory;
    }
    
    public function
        get_module_directory()
    {
        return $this->module_directory;
    }
    
    /**
     * Finds all the PHP class files that are defined in this module.
     *
     * Classes must be defined in the 'classes' sub-directory.
     *
     * @return
     *  FileSystem_PHPClassFile[]
     *  The class files of this module.
     */
    public function
        get_php_class_files()
    {
        $php_class_files = array();
        
        $files = $this->get_files_by_extension_recursively('inc.php');
        
        #print_r($files);
        
        foreach ($files as $file) {
            $php_class_files[]
                = new FileSystem_PHPClassFile($file->get_name());
        }
        
        return $php_class_files;
    }
    
    /*
     * Generates the filename for a DB class.
     */
    public function
        get_filename_for_db_class($entity, $type, $class_name)
    {
        $fn = $this->get_name();
        
        $fn .= '/database';
        
        if ($entity == 'element') {
            $fn .= '/elements';
        } elseif ($entity == 'renderer') {
            $fn .= '/renderers';
        }
        
        $fn .= "/$type-subclasses";
        
        $fn .= "/$class_name.inc.php";
        
        return $fn;
    }
}
?>
