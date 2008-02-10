<?php
/**
 * CLIScripts_SHPWrapperScript
 *
 * @copyright Clear Line Web Design, 2007-08-03
 */

class
	CLIScripts_SHWrapperScript
extends
    CLIScripts_WrapperScript
{
    public function
        get_as_string()
    {
        $str = "#!/bin/bash\n";
        
        $sd = $this->get_script_directory();
        
        $date = date('Y-m-d');
        
        $str .= '# Script for the ' . $sd->get_script_name() . " script.\n";
        $str .= "\n";
        $str .= "# Auto-generated on $date.\n";
        $str .= "# DO NOT EDIT!\n";
        $str .= "\n";
        
        //$ssd = $sd->get_scripts_directory();
        //$bd = $ssd->get_bin_includes_directory();
        //$md = $bd->get_module_directory();
        //
        //$md_class = get_class($md);
        //
        //#echo "\$md_class: $md_class\n";
        //
        //$is_ps = ($md_class == 'HaddockProjectOrganisation_ProjectSpecificDirectory');
        //
        //$str .= '$cmd = "php ../../' . ($is_ps ? '../' : '') . 'cli-scripts/bin/bin-runner.php"' . ";\n";
        //$str .= "\n";
        //
        //if ($md_class == 'HaddockProjectOrganisation_ProjectSpecificDirectory') {
        //    $str .= "\$cmd .= \" --section=project-specific\";\n";
        //} elseif ($md_class == 'HaddockProjectOrganisation_CoreModuleDirectory') {
        //    $str .= "\$cmd .= \" --section=haddock\";\n";
        //} elseif ($md_class == 'HaddockProjectOrganisation_PlugInModuleDirectory') {
        //    $str .= "\$cmd .= \" --section=plug-ins\";\n";
        //}
        //$str .= "\n";
        //
        //if ($md_class != 'HaddockProjectOrganisation_ProjectSpecificDirectory') {
        //    $str .= "\$cmd .= \" --module=" . $md->basename() . "\";\n";
        //    
        //    $str .= "\n";
        //}
        //
        //$str .= "\$cmd .= \" --script=" . $sd->get_script_name() . "\";\n";
        //    
        //$str .= "\n";
        //
        //$str .= 'for ($i = 1; $i < count($_SERVER[\'argv\']); $i++) {' . "\n";
        //$str .= '    $cmd .=  \' \' . $_SERVER[\'argv\'][$i];' . "\n";
        //$str .= '}' . "\n";
        //$str .= "\n";
        //
        //$str .= "echo \"\$cmd\\n\";\n";
        
        $str .= 'php ';
        $str .= $this->get_cmd_str();
        
        $str .= "\n";
        
        return $str;
    }
}
?>
