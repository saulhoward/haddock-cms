<?php
/**
 * CLIScripts_ScriptDirectory
 *
 * @copyright Clear Line Web Design, 2007-08-03
 */

class
	CLIScripts_ScriptDirectory
extends
    FileSystem_Directory
{
	private $scripts_directory;
	
	public function
		__construct(
			$name,
			CLIScripts_ScriptsDirectory $scripts_directory
		)
	{
		parent::__construct($name);
		$this->scripts_directory = $scripts_directory;
	}
	
	public function
		get_scripts_directory()
	{
		return $this->scripts_directory;
	}
	
	public function
		get_script_name()
	{
		return $this->basename();
	}
	
	public function
		delete_wrapper_scripts()
	{
		if ($this->has_sh_wrapper_script()) {
			$sh_wrapper_script = $this->get_sh_wrapper_script();
			unlink($sh_wrapper_script->get_name());
		}
		
		if ($this->has_bat_wrapper_script()) {
			$bat_wrapper_script = $this->get_bat_wrapper_script();
			unlink($bat_wrapper_script->get_name());
		}
	}
	
	public function
		create_wrapper_scripts()
	{
		if (!$this->has_sh_wrapper_script()) {
			$sh_wrapper_script = new CLIScripts_SHWrapperScript(
				$this->get_sh_wrapper_script_filename(),
				$this
			);
			
			$sh_wrapper_script->commit();
		}
		
		if (!$this->has_bat_wrapper_script()) {
			$bat_wrapper_script = new CLIScripts_BatWrapperScript(
				$this->get_bat_wrapper_script_filename(),
				$this
			);
			
			$bat_wrapper_script->commit();
		}
	}
	
	public function
		refresh_wrapper_scripts()
	{
		$this->delete_wrapper_scripts();
		$this->create_wrapper_scripts();
	}
	
	private function
		get_sh_wrapper_script_filename()
	{
		$sh_wrapper_script_filename
            = $this->get_name()
                . '/../../../bin/' . $this->get_script_name() . '.sh';
		
		//echo "\$php_wrapper_script_filename: $php_wrapper_script_filename\n";
		//
		//$php_wrapper_script_filename = realpath($php_wrapper_script_filename);
		//
		//echo "\$php_wrapper_script_filename: $php_wrapper_script_filename\n";
		
		return $sh_wrapper_script_filename;
	}
	
	public function
		has_sh_wrapper_script()
	{
		return is_file($this->get_sh_wrapper_script_filename());
	}
	
	public function
		get_sh_wrapper_script()
	{
		if ($this->has_sh_wrapper_script()) {
			return
                new CLIScripts_SHWrapperScript(
                    $this->get_sh_wrapper_script_filename(),
                    $this
                );
		} else {
			throw new Exception('No .sh wrapper script!');
		}
	}	
	
	private function
		get_bat_wrapper_script_filename()
	{
		$bat_wrapper_script_filename
            = $this->get_name()
                . '/../../../bin/' . $this->get_script_name() . '.bat';
		
		return $bat_wrapper_script_filename;
	}
	
	public function
		has_bat_wrapper_script()
	{
		return is_file($this->get_bat_wrapper_script_filename());
	}
	
	public function
		get_bat_wrapper_script()
	{
		if ($this->has_bat_wrapper_script()) {
			return
                new CLIScripts_BatWrapperScript(
                    $this->get_bat_wrapper_script_filename(),
                    $this
                );
		} else {
			throw new Exception('No .BAT wrapper script!');
		}
	}	
}
?>
