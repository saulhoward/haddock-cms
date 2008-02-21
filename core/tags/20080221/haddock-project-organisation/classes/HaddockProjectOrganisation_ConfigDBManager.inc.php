<?php
/**
 * HaddockProjectOrganisation_ConfigDBManager
 * 
 * @copyright Clear Line Web Design, 2007-10-17
 */

/**
 * A wrapper around a DB file for config variables.
 * 
 * Uses the singleton pattern.
 * 
 * Instances of this class SHOULD NOT be created outside the 
 * HaddockProjectOrganisation_ConfigManager class.
 */
class 
	HaddockProjectOrganisation_ConfigDBManager
{
	private static $instance;

	private $db_handles;
	
	private function
		__construct()
	{
		$this->db_handles = array();
	}
	
	public static function
		get_instance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new HaddockProjectOrganisation_ConfigDBManager();
		}
		
		return self::$instance;
	}

	private static final function
		get_db_file_name()
	{
		return PROJECT_ROOT . '/dbm-cache/config.db';
	}

	private static final function
		get_db_handler()
	{
		return 'db4';
	}

	private function
		db_file_exists()
	{
		return file_exists(self::get_db_file_name());
	}

	private function
		get_db_handle($mode)
	{
		if (!isset($this->db_handles[$mode])) {
			$fn = self::get_db_file_name();
			$h = self::get_db_handler();

			$this->db_handles[$mode] = dba_popen(
					$fn,
					$h,
					$mode
				);
		}

		return $this->db_handles[$mode];
	}

	/**
	 * Returns the value for the key.
	 * 
	 * This SHOULD NOT be called in scripts.
	 * It sould ONLY be called from the HaddockProjectOrganisation_ConfigManager class.
	 * It shouldn't even be called from subclasses of that class. 
	 */
	public function
		fetch($key)
	{
		return dba_fetch($key, $this->get_db_handle('r'));
	}

	/**
	 * Inserts a named value into the config database.
	 * 
	 * This SHOULD NOT be called by scripts that run on webservers
	 * as the DB file shouldn't be writable by the web server process.
	 * 
	 * The only script that should call this function or write to the DB file
	 * is the 'assemble-config-db' CLI script.
	 * 
	 * Changing settings should achieved by altering the XML config files for
	 * each module.
	 */
	public function
		insert($key, $value)
	{
		return dba_insert($key, $value, $this->get_db_handle('w'));
	}

	public function
		exists($key)
	{
		if (!$this->db_file_exists()) {
			return FALSE;
		}

		return dba_exists($key, $this->get_db_handle('r'));
	}

	public function
		replace($key, $value)
	{
		return dba_replace($key, $value, $this->get_db_handle('w'));
	}

	/**
	 * Closes all the open DB handles for this manager.

	 * You probably don't need to call this in scripts that are run
	 * in Apache because the handles are persistent.
	 */
	public function
		close_all_db_handles()
	{
		foreach (array_keys($this->db_handles) as $k) {
			dba_close($this->db_handles[$k]);
		}	
	}
}
?>
