<?php
/**
 * ServerAdminScripts_BranchSVNWorkingDirectory
 *
 * @copyright Clear Line Web Design, 2007-04-26
 */

/*
 * Define the necessary classes.
 */

require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_SVNWorkingDirectory.inc.php';
    
class
    ServerAdminScripts_BranchSVNWorkingDirectory
extends
    FileSystem_SVNWorkingDirectory
{
    public function
        get_branched_at_revision()
    {
        $log_messages = $this->get_svn_log_array(
            $stop_on_copy = TRUE
        );
        
        #print_r($log_messages);
        #exit;
        
        #return 0;
        
        return $log_messages[count($log_messages) - 1]['revision'];
    }
}
?>