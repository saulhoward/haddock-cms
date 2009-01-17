<?php
/**
 * Environment_ProcessesHelper
 *
 * @copyright 2008-05-08, RFI
 */

/**
 * Provides information about the processes that are running on the
 * server.
 * 
 * This are unlikely to work on anything but Linux!
 */
class
	Environment_ProcessesHelper
{
	private static function
		get_raw_processes_data()
	{
		$cmd = 'ps aux';

		$ps_out = shell_exec($cmd);

		#echo "\$ps_out:\n$ps_out\n";
		
		return $ps_out;
	}
	
	private static function
		get_raw_processes_data_array()
	{
		$raw_processes_data_array = array();
		
		$raw_processes_data = self::get_raw_processes_data();
		
		$lines = explode("\n", $raw_processes_data);
		
		for ($i = 1; $i < count($lines); $i++) {
			#echo '$lines[' . $i . "]\n";
			#
			#echo $lines[$i] . "\n";
			
			$raw_processes_data_array[] = preg_split('/\s+/', $lines[$i]);
		}
		
		return $raw_processes_data_array;
	}
	
	public static function
		does_process_exist(
			$process_id
		)
	{
		$raw_processes_data_array = self::get_raw_processes_data_array();
		
		#echo 'print_r($raw_processes_data_array): ' . "\n";
		#print_r($raw_processes_data_array);
		
		foreach ($raw_processes_data_array as $rpd) {
			if ($rpd[1] == $process_id) {
				return TRUE;
			}
		}
		
		return FALSE;
	}
}
?>