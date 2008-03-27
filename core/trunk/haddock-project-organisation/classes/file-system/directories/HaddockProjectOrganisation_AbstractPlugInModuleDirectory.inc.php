<?php
/**
 * HaddockProjectOrganisation_AbstractPlugInModuleDirectory
 *
 * @copyright Clear Line Web Design, 2007-10-04
 */

/**
 * Although this class is not itself abstract, subclasses
 * of it probably should be.
 */
class
	HaddockProjectOrganisation_AbstractPlugInModuleDirectory
extends
    HaddockProjectOrganisation_PlugInModuleDirectory
{
    /**
     * @return array
     *  If a plug-in implements this abstract plug-in, all these
     *  interfaces must be implemented in the plug-in.
     */
    public function
        get_required_interfaces()
    {
        $required_interfaces = array();
        
        $config_file = $this->get_config_file();
		
        return $required_interfaces;
    }
}
?>
