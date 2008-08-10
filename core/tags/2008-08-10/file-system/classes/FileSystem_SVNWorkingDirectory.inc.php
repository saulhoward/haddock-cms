<?php
/**
 * FileSystem_SVNWorkingDirectory
 *
 * @copyright Clear Line Web Design, 2006-11-13
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_Directory.inc.php';

/**
 * Represents a directory under SVN control.
 */
class
    FileSystem_SVNWorkingDirectory
extends
    FileSystem_Directory
{
    private $svn_log;
    
    public static function
        get_svn_program()
    {
        switch ($_SERVER['OS']) {
            case 'Windows_NT':
                return 'svn.exe';
            default:
                return '/usr/bin/svn';
        }
    }
    
    public function
        get_svn_info()
    {
        $cmd = self::get_svn_program() . ' info "' . $this->get_name() . '"';
        $info = shell_exec($cmd);
        
        return $info;
    }
    
    public function
        get_svn_log($stop_on_copy = FALSE)
    {
        if (!isset($this->svn_log)) {
            $cmd = self::get_svn_program();
            
            $cmd .= ' log';
            
            if ($stop_on_copy) {
                $cmd .= ' --stop-on-copy';
            }
            
            $cmd .= ' "' . $this->get_name() . '"';
            
            $this->svn_log = shell_exec($cmd);
        }
        
        return $this->svn_log;
    }
    
    public function
        get_svn_log_array($stop_on_copy = FALSE)
    {
        $svn_log = $this->get_svn_log($stop_on_copy);
        
        $svn_log_array = array();
        
        $lines = explode("\n", $svn_log);
        
        $i = 0;
        while ($i < count($lines)) {
            #echo $lines[$i] . "\n";
            
            $regex = '/^r(\d+) \| (\w+) \| (.+) \| (\d+) lines?\s*/';
            
            if (preg_match($regex, $lines[$i], $matches)) {
                #print_r($matches);
                
                $tmp = array();
                
                $tmp['revision'] = $matches[1];
                
                $tmp['committer'] = $matches[2];
                
                $tmp['date'] = $matches[3];
                
                $tmp['lines'] = $matches[4];
                
                $tmp['message'] = '';
                
                $j = $i + 1;
                #echo "\$j: $j\n";
                
                $end_of_message_index = $j + $tmp['lines'];
                #echo "\$end_of_message_index: $end_of_message_index\n";
                
                while ($j <= $end_of_message_index) {
                    #echo $lines[$j] . "\n";
                    
                    $tmp['message'] .= $lines[$j];
                    
                    $j++;
                }
                
                $svn_log_array[] = $tmp;
                
                $i += $tmp['lines'];
            }
            
            $i++;
        }
        
        return $svn_log_array;
    }
    
    /**
     * Returns the revision number of
     * a working directory that is under
     * SVN control.
     * If the directory is not under SVN control,
     * 0 is returned.
     */
    public function
        get_revision_number()
    {
        #$cmd = self::get_svn_program() . ' info ' . $this->get_name();
        #$info = shell_exec($cmd);
        $info = $this->get_svn_info();
        
        foreach (explode("\n", $info) as $info_line) {
            if (preg_match('/^Revision: (\d+)/', $info_line, $matches)) {
                return $matches[1];
            }
        }
        
        return 0;
    }
    
    public function
        get_last_changed_revision()
    {
        $info = $this->get_svn_info();
        
        foreach (explode("\n", $info) as $info_line) {
            if (preg_match('/^Last Changed Rev: (\d+)/', $info_line, $matches)) {
                return $matches[1];
            }
        }
        
        return 0;
    }
    
    public function
        update($silent = TRUE)
    {
        if (!$silent) {
            echo "Updating\n";
            echo $this->get_name();
            echo "\n";
        }
        
        $cmd = self::get_svn_program();
        
        $cmd .= ' update ';
        
        $cmd .= '"' . $this->get_name() . '"';
        
        system($cmd);
    }
}

?>
