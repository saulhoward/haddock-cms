<?php
/**
 * ServerAdminScripts_BranchesSVNWorkingDirectory
 *
 * @copyright Clear Line Web Design, 2007-04-26
 */

/*
 * Define the necessary classes.
 */

require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_SVNWorkingDirectory.inc.php';

require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_BranchSVNWorkingDirectory.inc.php';
    
class
    ServerAdminScripts_BranchesSVNWorkingDirectory
extends
    FileSystem_SVNWorkingDirectory
{
    public function
        get_branch_directories()
    {
        $subdirectories = $this->get_subdirectories();
        
        $branch_directories = array();
        
        foreach ($subdirectories as $s_d) {
            $branch_directories[] =
                #new FileSystem_SVNWorkingDirectory($s_d->get_name());
                new ServerAdminScripts_BranchSVNWorkingDirectory($s_d->get_name());
        }
        
        return $branch_directories;
    }
}
?>