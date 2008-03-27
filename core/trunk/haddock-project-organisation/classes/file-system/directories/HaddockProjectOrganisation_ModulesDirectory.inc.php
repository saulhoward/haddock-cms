<?php
/**
 * HaddockProjectOrganisation_ModulesDirectory
 *
 * @copyright Clear Line Web Design, 2007-09-27
 */

/**
 * This is the class that represents the directories where:
 * 
 * 	- the core modules 
 * 	- the plug-in modules
 *
 * are stored.
 */
abstract class
	HaddockProjectOrganisation_ModulesDirectory
extends
    FileSystem_Directory
{
    private $project_directory;
    
    public function
        __construct(
            $name,
            HaddockProjectOrganisation_ProjectDirectory $project_directory
        )
    {
        parent::__construct($name);
        
        $this->project_directory = $project_directory;
    }
    
    public function
        get_project_directory()
    {
        return $this->project_directory;
    }
    
    protected function
        get_module_directory_name($name)
    {
        return $this->get_name() . "/$name";
    }
    
    public function
        has_module_directory($name)
    {
        return is_dir($this->get_module_directory_name($name));
    }
    
	/**
	 * Returns all the module directories to in this directory.
	 *
	 * If a module has some specialised functionality encoded in a
	 * class, then an instance of that class will be returned.
	 */
    public function
        get_module_directories()
    {
        $module_directories = array();
        
        foreach ($this->get_subdirectories() as $m_d) {
			$module_directory_reflection_class
				= $this->get_module_directory_reflection_class(
                    $m_d->basename()
                );
            $module_directories[]
				= $module_directory_reflection_class->newInstance(
                    $m_d->get_name(),
                    $this
				);
        }
        
        return $module_directories;
    }
    
	/**
	 * A module directory might have special behaviour.
	 *
	 * This would be encoded in the class that represents that
	 * module's directory.
	 *
	 * That class would be a subclass of
	 * HaddockProjectOrganisation_ModuleDirectory.
	 */
    public function
        get_module_directory($name)
    {
        if ($this->has_module_directory($name)) {
			$module_directory_reflection_class
				= $this->get_module_directory_reflection_class(
                    $name
                );
            return
				$module_directory_reflection_class->newInstance(
                    $this->get_module_directory_name($name),
                    $this
				);
        } else {
            throw new ErrorHandling_SprintfException(
                'No module directory called \'%s\' found in %s!',
                array($name, $this->get_name())
            );
        }
    }
    
	/*
	 * ----------------------------------------
	 * Methods to do with finding the reflection object for a
	 * module directory class.
	 * ----------------------------------------
	 */
    
	/**
	 * What the default class to represent a module directory
	 * is, depends on whether the class that implements this
	 * class represents the core modules directory or the plug-in
	 * modules directory.
	 *
	 * Hence, this method is abstract and is implemented in
	 *
	 * 	- HaddockProjectOrganisation_CoreModulesDirectory
	 * 	- HaddockProjectOrganisation_PlugInModulesDirectory
	 */
    abstract protected function
        get_default_module_directory_reflection_class();
    
	/**
	 * Finds the class that has been designated to handle the functionality
	 * of the requested module.
	 *
	 * This setting is set in the config file for a module.
	 */
    private function
        get_module_directory_reflection_class($module_name)
    {
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo 'Line: ' . __LINE__ . "\n";
			echo 'File: ' . __FILE__ . "\n";
			echo 'Class: ' . __CLASS__ . "\n";
			echo 'Method: ' . __METHOD__ . "\n";
			echo 'get_class($this): ' . get_class($this) . "\n";
			
			echo "\n";
			
			echo "\$module_name: $module_name\n";
			
			echo DEBUG_DELIM_CLOSE;
		}
		
        if ($this->has_module_directory($module_name)) {
            $default_module_directory_reflection_class
                = $this->get_default_module_directory_reflection_class();
            
            $module_directory
                = $default_module_directory_reflection_class
                    ->newInstance(
                        $this->get_module_directory_name($module_name),
                        $this
                    );
            
            if (
                $module_directory
                    ->has_config_variable('module-directory-subclass')
            ) {
				if (DEBUG) {
					echo DEBUG_DELIM_OPEN;
					
					echo 'Line: ' . __LINE__ . "\n";
					echo 'File: ' . __FILE__ . "\n";
					echo 'Class: ' . __CLASS__ . "\n";
					echo 'Method: ' . __METHOD__ . "\n";
					echo 'get_class($this): ' . get_class($this) . "\n";
					
					echo "\n";
					
					echo "Module has sub class for dir.\n";
					
					echo DEBUG_DELIM_CLOSE;
				}
				
				$mdsc = $module_directory->get_config_variable('module-directory-subclass');
				
				if (DEBUG) {
					echo DEBUG_DELIM_OPEN;
					
					echo 'Line: ' . __LINE__ . "\n";
					echo 'File: ' . __FILE__ . "\n";
					echo 'Class: ' . __CLASS__ . "\n";
					echo 'Method: ' . __METHOD__ . "\n";
					echo 'get_class($this): ' . get_class($this) . "\n";
					
					echo "\n";
					
					echo "\$mdsc: $mdsc\n";
					
					echo DEBUG_DELIM_CLOSE;
				}
				
                return new ReflectionClass($mdsc);
            } else {
				if (DEBUG) {
					echo DEBUG_DELIM_OPEN;
					
					echo 'Line: ' . __LINE__ . "\n";
					echo 'File: ' . __FILE__ . "\n";
					echo 'Class: ' . __CLASS__ . "\n";
					echo 'Method: ' . __METHOD__ . "\n";
					echo 'get_class($this): ' . get_class($this) . "\n";
					
					echo "\n";
					
					echo "Module has no sub class for dir, using default.\n";
					
					echo DEBUG_DELIM_CLOSE;
				}
				
                return $default_module_directory_reflection_class;
			}
        } else {
            throw new ErrorHandling_SprintfException(
                'No module directory called \'%s\' found in %s!',
                array($module_name, $this->get_name())
            );
        }
    }
}
?>