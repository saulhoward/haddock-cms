<?php
/**
 * FileSystem_DataFile
 *
 * @copy Clear Line Web Design, 2006-11-13
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_TextFileWithComments.inc.php';

/**
 * A class for extracting data from correctly
 * formatted text files.
 *
 * Comments start with '#'.
 */
class
    FileSystem_DataFile
extends
    FileSystem_TextFileWithComments
{
    /*
     * -------------------------------------------------------------------------
     * Instance variables.
     * -------------------------------------------------------------------------
     */
    
    /**
     * The data of the file.
     */
    private $data;
    
    /**
     * The key value pairs of the file.
     */
    private $key_value_pairs;
    
    /*
     * -------------------------------------------------------------------------
     * Methods.
     * -------------------------------------------------------------------------
     */
    
    /**
     * Returns a 2D array of the data saved in this file.
     *
     * The first dimension matches up with the lines of the file.
     *
     * The second dimension matches up with the strings extracted from
     * each line.
     *
     * @param
     *  string
     *  $separator
     *  The string/character that delimits data on a line.
     * @return
     *  array
     *  The data of the file.
     */
    public function
        get_data($separator = ' ')
    {
        if (!isset($this->data)) {
            $this->data = array();
        }
        
        if (!isset($this->data[$separator])) {
            $lines_without_comments = $this->get_lines_without_comments();
            
            $regex = '/^'
                . '\s*'
                . '[^' . $separator . ']+'
                . '(?:' . $separator . '[^' . $separator. ']+)*'
                . '\s*'
                . '$/';
            
            #echo "FileSystem_DataFile::get_data(...)\n";
            #echo "\$regex: $regex\n";
                
            foreach ($lines_without_comments as $line) {
                if (preg_match($regex, $line)) {
                    $this->data[$separator][] = explode($separator, $line);
                }
            }
        }
        
        #echo "FileSystem_DataFile::get_data(...)\n";
        #echo "\$this->data:\n";
        #print_r($this->data);
        
        return $this->data[$separator];
    }
    
    /**
     * Parses a correctly formatted text file into an associative array
     * of data.
     *
     * e.g.
     *
     * # Foo File
     *
     * foo=Fu
     * bar=Black Sheep
     *
     * goes to:
     *
     * $data['foo'] = 'Fu';
     * $data['bar'] = 'Black Sheep';
     *
     * If a key is set twice, the method silently overrides the first value.
     * 
     * @param
     *  string
     *  $separator
     *  The string used to separate the key from the value.
     * @return
     *  assoc
     *  The data in this file as an associative array.
     */
    public function
        get_key_value_pairs($separator = '=')
    {
        if (!isset($this->key_value_pairs)) {
            $this->key_value_pairs = array();
        }
        
        if (!isset($this->key_value_pairs[$separator])) {
            $this->key_value_pairs[$separator] = array();
            $data_lines = $this->get_data($separator);
            
            #print_r($data_lines);
            
            foreach ($data_lines as $data_line) {
                if (count($data_line) == 2) {
                    $this->key_value_pairs[$separator][$data_line[0]]
                        = $data_line[1];
                }
            }
        }
        
        return $this->key_value_pairs[$separator];
    }
    
    /**
     * Says whether a key has been set in this file.
     *
     * @param
     *  string
     *  $key
     *  The name of the key that we want.
     * @param
     *  string
     *  $separator
     *  The string/character that delimits data on a line.
     * @return
     *  boolean
     *  Set or not.
     */
    public function
        has_value_for($key, $separator = '=')
    {
        $key_value_pairs = $this->get_key_value_pairs($separator);
        
        #print_r($key_value_pairs);
        
        return isset($key_value_pairs[$key]);
    }
    
    /**
     * Gets a value for the given key that is defined
     * in this data file.
     *
     * @param
     *  string
     *  $key
     *  The name of the key that we want.
     * @param
     *  string
     *  $separator
     *  The string/character that delimits data on a line.
     * @return
     *  string The value for that key.
     * @throws
     *  Exception
     *  If <code>$key</code> is not set.
     */
    public function
        get_value_for($key, $separator = '=')
    {
        if ($this->has_value_for($key, $separator)) {
            $key_value_pairs = $this->get_key_value_pairs($separator);
            
            return $key_value_pairs[$key];
        } else {
            $msg = "\"$key\""
                    . 'not set in FileSystem_DataFile: '
                    . $this->get_name()
                    . " delimited by \"$separator\"!";
            
            throw new Exception($msg);
        }
    }
}
?>
