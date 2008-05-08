<?php
/**
 * CLIScripts_LockFile
 *
 * @copyright 2008-04-25, RFI
 */

class
	CLIScripts_LockFile
extends
	FileSystem_TextFile
{
	private $process_id;
	
	public function
		is_locked()
	{
		return $this->is_file();
	}
	
	public function
		lock()
	{
		$fh = fopen($this->get_name() , 'w');
		
		if ($fh) {
			#fwrite($fh, date('c') . "\n");
			fwrite($fh, getmypid() . "\n");
		}
		
		fclose($fh);
	}
	
	public function
		unlock()
	{
		$this->delete();
	}
	
	public function
		is_alive()
	{
		return Environment_ProcessesHelper
			::does_process_exist(
				$this->get_process_id()
			);
	}
	
	public function
		get_process_id()
	{
		if (!isset($this->process_id)) {
			$lines = $this->get_lines();
			
			#echo __METHOD__ . "\n";
			#echo 'Name: ' . $this->get_name() . "\n";
			#echo 'print_r($lines): ' . "\n";
			#print_r($lines);
			
			$this->process_id = (int)$lines[0];
		}
		
		return $this->process_id;
	}
}
?>