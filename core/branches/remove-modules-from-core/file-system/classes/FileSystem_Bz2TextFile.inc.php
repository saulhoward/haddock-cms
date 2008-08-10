<?php
/**
 * FileSystem_Bz2TextFile
 *
 * RFI 2006-11-18
 */

if (DEBUG) {
    echo DEBUG_DELIM_OPEN;
    
    require_once CLWD_CORE_ROOT . '/formatting/classes/Formatting_FileName.inc.php';
    require_once CLWD_CORE_ROOT . '/clwd-projects/classes/CLWDProjects_ExecutionTimer.inc.php';
    
    $file = new Formatting_FileName(__FILE__);
    echo "Entering \n";
    echo $file->get_pretty_name();
    echo "\n";
    
    $execution_timer = CLWDProjects_ExecutionTimer::get_instance();
    $execution_timer->mark();
    
    echo DEBUG_DELIM_CLOSE;
}

/**
 * Define the necessary classes.
 */
require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_TextFile.inc.php';

if (DEBUG) {
    echo DEBUG_DELIM_OPEN;
    
    echo "Defining: FileSystem_Bz2TextFile\n";
    
    $execution_timer->mark();
    
    echo DEBUG_DELIM_CLOSE;
}

/**
 * Represents a text file that has been compressed with
 * bzip2 compression.
 *
 * bzcat must be installed and callable from the command
 * line.
 */
class FileSystem_Bz2TextFile extends FileSystem_TextFile
{
    public static function get_bzcat_program()
    {
        switch ($_SERVER['OS']) {
            case 'Windows_NT':
                return 'bzcat.exe';
            default:
                return '/usr/bin/bzcat';
        }
    }
    
    public function get_lines()
    {
        $filename = $this->get_name();
        $bzcat_program = self::get_bzcat_program();
        
        $cmd = "$bzcat_program \"$filename\"";
        #echo "\$cmd: $cmd\n";
        
        $uncompressed_content = shell_exec($cmd);
        #echo "\$uncompressed_content: $uncompressed_content\n";
        
        return explode("\n", $uncompressed_content);
    }
}

if (DEBUG) {
    echo DEBUG_DELIM_OPEN;
    
    echo "Finished defining: FileSystem_Bz2TextFile\n";
    
    $execution_timer->mark();
    
    echo DEBUG_DELIM_CLOSE;
}
?>
