<?php
/**
 * CLIScripts_BinIncludesDirectory
 *
 * @copyright Clear Line Web Design, 2007-08-03
 */

class
	CLIScripts_BinIncludesDirectory
extends
    FileSystem_Directory
{
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
    
    public function
        get_script_directories()
    {
        $script_directories = array();
        
        if ($this->has_scripts_directory()) {
            $scripts_directory = $this->get_scripts_directory();
            $script_directories = $scripts_directory->get_script_directories();
        }
        
        return $script_directories;
    }
    
    private function
        get_scripts_directory_name()
    {
        return $this->get_name() . '/scripts';
    }
    
    public function
        has_scripts_directory()
    {
        return is_dir($this->get_scripts_directory_name());
    }
    
    public function
        get_scripts_directory()
    {
        if ($this->has_scripts_directory()) {
            return
		new CLIScripts_ScriptsDirectory(
		    $this->get_scripts_directory_name(),
		    $this
		);
        } else {
            throw
		new Exception(
		    'No scripts directory in ' . $this->get_name() . '!'
		);
        }
    }
}
?>
