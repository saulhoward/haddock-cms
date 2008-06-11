<?php
/**
* PaypalPayments_TransactionsTableRenderer
*
* @copyright Clear Line Web Design, 2007-10-02
*/

class
	PaypalPayments_TransactionsTableRenderer
extends
	Database_TableRenderer
{
	public function
		get_shop_plug_in_admin_actions($location)
	{
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo 'Line: ' . __LINE__ . "\n";
			echo 'File: ' . __FILE__ . "\n";
			echo 'Class: ' . __CLASS__ . "\n";
			echo 'Method: ' . __METHOD__ . "\n";
			echo 'get_class($this): ' . get_class($this) . "\n";
			
			echo "\n";
			
			echo "\$location: $location\n";
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		$actions = array();
		
		$edit_action['th'] = new HTMLTags_TH('Edit');
		$edit_action['method'] = 'get_shop_plug_in_edit_td';
		
		$method_args = array();
		$method_args[] = $location;
		#$method_args = array('foo' => 'bar');
		#$method_args0 = array('foo' => 'bar');
		
		//echo 'print_r($method_args): ' . "\n";
		//print_r($method_args);
		
		#$edit_action['method_args'] = clone $method_args;
		#$edit_action['method_args'] = clone $method_args0;
		$edit_action['method_args'] = $method_args;
		
		$actions[] = $edit_action;
		
		$delete_action['th'] = new HTMLTags_TH('Delete');
		$delete_action['method'] = 'get_shop_plug_in_delete_td';
		
		#$delete_action['method_args'] = clone $method_args;
		$delete_action['method_args'] = $method_args;
		
		$actions[] = $delete_action;
		
		return $actions;
	}
}
?>
