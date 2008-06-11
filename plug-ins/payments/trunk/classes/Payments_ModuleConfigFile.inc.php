<?php
/**
 * Payments_ModuleConfigFile
 *
 * @copyright Clear Line Web Design, 2007-10-04
 */

/**
 * The class to represent a module configuration file
 * for the payments module.
 *
 * This is sort of a half-baked way of doing things,
 * so it's probably best not to try to replicate this
 * approach in other modules.
 *
 * Instead, use the config manager classes.
 */
class
	Payments_ModuleConfigFile
extends
    HaddockProjectOrganisation_ModuleConfigXMLFile
{
	/**
	 * This method extracts the names of payment plug-ins for
	 * this module.
	 */
    public function
        get_payment_plug_in_names()
    {
        $payment_plug_in_names = array();
        
        $payment_plug_ins_node = $this->get_required_node('payment-plug-ins');
        
        $payment_plug_in_nodes
            = $payment_plug_ins_node->getElementsByTagName('payment-plug-in');
        
        //echo '$payment_plug_in_nodes->length: ' . "\n";
        //echo $payment_plug_in_nodes->length . "\n";
        
        for (
            $i = 0;
            $i < $payment_plug_in_nodes->length;
            $i++
        ){
            $ppin = $payment_plug_in_nodes->item($i);
            
            //echo 'print_r($ppin): ' . "\n";
            //print_r($ppin);
            
            if ($ppin->hasAttribute('name')) {
                $payment_plug_in_names[] = $ppin->getAttribute('name');
            //} else {
            //    echo "Name not set!\n";
            }
        }
        
        //echo 'print_r($payment_plug_in_names): ' . "\n";
        //print_r($payment_plug_in_names);
        
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo 'Line: ' . __LINE__ . "\n";
			echo 'File: ' . __FILE__ . "\n";
			echo 'Class: ' . __CLASS__ . "\n";
			echo 'Method: ' . __METHOD__ . "\n";
			echo 'get_class($this): ' . get_class($this) . "\n";
			echo '$this->get_name(): ' . $this->get_name() . "\n";
            
			echo "\n";
			
			echo 'count($payment_plug_in_names): ' . count($payment_plug_in_names) . "\n";
			
			echo 'print_r($payment_plug_in_names):' . "\n";
            print_r($payment_plug_in_names);
			
			echo DEBUG_DELIM_CLOSE;
		}
		
        return $payment_plug_in_names;
    }
}
?>