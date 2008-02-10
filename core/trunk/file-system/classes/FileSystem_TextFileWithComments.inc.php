<?php
/**
 * FileSystem_TextFileWithComments
 *
 * @copyright Clear Line Web Design, 2006-09-18
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_TextFile.inc.php';

/**
 * A class that is able to extract data from
 * text files with # comments.
 */
class
    FileSystem_TextFileWithComments
extends
    FileSystem_TextFile
{
    /**
     * Returns the lines of the file with
     * # comments removed.
     * This also removes blank lines and leading and trailing
     * whitespace.
     */
    public function
        get_lines_without_comments()
    {
        $lines = $this->get_lines();
        
        $lines_without_comments = array();
        
        foreach ($lines as $line) {
            # Remove leading and trailing whitespace.
            $line = preg_replace('/(?:^\s+|\s+$)/', '', $line);
            
            # Remove comments.
            $line = preg_replace('/\s*#.*$/', '', $line); 
            
            # Add the line to the return list if it contains
            # characters.
            if (strlen($line) > 0) { 
                $lines_without_comments[] = $line;
            }
        }
        
        #echo "FileSystem_TextFileWithComments::get_lines_without_comments()\n";
        #echo "\$lines_without_comments: \n";
        #print_r($lines_without_comments);
        
        return $lines_without_comments;
    }
    
    # DEPRECATED?
    # see FileSystem_DataFile::get_data(...)
    
    /**
     * Splits lines up into arrays, splitting
     * on whitespace.
     */
    public function
        get_data_from_lines()
    {
        $lines = $this->get_lines_without_comments();
        
        $data = array();
        
        foreach ($lines as $line) {
            $data[] = preg_split('/\s+/', $line);
        }
        
        return $data;
    }
}

?>