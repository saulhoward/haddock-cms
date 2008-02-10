<?php
/**
 * HaddockProjectOrganisation_PlugInModulesDirectory
 *
 * @copyright Clear Line Web Design, 2007-07-31
 */

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ModulesDirectory.inc.php';

class
	HaddockProjectOrganisation_PlugInModulesDirectory
extends
    HaddockProjectOrganisation_ModulesDirectory
{
    public function
        has_plug_in($plug_in)
    {
        return $this->has_module_directory($plug_in);
    }
    
	protected function
        get_default_module_directory_reflection_class()
    {
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo 'Line: ' . __LINE__ . "\n";
			echo 'File: ' . __FILE__ . "\n";
			echo 'Class: ' . __CLASS__ . "\n";
			echo 'Method: ' . __METHOD__ . "\n";
			
			echo 'get_class($this): ' . get_class($this) . "\n";
			
			echo DEBUG_DELIM_CLOSE;
		}
		
        return
            new ReflectionClass(
                'HaddockProjectOrganisation_PlugInModuleDirectory'
            );
    }
	
    public function
        get_plug_in_module_directories(
            $abstract = FALSE
        )
    {
        $p_i_m_ds = array();
        
        $plug_in_module_directories = $this->get_module_directories();
        
        foreach ($plug_in_module_directories as $p_i_m_d) {
            if ($p_i_m_d->is_abstract_plug_in() == $abstract) {
                $p_i_m_ds[] = $p_i_m_d;
            }
        }
        
        return $p_i_m_ds;
    }
}
?>