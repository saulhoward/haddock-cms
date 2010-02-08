<?php
/**
 * CLIScripts_BatWrapperScript
 *
 * @copyright Clear Line Web Design, 2007-08-03
 */

class
	CLIScripts_BatWrapperScript
extends
    CLIScripts_WrapperScript
{
    public function
        get_as_string()
    {
        $str = '';
        
        $sd = $this->get_script_directory();
        
        $date = date('Y-m-d');
        
        $str .= "@ECHO OFF\r\n";
        $str .= 'REM BAT wrapper script for the ' . $sd->get_script_name() . " script.\r\n";
        $str .= "\r\n";
        $str .= "REM Auto-generated on $date.\r\n";
        $str .= "REM DO NOT EDIT!\r\n";
        $str .= "\r\n";
        
        $str .= "@ECHO ON\r\n";
        $str .= "\r\n";
        
        $str .= '@php.exe ' . $this->get_cmd_str() . "\r\n";
        return $str;
    }    
}
?>
