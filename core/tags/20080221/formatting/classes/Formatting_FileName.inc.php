<?php
/**
 * Formatting_FileName
 *
 * @copyright Clear Line Web Design, 2006-11-14
 */

/**
 * A class to format file names.
 */
class
    Formatting_FileName
{
    private $file_name;
    
    public function
        __construct($file_name)
    {
        $this->file_name = realpath($file_name);
    }
    
    public function
        get_file_name()
    {
        return $this->file_name;
    }
    
    /**
     * Splits the filename into parts (directories).
     */
    public function
        get_parts()
    {
        $parts = preg_split('{(?:\\\\|/)}', $this->get_file_name());
        
        return $parts;
    }
    
    public function
        get_pretty_name()
    {
        $pretty_string = '';
        
        $parts = $this->get_parts();
        
        $indent = '';
        
        foreach ($parts as $part) {            
            $pretty_string .= $indent . $part . "\n";
            $indent .= '  ';
        }
        
        return $pretty_string;
    }
    
    public function
        pretty_print()
    {
        echo $this->get_pretty_name();
    }
}
?>
