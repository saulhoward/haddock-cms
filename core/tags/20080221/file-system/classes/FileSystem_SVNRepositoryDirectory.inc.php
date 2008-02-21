<?php
/**
 * FileSystem_SVNRepositoryDirectory
 *
 * @copyright Clear Line Web Design, 2007-02-09
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_Directory.inc.php';

class
    FileSystem_SVNRepositoryDirectory
extends
    FileSystem_Directory
{
    private function
        get_svnlook_program()
    {
        if ($_SERVER['OS'] == 'Windows_NT') {
            return 'svnlook.exe';
        } else {
            return '/usr/bin/svnlook';
        }
    }
    
    public function
        youngest()
    {
        $youngest = 0;
        
        $cmd = $this->get_svnlook_program();
        
        $cmd .= ' youngest ';
        
        $cmd .= '"' . $this->get_name() . '"';
        
        #echo "\$cmd: $cmd\n";
        
        $output = shell_exec($cmd);
        
        if (preg_match('/(\d+)/', $output, $matches)) {
            $youngest = $matches[1];
        }
        
        return $youngest;
    }
}
?>
