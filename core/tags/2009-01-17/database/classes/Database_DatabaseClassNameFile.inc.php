<?php
/**
 * Database_DatabaseClassNameFile
 *
 * @copyright Clear Line Web Design, 2006-11-17
 */

/*
 * Define the necessary classes.
 */
#require_once PROJECT_ROOT
#    . '/haddock/file-system/classes/'
#    . 'FileSystem_TextFileWithComments.inc.php';

require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_XMLFile.inc.php';

require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_PHPClassFile.inc.php';

/**
 * Parses a specially formatted text file and
 * extracts the data for which classes should
 * be used for which table and so on.
 *
 * If no class is set in the file, an error is thrown.
 *
 * The Database_DatabaseClassFactory should check whether
 * a class has be set before asking for a file and then
 * return one of the default classes.
 */
class
    Database_DatabaseClassNameFile
extends
    #FileSystem_TextFileWithComments
    FileSystem_XMLFile
{
    /**
     * A FileSystem_PHPClassFile which contains a definition
     * of the Database_Database class or one of its subclasses.
     *
     * The Database_Database will be the class
     * that represents the database used by this project.
     */
    private $database_class_file;
    
    /**
     * Its renderer.
     */
    private $database_renderer_class_file;
    
    /**
     * An associative array of FileSystem_PHPClassFile objects which contain
     * definitions of the Database_Table class or one of its subclasses.
     *
     * The key is the table name.
     */
    private $table_class_files;
    
    /**
     * Their renderers.
     */
    
    private $table_renderer_class_files;
    
    /**
     * An associative array of FileSystem_PHPClassFile objects which contain
     * definitions of the Database_Row class or one of its subclasses.
     * 
     * The key is the table name.
     */
    private $row_class_files;
    
    /**
     * Their renderers.
     */
    
    private $row_renderer_class_files;
    
    /**
     * An 2D associative array of FileSystem_PHPClassFile objects which contain
     * definitions of the Database_Row class or one of its subclasses.
     *
     * The first key is the name of the table to which the fields
     * belong and the second is the field name.
     */
    private $field_class_files;
    
    /**
     * Their renderers.
     */
    
    private $field_renderer_class_files;
    
    ############################################################
    
    public function
        __construct($file_name)
    {
        parent::__construct($file_name);
        
        #$lines = $this->get_lines_without_comments();
        #        
        #foreach ($lines as $line) {
        #    if (preg_match('/database.class=(.+)/', $line, $matches)) {
        #        $this->database_class_file
        #            = new FileSystem_PHPClassFile(PROJECT_ROOT . $matches[1]);
        #    }
        #    
        #    if (preg_match('/database.renderer=(.+)/', $line, $matches)) {
        #        $this->database_renderer_class_file
        #            = new FileSystem_PHPClassFile(PROJECT_ROOT . $matches[1]);
        #    }
        #    
        #    if (preg_match('/table.(\w+).class=(.+)/', $line, $matches)) {
        #        $this->table_class_files[$matches[1]]
        #            = new FileSystem_PHPClassFile(PROJECT_ROOT . $matches[2]);
        #    }
        #    
        #    if (preg_match('/table.(\w+).renderer=(.+)/', $line, $matches)) {
        #        $this->table_renderer_class_files[$matches[1]]
        #            = new FileSystem_PHPClassFile(PROJECT_ROOT . $matches[2]);
        #    }
        #
        #    if (preg_match('/row.(\w+).class=(.+)/', $line, $matches)) {
        #        $this->row_class_files[$matches[1]]
        #            = new FileSystem_PHPClassFile(PROJECT_ROOT . $matches[2]);
        #    }
        #    
        #    if (preg_match('/row.(\w+).renderer=(.+)/', $line, $matches)) {
        #        $this->row_renderer_class_files[$matches[1]]
        #            = new FileSystem_PHPClassFile(PROJECT_ROOT . $matches[2]);
        #    }
        #
        #    if (preg_match('/field.(\w+).(\w+).class=(.+)/', $line, $matches)) {
        #        $this->field_class_files[$matches[1]][$matches[2]]
        #            = new FileSystem_PHPClassFile(PROJECT_ROOT . $matches[3]);
        #    }
        #
        #    if (preg_match('/field.(\w+).(\w+).renderer=(.+)/', $line, $matches)) {
        #        $this->field_renderer_class_files[$matches[1]][$matches[2]]
        #            = new FileSystem_PHPClassFile(PROJECT_ROOT . $matches[3]);
        #    }
        #}
    }
    
    ############################################################
    # Tell us about what classes have been set in this file.
    
    public function has_database_class_file()
    {
        return isset($this->database_class_file);
    }
    
    public function has_database_renderer_class_file()
    {
        return isset($this->database_renderer_class_file);
    }
    
    public function has_table_class_file($table_name)
    {
        return isset($this->table_class_files[$table_name]);
    }
    
    public function has_table_renderer_class_file($table_name)
    {
        return isset($this->table_renderer_class_files[$table_name]);
    }
    
    public function has_row_class_file($table_name)
    {
        return isset($this->row_class_files[$table_name]);
    }
    
    public function has_row_renderer_class_file($table_name)
    {
        return isset($this->row_renderer_class_files[$table_name]);
    }
    
    public function has_field_class_file($table_name, $field_name)
    {
        return isset($this->field_class_files[$table_name][$field_name]);
    }
    
    public function has_field_renderer_class_file($table_name, $field_name)
    {
        return isset($this->field_renderer_class_files[$table_name][$field_name]);
    }
    
    ############################################################
    # Get the classes.
    
    public function get_database_class_file()
    {
        if (isset($this->database_class_file)) {
            return $this->database_class_file;
        } else {
            throw new Exception("No database class set in:\n" . $this->get_pretty_name());
        }
    }
    
    public function get_database_renderer_class_file()
    {
        if (isset($this->database_renderer_class_file)) {
            return $this->database_renderer_class_file;
        } else {
            throw new Exception("No database renderer class set in:\n" . $this->get_pretty_name());
        }
    }
    
    public function get_table_class_file($table_name)
    {
        if (isset($this->table_class_files[$table_name])) {
            return $this->table_class_files[$table_name];
        } else {
            throw new Exception("No table class set for $table_name in:\n" . $this->get_pretty_name());
        }
    }
    
    public function get_table_renderer_class_file($table_name)
    {
        if (isset($this->table_renderer_class_files[$table_name])) {
            return $this->table_renderer_class_files[$table_name];
        } else {
            throw new Exception("No table renderer class set for $table_name in:\n" . $this->get_pretty_name());
        }
    }
    
    public function get_row_class_file($table_name)
    {
        if (isset($this->row_class_files[$table_name])) {
            return $this->row_class_files[$table_name];
        } else {
            throw new Exception("No row class set for $table_name in:\n" . $this->get_pretty_name());
        }
    }
    
    public function get_row_renderer_class_file($table_name)
    {
        if (isset($this->row_renderer_class_files[$table_name])) {
            return $this->row_renderer_class_files[$table_name];
        } else {
            throw new Exception("No row renderer class set for $table_name in:\n" . $this->get_pretty_name());
        }
    }
    
    public function get_field_class_file($table_name, $field_name)
    {
        if (isset($this->field_class_files[$table_name][$field_name])) {
            return $this->field_class_files[$table_name][$field_name];
        } else {
            throw new Exception("No field class set for $field_name in $table_name in:\n" . $this->get_pretty_name());
        }
    }
    
    public function get_field_renderer_class_file($table_name, $field_name)
    {
        if (isset($this->field_renderer_class_files[$table_name][$field_name])) {
            return $this->field_renderer_class_files[$table_name][$field_name];
        } else {
            throw new Exception("No field class set for $field_name in $table_name in:\n" . $this->get_pretty_name());
        }
    }
    
    ############################################################
    # Set the classes.
    
    public function set_database_class_file(FileSystem_PHPClassFile $database_class_file)
    {
        $this->database_class_file = $database_class_file;
    }
    
    public function set_database_renderer_class_file(FileSystem_PHPClassFile $database_renderer_class_file)
    {
        $this->database_renderer_class_file = $database_renderer_class_file;
    }
    
    public function set_table_class_file($table_name, FileSystem_PHPClassFile $table_class_file)
    {
        $this->table_class_files[$table_name] = $table_class_file;
    }
    
    public function set_table_renderer_class_file($table_name, FileSystem_PHPClassFile $table_renderer_class_file)
    {
        $this->table_renderer_class_files[$table_name] = $table_renderer_class_file;
    }
    
    public function set_row_class_file($table_name, FileSystem_PHPClassFile $row_class_file)
    {
        $this->row_class_files[$table_name] = $row_class_file;
    }
    
    public function set_row_renderer_class_file($table_name, FileSystem_PHPClassFile $row_renderer_class_file)
    {
        $this->row_renderer_class_files[$table_name] = $row_renderer_class_file;
    }
    
    public function set_field_class_file($table_name, $field_name, FileSystem_PHPClassFile $field_class_file)
    {
        $this->field_class_files[$table_name][$field_name] = $field_class_file;
    }
    
    public function set_field_renderer_class_file($table_name, $field_name, FileSystem_PHPClassFile $field_renderer_class_file)
    {
        $this->field_renderer_class_files[$table_name][$field_name] = $field_renderer_class_file;
    }
    
    /**
     * Makes a backup of the old file, if there is one,
     * and then writes the values to file in our custom format.
     */
    public function commit()
    {
        ## Make a backup copy of the old file, if it exists.
        ##if (file_exists($this->get_name())) {
        ##    $old_filename = $this->get_name();
        ##    $time = time();
        ##    
        ##    $backup_filename = preg_replace('/(?=\.txt$)/', "-$time", $old_filename);
        ##    
        ##    rename($old_filename, $backup_filename);
        ##}
        #
        #$file_handle = fopen($this->get_name(), 'w');
        $dom_document = $this->get_dom_document();
        
        #print_r($dom_document);
               
        #$dom_document->appendChild($date_element);
        
        ## Write the database class and renderer filenames, if any.
        #fwrite($file_handle, "\n# Database class and renderer.\n\n");
        #
        #if (isset($this->database_class_file)) {
        #    fwrite($file_handle, 'database.class=' . $this->database_class_file->get_name() . "\n");
        #}
        #
        #if (isset($this->database_renderer_class_file)) {
        #    fwrite($file_handle, 'database.renderer=' . $this->database_renderer_class_file->get_name() . "\n");
        #}
        #
        ## Write the table class and renderer filenames, if any.
        #fwrite($file_handle, "\n# Table classes and renderers.\n\n");
        #
        #if (is_array($this->table_class_files)) {
        #    $table_names = array_keys($this->table_class_files);
        #    sort($table_names);
        #    
        #    foreach ($table_names as $table_name) {
        #        fwrite($file_handle, "table.$table_name.class=" . $this->table_class_files[$table_name]->get_name() . "\n");
        #    }
        #}
        #
        #if (is_array($this->table_renderer_class_files)) {
        #    $table_names = array_keys($this->table_renderer_class_files);
        #    sort($table_names);
        #    
        #    foreach ($table_names as $table_name) {
        #        fwrite($file_handle, "table.$table_name.renderer=" . $this->table_renderer_class_files[$table_name]->get_name() . "\n");
        #    }
        #}
        #
        ## Write the row class and renderer filenames, if any.
        #fwrite($file_handle, "\n# Row classes and renderers.\n\n");
        #
        #if (is_array($this->row_class_files)) {
        #    $table_names = array_keys($this->row_class_files);
        #    sort($table_names);
        #    
        #    foreach ($table_names as $table_name) {
        #        fwrite($file_handle, "row.$table_name.class=" . $this->row_class_files[$table_name]->get_name() . "\n");
        #    }
        #}
        #
        #if (is_array($this->row_renderer_class_files)) {
        #    $table_names = array_keys($this->row_renderer_class_files);
        #    sort($table_names);
        #    
        #    foreach ($table_names as $table_name) {
        #        fwrite($file_handle, "row.$table_name.renderer=" . $this->row_renderer_class_files[$table_name]->get_name() . "\n");
        #    }
        #}
        #
        ## Write the field class and renderer filenames, if any.
        #fwrite($file_handle, "\n# Field classes and renderers.\n\n");
        #
        #if (is_array($this->field_class_files)) {
        #    $table_names = array_keys($this->field_class_files);
        #    sort($table_names);
        #    
        #    foreach ($table_names as $table_name) {
        #        if (is_array($this->field_class_files[$table_name])) {
        #            $field_names = array_keys($this->field_class_files[$table_name]);
        #            sort($field_names);
        #            
        #            foreach ($field_names as $field_name) {
        #                fwrite($file_handle, "field.$table_name.$field_name.class=" . $this->field_class_files[$table_name][$field_name]->get_name() . "\n");
        #            }
        #        }
        #    }
        #}
        #
        #if (is_array($this->field_renderer_class_files)) {
        #    $table_names = array_keys($this->field_renderer_class_files);
        #    sort($table_names);
        #    
        #    foreach ($table_names as $table_name) {
        #        if (is_array($this->field_renderer_class_files[$table_name])) {
        #            $field_names = array_keys($this->field_renderer_class_files[$table_name]);
        #            sort($field_names);
        #            
        #            foreach ($field_names as $field_name) {
        #                fwrite($file_handle, "field.$table_name.$field_name.renderer=" . $this->field_renderer_class_files[$table_name][$field_name]->get_name() . "\n");
        #            }
        #        }
        #    }
        #}
        #
        #fclose($file_handle);
        
        /*
         * The database node.
         */
        $database_element = $dom_document->createElement('database');
        
        $dom_document->appendChild($database_element);
        
        $database_class_filename_element = $dom_document->createElement(
            'class_filename',
            $this->database_class_file->get_name()
        );
        
        $database_element->appendChild($database_class_filename_element);
        
        $database_renderer_class_filename_element
            = $dom_document->createElement(
                'renderer_class_filename',
                $this->database_renderer_class_file->get_name()
            );
        
        $database_element->appendChild(
            $database_renderer_class_filename_element
        );
        
        /*
         * Loop for the tables.
         */
        foreach ($this->get_table_names() as $table_name) {
            $table_element = $dom_document->createElement('table');
            $table_element->setAttribute('name', $table_name);
            $database_element->appendChild($table_element);
            
            if (isset($this->table_class_files[$table_name])) {
                $table_class_name_element = $dom_document->createElement(
                    'table_class_name',
                    $this->table_class_files[$table_name]->get_name()
                );
                
                $table_element->appendChild($table_class_name_element);
            }
            
            if (isset($this->table_renderer_class_files[$table_name])) {
                $table_renderer_class_name_element = $dom_document->createElement(
                    'table_renderer_class_name',
                    $this->table_renderer_class_files[$table_name]->get_name()
                );
                
                $table_element->appendChild($table_renderer_class_name_element);
            }
        }
        
        parent::commit();
    }
    
    public function
        get_table_names()
    {
        $table_names = array();
        
        $table_names = array_merge(
            array_keys($this->table_class_files),
            array_keys($this->table_renderer_class_files),
            array_keys($this->row_class_files),
            array_keys($this->row_renderer_class_files),
            array_keys($this->field_class_files),
            array_keys($this->field_renderer_class_files)            
        );
        
        $table_names = array_unique($table_names);
        
        sort($table_names);
        
        return $table_names;
    }
}

?>
