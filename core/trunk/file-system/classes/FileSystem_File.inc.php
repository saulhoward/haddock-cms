<?php
/**
 * FileSystem_File
 *
 * @copyright Clear Line Web Design, 2006-09-17
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/formatting/classes/'
    . 'Formatting_FileName.inc.php';

/**
 * A class to represent a file.
 */
class
    FileSystem_File
{
    private $name;
    
    public function
        __construct($name)
    {
        $this->name = $name;
    }
    
    public function
        get_name()
    {
        return $this->name;
    }
    
    public function
        __toString()
    {
        $str = '';
        
        $reflection_object = new ReflectionObject($this);
        
        $str .= 'Start: ' . $reflection_object->getName() . "\n";
        
        $file_name_formatter = new Formatting_FileName($this->get_name());
        $str .= $file_name_formatter->get_pretty_name();
        
        $str .= 'End: ' . $reflection_object->getName() . "\n";
        
        return $str;
    }
    
    public function
        get_pretty_name()
    {
        $file_name_formatter = new Formatting_FileName($this->get_name());
        return $file_name_formatter->get_pretty_name();
    }
    
    public function
        ctime()
    {
        $stat_data = stat($this->get_name());
        return $stat_data['ctime'];
    }
    
    public function
        mtime()
    {
        $stat_data = stat($this->get_name());
        return $stat_data['mtime'];
    }
    
    public function
        modified_in_last($seconds)
    {
        $stat_data = stat($this->get_name());
        
        $cur_time = time();
        
        $cut_off = $cur_time - $seconds;
        
        $modified_recently = $stat_data['mtime'] > $cut_off;
        
        return $modified_recently;
    }
    
    public function
        get_name_relative_to_dir($directory_name)
    {
        $directory_name_regex = '{^' . $directory_name . '(.*)}';
        $directory_name_regex = preg_replace('/\\\\/', '\\\\\\\\', $directory_name_regex);
        
        if (preg_match($directory_name_regex, $this->get_name(), $matches)) {
            return $matches[1];
        } else {
            throw new Exception($this->get_name() . " is not in $directory_name!");
        }
    }
    
    public function
        equals($other)
    {
        if (isset($other)) {
            if (get_class($this) == get_class($other)) {
                if ($this->get_name() == $other->get_name()) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    public function
        md5($raw_output = FALSE)
    {
        return md5_file($this->get_name(), $raw_output);
    }
    
    public function
        basename()
    {
        return basename($this->get_name());
    }
    
    public function
        dirname()
    {
        return dirname($this->get_name());
    }
    
    public static function
        cmp_name(
            FileSystem_File $a,
            FileSystem_File $b
        )
    {
        #echo '$a->get_name(): ' . $a->get_name() . "\n";
        #echo '$b->get_name(): ' . $b->get_name() . "\n";
        
        if ($a->get_name() == $b->get_name()) {
            return 0;
        }
        
        if ($a->get_name() < $b->get_name()) {
            return -1;
        }
        
        if ($a->get_name() > $b->get_name()) {
            return 1;
        }
    }
    
    public static function
        cmp_ctime(
            FileSystem_File1 $a,
            FileSystem_File $b
        )
    {
        #echo '$a->ctime(): ' . $a->ctime() . "\n";
        #echo '$b->ctime(): ' . $b->ctime() . "\n";
        
        return $a->ctime() - $b->ctime();
    }
    
    public function
        get_disk_usage()
    {
        $disk_usage = 0;
        
        #echo "print_r($_SERVER)\n";
        #print_r($_SERVER);
        
        #if ($_SERVER['OS'] == 'Windows_NT') {
        if (substr(PHP_OS,0,3) == 'WIN') {
            $du_program = 'du.exe';
        } else {
            $du_program = '/usr/bin/du';
        }
        
        $cmd = $du_program . ' -s "' . $this->get_name() . '"';
        
        #echo "\$cmd: $cmd\n";
        
        $shell_output = shell_exec($cmd);
        
        #echo $shell_output;
        
        if (preg_match('/^(\d+)/', $shell_output, $matches)) {
            $disk_usage = $matches[1];
        }
        
        return $disk_usage;
    }
}
?>
