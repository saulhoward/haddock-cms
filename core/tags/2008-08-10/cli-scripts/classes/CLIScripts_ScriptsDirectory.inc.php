<?php
/**
 * CLIScripts_ScriptsDirectory
 *
 * @copyright Clear Line Web Design, 2007-08-03
 */

class
	CLIScripts_ScriptsDirectory
extends
    FileSystem_Directory
{
    private $bin_includes_directory;
    
    public function
        __construct(
            $name,
            CLIScripts_BinIncludesDirectory $bin_includes_directory
        )
    {
        parent::__construct($name);
        
        $this->bin_includes_directory = $bin_includes_directory;
    }
    
    public function
        get_bin_includes_directory()
    {
        return $this->bin_includes_directory;
    }
    
    public function
        get_script_directories()
    {
        $script_directories = array();
        
        foreach ($this->get_subdirectories() as $sd) {
            $script_directories[]
                = new CLIScripts_ScriptDirectory(
                    $sd->get_name(),
                    $this
                );
        }
        
        return $script_directories;
    }
    
    private function
	get_script_directory_name($script_name)
    {
	return $this->get_name() . "/$script_name";
    }
    
    public function
	has_script_directory($script_name)
    {
	return is_dir($this->get_script_directory_name($script_name));
    }
    
    public function
	get_script_directory($script_name)
    {
	if ($this->has_script_directory($script_name)) {
	    return
		new CLIScripts_ScriptDirectory(
		    $this->get_script_directory_name($script_name),
		    $this
		);
	} else {
	    throw
		new Exception(
		    'No script directory for a script called \''
		    . $script_name
		    . '\' in \''
		    . $this->get_name()
		    . '\'!'
		);
	}
    }
}
?>
