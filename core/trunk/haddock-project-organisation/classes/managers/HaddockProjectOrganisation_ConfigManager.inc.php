<?php
/**
 * HaddockProjectOrganisation_ConfigManager
 *
 * @copyright 2007-10-08, RFI
 */

/**
 * Configuration managers handle configuration details
 * for a module of a project.
 *
 * They look for the data in the following places:
 *  - the instance specific config file
 *  - the project specific config file
 *  - the module config file
 *
 * If no value can be found for a requested variable,
 * a HaddockProjectOrganisation_ModuleConfigException
 * is thrown.
 *
 * If the 'assemble-config-db' script has been called, there should be
 * a performance boost but this is not essential to the running of this
 * class.
 */
abstract class
	HaddockProjectOrganisation_ConfigManager
{
	private $section;
	private $module;
	
	private $instance_specific_config_file;
	private $project_specific_config_file;
	private $module_config_file;
	
	public function
		__construct(
			$section,
			$module,
			HaddockProjectOrganisation_ConfigFile
				$instance_specific_config_file = NULL,
			HaddockProjectOrganisation_ConfigFile
				$project_specific_config_file = NULL,
			HaddockProjectOrganisation_ConfigFile
				$module_config_file = NULL
		)
	{
		$this->section = $section;
		$this->module = $module;
		
		$this->instance_specific_config_file = $instance_specific_config_file;
		$this->project_specific_config_file = $project_specific_config_file;
		$this->module_config_file = $module_config_file;
	}
	
#	public function
#        get_config_variable($key)
#    {
#        /*
#         * Is this variable set in the instance specific file?
#         */
#        if (isset($this->instance_specific_config_file)) {
#            if ($this->instance_specific_config_file->has_value($key)) {
#                return $this->instance_specific_config_file->get_value($key);
#            }
#        }
#        
#        /*
#         * Is this variable set in the project specific file?
#         */
#        if (isset($this->project_specific_config_file)) {
#            if ($this->project_specific_config_file->has_value($key)) {
#                return $this->project_specific_config_file->get_value($key);
#            }
#        }
#        
#        /*
#         * Is this variable set in the module config file?
#         */
#        if (isset($this->module_config_file)) {
#            if ($this->module_config_file->has_value($key)) {
#                return $this->module_config_file->get_value($key);
#            }
#        }
#        
#        /*
#         * If we've got this far, the variable is not set.
#         */
#        throw new HaddockProjectOrganisation_ModuleConfigException(
#            'No config variable called \'%s\' set in the \'%s\' module in the \'%s\' section!',
#            array(
#                $key,
#                $this->get_identifying_name(),
#                $this->get_section_name()
#            )
#        );
#    }
#
#    public function
#        has_config_variable($key)
#    {
#        try {
#            $value = $this->get_config_variable($key);
#            
#            if (isset($value)) {
#                if (strlen($value) > 0) {
#                    return TRUE;
#                }
#            }
#        } catch (HaddockProjectOrganisation_ModuleConfigException $e) {
#            
#        }
#        
#        return FALSE;
#    }

    /*
     * ----------------------------------------
     * Methods to do with nested config variables.
     * ----------------------------------------
     */

	/**
	 * Searches the config files for this module and returns the value that
	 * is nested in the elements names in the array.
	 * 
	 * The config files are searched in the following order:
	 * 	- instance specific
	 * 	- project specific
	 * 	- module
	 */
	private function
		get_config_value_arr(
			array $element_names,
			$required = TRUE
		)
	{

		if (count($element_names) < 1) {
			throw new Exception('Zero length array given to find a nested config variable!');
		}
        
		/*
		 * Is this variable set in the instance specific file?
		 */
		if (isset($this->instance_specific_config_file)) {
            if (
				$this
					->instance_specific_config_file
						->has_nested_value($element_names)
			) {
                return
					$this
						->instance_specific_config_file
							->get_nested_value($element_names);
            }
        }
        
        /*
         * Is this variable set in the project specific file?
         */
        if (isset($this->project_specific_config_file)) {
            if (
				$this
					->project_specific_config_file
						->has_nested_value($element_names)
			) {
                return
					$this
						->project_specific_config_file
							->get_nested_value($element_names);
            }
        }
        
        /*
         * Is this variable set in the module config file?
         */
        if (isset($this->module_config_file)) {
            if ($this->module_config_file->has_nested_value($element_names)) {
		    return $this->module_config_file->get_nested_value($element_names);
#            } else {
#		    echo "not found in config!\n";
#		    exit;
	    }
        }
        
        if ($required) {
            $key = '';
            
            $first = TRUE;
            foreach ($element_names as $e_n) {
                if ($first) {
                    $first = FALSE;
                } else {
                    $key .= ' -> ';
                }
                
                $key .= $e_n;
            }
            
            throw new HaddockProjectOrganisation_ModuleConfigException(
                'No config variable called \'%s\' set in the \'%s\' module in the \'%s\' section!',
                array(
                    $key,
                    $this->module,
                    $this->section
                )
            );
        } else {
            return NULL;
        }
    }

	/**
	 * Returns the string that will identify the module of this config manger
	 * in the DB file.
	 * 
	 * Methods that implement this should simple return a constant string,
	 * 
	 * e.g. 
	 * 	return '/haddock/foo-module/';
	 * 
	 * This string MUST be unique for each subclass.
	 */	
	abstract protected function
		get_module_prefix_string();

	/**
	 * Returns the variable that is saved in one of the config files
	 * for this module.
	 * 
	 * The element names string should be like UNIX file names, e.g.
	 *
	 * '/foo/bar/gaz'
	 * 
	 * First the method checks if a value corresponding to the string for
	 * this module has been set in the config DB.
	 * 
	 * If a value is not found, the XML files are searched. 
	 * This should not be allowed to happen on a live site as it might be slow.
	 * Cache the values in the DB file using the 'assemble-config-db' script.
	 */
	protected function
		get_config_value(
			$element_names_str,
			$required = TRUE
		)
	{
		$cdbm = HaddockProjectOrganisation_ConfigDBManager::get_instance();
		
		$cdb_str = $this->get_module_prefix_string() . $element_names_str;

		if ($cdbm->exists($cdb_str)) {
			return $cdbm->fetch($cdb_str);
		}

		#$element_names_str = ltrim('/', $element_names_str);

		return $this->get_config_value_arr(
			explode('/', $element_names_str),
			$required
		);
	}

	protected function
		has_config_value($element_names)
	{
		$var = NULL;

		$var = $this->get_config_value(
			$element_names,
			$required = FALSE
		);

		return isset($var);
	}
}
?>