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
			fwrite($fh, date('c') . "\n");
			fwrite($fh, getmypid() . "\n");
		}
		
		fclose($fh);
	}
	
	public function
		unlock()
	{
		$this->delete();
	}
}
?>