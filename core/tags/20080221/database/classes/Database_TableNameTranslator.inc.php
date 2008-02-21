<?php
/**
 * Database_TableNameTranslator
 *
 * @copyright Clear Line Web Design, 2006-11-13
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/formatting/classes/'
    . 'Formatting_ListOfWords.inc.php';

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ModuleDirectory.inc.php';

/**
 * Translates a table name to the root a PHP class name.
 *
 * e.g.
 * For a table called "foo_bars" that is part of a module called
 * "baz-gaz" the row class is called "BazGaz_FooBarRow" and the
 * table class is called "BazGaz_FooBarsTable".
 * 
 * A field of this table called "image" is called
 * "BazGaz_FooBarsTableImageField".
 */
class
    Database_TableNameTranslator
{
    private $clwd_svn_working_directory;
    
    private $table_name;
    
    private $table_name_as_list_of_words;
    
    private $table_name_as_class_root;
    
    private $table_class_name;
    private $row_class_name;
    private $field_class_names;
    
    public function __construct(
        CLWDProjects_CLWDSVNWorkingDirectory $clwd_svn_working_directory,
        $table_name
    )
    {
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "Just entered: Database_TableNameTranslator::__construct(...)\n";
            echo "\$clwd_svn_working_directory:\n";
            echo $clwd_svn_working_directory;
            echo "\n";
            echo "\$table_name: $table_name\n";
            
            $execution_timer = CLWDProjects_ExecutionTimer::get_instance();
            $execution_timer->mark();
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        $this->clwd_svn_working_directory = $clwd_svn_working_directory;
        $this->table_name = $table_name;
    }
    
    public function __toString()
    {
        $str = '';
        
        $reflection_object = new ReflectionObject($this);
        
        $str .= 'Start: ' . $reflection_object->getName() . "\n";
        
        $str .= $this->clwd_svn_working_directory->get_pretty_name();
        
        $str .= '$this->table_name: ' . $this->table_name . "\n";
        
        if (isset($this->table_class_name)) {
            $str .= '$this->table_class_name: ' . $this->table_class_name . "\n";
        }
        
        if (isset($this->row_class_name)) {
            $str .= '$this->row_class_name: ' . $this->row_class_name . "\n";
        }
        
        if (isset($this->field_class_names)) {
            $field_names = array_keys($this->field_class_names);
            foreach ($field_names as $field_name) {
                $str .= '$this->field_class_names[' . $field_name . ']: ';
                $str .= $this->field_class_names[$field_name];
                $str .= "\n";
            }
        }
        
        $str .= 'End: ' . $reflection_object->getName() . "\n";
        
        return $str;
    }
    
    public function get_clwd_svn_working_directory()
    {
        return $this->clwd_svn_working_directory;
    }
    
    public function get_table_name()
    {
        return $this->table_name;
    }
    
    private function get_table_name_as_list_of_words()
    {
        if (!isset($this->table_name_as_list_of_words)) {
            $this->table_name_as_list_of_words = Formatting_ListOfWords::get_list_of_words_for_string($this->get_table_name(), '_');
        }
        
        return $this->table_name_as_list_of_words;
    }
    
    /**
     * Produces the roots that are used to make the
     * names of the Table and Row subclasses.
     *
     * e.g. Foo_Bar
     *
     * where "Foo" is the camel-case name of the
     * module that is stored in this objects CLWD SVN working
     * directory and "Bar" is the camel-case name of the
     * table.
     */
    private function get_table_name_as_class_root()
    {
        if (!isset($this->table_name_as_class_root)) {
            $this->table_name_as_class_root = '';
            
            # Put the module name at the front.
            $clwd_svn_working_directory = $this->get_clwd_svn_working_directory();
            $this->table_name_as_class_root .= $clwd_svn_working_directory->get_module_name();
            
            # An underscore to the separate module name from the class name.
            $this->table_name_as_class_root .= '_';
            
            # Add the table name in camel-case.
            $table_name_as_list_of_words = $this->get_table_name_as_list_of_words();
            $this->table_name_as_class_root .= $table_name_as_list_of_words->get_words_as_camel_case_string();
        }
        
        return $this->table_name_as_class_root;
    }
    
    public function get_table_class_name()
    {
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "Just entered: Database_TableNameTranslator::get_table_class_name()\n";
            echo '$this->get_table_name(): ' . $this->get_table_name() . "\n";
            
            $exection_timer = CLWDProjects_ExecutionTimer::get_instance();
            $exection_timer->mark();
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        if (!isset($this->table_class_name)) {
            $this->table_class_name = $this->get_table_name_as_class_root();
            
            $this->table_class_name .= 'Table';
        } else {
            if (DEBUG) {
                echo DEBUG_DELIM_OPEN;
                
                echo "\$this->table_class_name is already set!\n";
                
                $exection_timer->mark();
                
                echo DEBUG_DELIM_CLOSE;
            }
        }
        
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "About to return from: Database_TableNameTranslator::get_table_class_name()\n";
            echo '$this->table_class_name: ';
            echo $this->table_class_name;
            echo "\n";
            
            $exection_timer->mark();
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        return $this->table_class_name;
    }
    
    public function get_row_class_name()
    {
        if (!isset($this->row_class_name)) {
            $table_name_as_class_root = $this->get_table_name_as_class_root();
            
            $this->row_class_name = rtrim($table_name_as_class_root, 's');
            $this->row_class_name .= 'Row';
        }
        
        return $this->row_class_name;
    }
    
    public function get_field_class_name($field_name)
    {
        if (!isset($this->field_class_names[$field_name])) {
            $this->field_class_names[$field_name] = $this->get_table_class_name();
            
            $field_name_l_o_w = Formatting_ListOfWords::get_list_of_words_for_string($field_name, '_');
            
            $this->field_class_names[$field_name] .= $field_name_l_o_w->get_words_as_camel_case_string();
            
            $this->field_class_names[$field_name] .= 'Field';
        }
        
        return $this->field_class_names[$field_name];
    }
}

?>
