<?php
/**
 * Represents a text file.
 *
 * @copyright Clear Line Web Design, 2006-09-18
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_File.inc.php';

/**
 * Represents a text file.
 */
class
    FileSystem_TextFile
extends
    FileSystem_File
{
    public function
        get_lines()
    {
        $lines = array();
        
        if ($this->is_file()) {
            $filename = $this->get_name();
            
            $handle = fopen($filename, 'r');
            
            if ($handle) {
                while (!feof($handle)) {
                    $lines[] = fgets($handle, 4096);
                }
            } else {
                throw new Exception("Couldn't open handle on $filename!");
            }
        }
        
        return $lines;
    }
    
    public function
        is_file()
    {
        return file_exists($this->get_name());
    }
    
    public function
        get_contents()
    {
        return file_get_contents($this->get_name());
    }
    
    public function
        get_as_string()
    {
        return $this->get_contents();
    }
    
    public function
        save()
    {
        $content = $this->get_as_string();
        #echo "\$content: $content\n";
        
        if ($handle = fopen($this->get_name(), 'w')) {
            foreach (split("\n", $content) as $line) {
                fwrite($handle, "$line\n");
            }
            
            fclose($handle);
        }
    }
}

?>
