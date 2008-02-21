<?php
/**
 * HaddockProjectOrganisation_CoreModulesDirectory
 *
 * @copyright Clear Line Web Design, 2007-09-27
 */

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ModulesDirectory.inc.php';

class
	HaddockProjectOrganisation_CoreModulesDirectory
extends
    HaddockProjectOrganisation_ModulesDirectory
{
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
                'HaddockProjectOrganisation_CoreModuleDirectory'
            );
    }
}
?>