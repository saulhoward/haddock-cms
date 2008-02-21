<?php
/**
 * CLIScripts_WrapperScript
 *
 * @copyright Clear Line Web Design, 2007-08-03
 */

abstract class
	CLIScripts_WrapperScript
extends
    FileSystem_DataFile
{
    private $script_directory;
    
    public function
        __construct(
            $name,
            CLIScripts_ScriptDirectory $script_directory
        )
    {
        parent::__construct($name);
        
        $this->script_directory = $script_directory;
    }
    
    public function
        get_script_directory()
    {
        return $this->script_directory;
    }
    
    public function
        commit()
    {
        $str = $this->get_as_string();
        
        if ($fh = fopen($this->get_name(), 'w')) {
            fwrite($fh, $str);
            
            fclose($fh);
        } else {
            throw new Exception('Unable to open ' . $this->get_name() . ' for writing!');
        }
    }
    
    //public abstract function
    //    get_as_string();
        
    public function
        get_cmd_str()
    {
        $sd = $this->get_script_directory();
        $ssd = $sd->get_scripts_directory();
        $bd = $ssd->get_bin_includes_directory();
        $md = $bd->get_module_directory();
        
        #$md_class = get_class($md);
        #echo "\$md_class: $md_class\n";
        
        if (is_a($md, 'HaddockProjectOrganisation_ProjectSpecificDirectory')) {
            $section = 'project-specific';
        } elseif (is_a($md, 'HaddockProjectOrganisation_CoreModuleDirectory')) {
            $section = 'haddock';
        } elseif (is_a($md, 'HaddockProjectOrganisation_PlugInModuleDirectory')) {
            $section = 'plug-ins';
        }
        
        #echo "\$section: $section\n";
        
        #$is_ps = ($md_class == 'HaddockProjectOrganisation_ProjectSpecificDirectory');
        
        #$str .= '../../' . ($is_ps ? '../' : '');
        
        switch ($section) {
            case 'project-specific':
                $str .= '../../haddock/';
                break;
            case 'haddock':
                $str .= '../../';
                break;
            case 'plug-ins':
                $str .= '../../../haddock/';
                break;
        }
        
        $str .= 'cli-scripts/bin/bin-runner.php';
        
        //if ($md_class == 'HaddockProjectOrganisation_ProjectSpecificDirectory') {
        //    $str .= ' --section=project-specific';
        //} elseif ($md_class == 'HaddockProjectOrganisation_CoreModuleDirectory') {
        //    $str .= ' --section=haddock';
        //} elseif ($md_class == 'HaddockProjectOrganisation_PlugInModuleDirectory') {
        //    $str .= ' --section=plug-ins';
        //}
        
        $str .= " --section=$section";
        
        //if ($md_class != 'HaddockProjectOrganisation_ProjectSpecificDirectory') {
        //    $str .= ' --module=' . $md->basename();
        //}
        
        if ($section != 'project-specific') {
            $str .= ' --module=' . $md->get_identifying_name();
        }
        
        $str .= ' --script=' . $sd->get_script_name();
        
        return $str;
    }
}
?>
