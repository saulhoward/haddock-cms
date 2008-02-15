<?php
/**
 * ServerAdminScripts_DumpDirectory
 *
 * @copyright Clear Line Web Design, 2007-02-06
 */

require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_Directory.inc.php';
    
require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_DumpFile.inc.php';
    
class
    ServerAdminScripts_DumpDirectory
extends
    FileSystem_Directory
{
    public function
        delete_all_but_youngest($copies)
    {
        $files = $this->get_files('name', 'ASC');
        
        #foreach ($files as $file) {
        #    echo $file->get_name() . "\n";
        #}
        
        $files_to_delete = array_slice($files, $copies);
        
        foreach ($files_to_delete as $file_to_delete) {
            #echo $file_to_delete->get_name() . "\n";
            unlink($file_to_delete->get_name());
        }
    }
    
    /**
     * Renames all the files in a dump directory
     * by incrementing the file number by one.
     */
    public function
        shift_names_up()
    {
        $files = $this->get_files('name', 'DESC');
        
        foreach ($files as $file) {
            if (preg_match('/(\d+).dump$/', $file->get_name(), $matches)) {
                
                #print_r($matches);
                
                $old_name = $file->get_name();
                
                #echo "\$old_name: $old_name\n";
                
                $new_name = $this->get_name() . '/';
                $new_name .= sprintf("%04d", $matches[1] + 1);
                $new_name .= '.dump';
                
                #echo "\$new_name: $new_name\n";
                
                rename($old_name, $new_name);
            }
        }
    }
    
    public function
        get_next_dump_file()
    {
        return new ServerAdminScripts_DumpFile($this->get_name() . '/0000.dump');
    }
}
?>
