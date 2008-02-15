<?php
/**
 * ServerAdminScripts_ProjectRootSVNWorkingDirectory
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
    . 'ServerAdminScripts_TrunkSVNWorkingDirectory.inc.php';

require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_BranchesSVNWorkingDirectory.inc.php';

require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_TagsSVNWorkingDirectory.inc.php';
    
class
    ServerAdminScripts_ProjectRootSVNWorkingDirectory
extends
    FileSystem_SVNWorkingDirectory
{
    private $history;
    
    private function
        get_trunk_directory_name()
    {
        return $this->get_name() . '/trunk';
    }
    
    public function
        has_trunk_directory()
    {
        return is_dir($this->get_trunk_directory_name());
    }
    
    public function
        get_trunk_directory()
    {
        return
            new ServerAdminScripts_TrunkSVNWorkingDirectory(
                $this->get_trunk_directory_name()
            );
    }
    
    private function
        get_branches_directory_name()
    {
        return $this->get_name() . '/branches';
    }
    
    public function
        has_branches_directory()
    {
        return is_dir($this->get_branches_directory_name());
    }
    
    public function
        get_branches_directory()
    {
        return
            new ServerAdminScripts_BranchesSVNWorkingDirectory(
                $this->get_branches_directory_name()
            );
    }
    
    private function
        get_tags_directory_name()
    {
        return $this->get_name() . '/tags';
    }
    
    public function
        has_tags_directory()
    {
        return is_dir($this->get_tags_directory_name());
    }
    
    public function
        get_tags_directory()
    {
        return
            new ServerAdminScripts_TagsSVNWorkingDirectory(
                $this->get_tags_directory_name()
            );
    }
    
    public function
        add_log_array($log_array, $branch_name)
    {
        if (!isset($this->history)) {
            $this->history = array();
        }
        
        $keys = explode(' ', 'date message committer');
        
        for ($i = 0; $i < count($log_array); $i++) {
            $r = $log_array[$i]['revision'];
            
            foreach ($keys as $key) {
                $this->history[$r][$key]
                    = $log_array[$i][$key];
            }
            
            $this->history[$r]['branch']
                = $branch_name;
        }
    }
    
    public function
        get_history()
    {
        ksort($this->history);
        
        return $this->history;
    }
}
?>
