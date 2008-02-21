<?php
/**
 * ServerAdminScripts_SVNRepositoryDumpDirectory
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
    ServerAdminScripts_SVNRepositoryDumpDirectory
extends
    FileSystem_Directory
{
    public function
        get_most_recent_dump_number()
    {
        $most_recent_dump_number = -1;
        
        $dump_numbers = array();
        
        foreach ($this->get_files() as $file) {
            if (preg_match('/(\d+).dump/', $file->basename(), $matches)) {
                $dump_numbers[] = $matches[1];
            }
        }
        
        if (count($dump_numbers) > 0) {
            $most_recent_dump_number = max($dump_numbers);
        }
        
        return $most_recent_dump_number;
    }
}
?>
