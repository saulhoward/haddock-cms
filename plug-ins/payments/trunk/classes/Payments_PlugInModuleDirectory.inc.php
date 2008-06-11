<?php
/**
 * Payments_PlugInModuleDirectory
 *
 * @copyright Clear Line Web Design, 2007-10-04
 */

/**
 * Represents the payments plug-in module directory.
 *
 * Not to be confused with the Payments_AbstractModuleDirectory class,
 * which sets out the requirements of a plug-in implementing the
 * payments plug-in.
 */
class
	Payments_PlugInModuleDirectory
extends
    HaddockProjectOrganisation_PlugInModuleDirectory
{
    protected function
        get_config_file_reflection_class_file_name()
    {
        return 'Payments_ModuleConfigFile';
    }
    
    public function
        get_payment_plug_ins()
    {
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo 'Line: ' . __LINE__ . "\n";
			echo 'File: ' . __FILE__ . "\n";
			echo 'Class: ' . __CLASS__ . "\n";
			echo 'Method: ' . __METHOD__ . "\n";
			echo 'get_class($this): ' . get_class($this) . "\n";
			echo '$this->basename(): ' . $this->basename() . "\n";
            
			echo DEBUG_DELIM_CLOSE;
		}
		
        $payment_plug_ins = array();
        
        $config_file = $this->get_project_specific_config_file();
        
		#print_r($config_file);exit;
		
        $plug_in_modules_directory = $this->get_plug_in_modules_directory();
        
		#print_r($plug_in_modules_directory); exit;
		
        foreach ($config_file->get_payment_plug_in_names() as $ppin) {
			#echo "$ppin\n";
            $payment_plug_ins[]
                = $plug_in_modules_directory->get_module_directory(
                    $ppin
                );
        }
        
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo 'Line: ' . __LINE__ . "\n";
			echo 'File: ' . __FILE__ . "\n";
			echo 'Class: ' . __CLASS__ . "\n";
			echo 'Method: ' . __METHOD__ . "\n";
			echo 'get_class($this): ' . get_class($this) . "\n";
			echo '$this->basename(): ' . $this->basename() . "\n";
            
			echo "\n";
			
			echo 'count($payment_plug_ins): ' . count($payment_plug_ins) . "\n";
			
			echo 'print_r($payment_plug_ins):' . "\n";
			
            print_r($payment_plug_ins);
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		exit;
		
        return $payment_plug_ins;
    }
}
?>