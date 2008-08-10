<?php
/**
 * Database_DBSubClassesDirectory
 *
 * @copyright Clear Line Web Design, 2007-01-26
 */

require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_Directory.inc.php';

class
    Database_DBSubClassesDirectory
extends
    FileSystem_Directory
{
        ##################################################################
    # For when there is a subclass of Database_Database
    # defined in this module.
    
    private function get_database_subclass_php_class_filename()
    {
        $database_subclass_php_class_filename =
            $this->get_name()
            . '/classes/database/elements/database-subclasses/'
            . $this->get_module_name() . '_Database.inc.php';
        
        return $database_subclass_php_class_filename;
    }
    
    public function has_database_subclass_php_class_file()
    {
        return is_file($this->get_database_subclass_php_class_filename());
    }
    
    public function get_database_subclass_php_class_file()
    {
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "Just entered: CLWDProjects_CLWDSVNWorkingDirectory::get_database_subclass_php_class_file()\n";
            
            $execution_timer = CLWDProjects_ExecutionTimer::get_instance();
            $execution_timer->mark();
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        $database_subclass_php_class_file = null;
        
        if ($this->has_database_subclass_php_class_file()) {
            $database_subclass_php_class_file = new FileSystem_PHPClassFile($this->get_database_subclass_php_class_filename());
        } else {
            $error_message = 'No subclass of Database_Database in ';
            $error_message .= $this->get_module();
            
            throw new Exception($error_message);
        }
        
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "About to return from: CLWDProjects_CLWDSVNWorkingDirectory::get_database_subclass_php_class_file()\n";
            
            $execution_timer->mark();
            
            echo "\$database_subclass_php_class_file:\n";
            echo $database_class_name_override_filename;
            echo "\n";
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        return $database_subclass_php_class_file;
    }
    
    private function get_database_renderer_subclass_php_class_filename()
    {
        $database_renderer_subclass_php_class_filename =
            $this->get_name()
            . '/classes/database/renderers/database-subclasses/'
            . $this->get_module_name() . '_DatabaseRenderer.inc.php';
        
        return $database_renderer_subclass_php_class_filename;
    }
    
    public function has_database_renderer_subclass_php_class_file()
    {
        return is_file($this->get_database_renderer_subclass_php_class_filename());
    }
    
    public function get_database_renderer_subclass_php_class_file()
    {
        $database_renderer_subclass_php_class_file = null;
        
        if ($this->has_database_renderer_subclass_php_class_file()) {
            $database_renderer_subclass_php_class_file
                = new FileSystem_PHPClassFile(
                    $this->get_database_renderer_subclass_php_class_filename()
                );
        } else {
            $error_message = 'No subclass of Database_DatabaseRenderer in ';
            $error_message .= $this->get_module();
            
            throw new Exception($error_message);
        }
        
        return $database_renderer_subclass_php_class_file;
    }
    
    ##################################################################
    # For when there are subclasses of Database_Table defined
    # in this module.
    
    private function get_table_subclass_php_class_filename($table_name)
    {
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "Just entered: CLWDProjects_CLWDSVNWorkingDirectory::get_table_subclass_php_class_filename(...)\n";
            echo "\$table_name: $table_name\n";
            echo "\$this->get_pretty_name():\n";
            echo $this->get_pretty_name();
            echo "\n";
            
            $execution_timer = CLWDProjects_ExecutionTimer::get_instance();
            $execution_timer->mark();
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        $table_name_translator_factory = $this->get_table_name_translator_factory();
        
        $table_name_translator = $table_name_translator_factory->get_table_name_translator($table_name);
        
        $table_subclass_php_class_filename =
            $this->get_name()
            . '/classes/database/elements/table-subclasses/'
            . $this->get_module_name()
            . '_'
            . $table_name_translator->get_table_class_name()
            . '.inc.php';
        
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "About to return from: CLWDProjects_CLWDSVNWorkingDirectory::get_table_subclass_php_class_filename(...)\n";
            $execution_timer->mark();
            
            echo "\$table_subclass_php_class_filename: $table_subclass_php_class_filename\n";
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        return $table_subclass_php_class_filename;
    }
    
    public function has_table_subclass_php_class_file($table_name)
    {
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "Just entered: CLWDProjects_CLWDSVNWorkingDirectory::has_table_subclass_php_class_file(...)\n";
            echo "\$table_name: $table_name\n";
            echo '$this->get_name(): ' . $this->get_name() . "\n";
            echo '$this->get_module_name(): ' . $this->get_module_name() . "\n";
            
            $exection_timer = CLWDProjects_ExecutionTimer::get_instance();
            $exection_timer->mark();
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        $table_subclass_php_class_filename = $this->get_table_subclass_php_class_filename($table_name);
        
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "In: CLWDProjects_CLWDSVNWorkingDirectory::has_table_subclass_php_class_file(...)\n";
            echo "\$table_subclass_php_class_filename: $table_subclass_php_class_filename\n";
            
            $exection_timer->mark();
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        $h_t_s_p_c_f = file_exists($table_subclass_php_class_filename);
        
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "About to return from: CLWDProjects_CLWDSVNWorkingDirectory::has_table_subclass_php_class_file(...)\n";
            $exection_timer->mark();
            
            echo "\$h_t_s_p_c_f: $h_t_s_p_c_f\n";
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        return $h_t_s_p_c_f;
    }
    
    public function get_table_subclass_php_class_file($table_name)
    {
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "Just entered: CLWDProjects_CLWDSVNWorkingDirectory::get_table_subclass_php_class_file(...)\n";
            echo "\$table_name: $table_name\n";
            echo '$this->get_name(): ' . $this->get_name() . "\n";
            echo '$this->get_module_name(): ' . $this->get_module_name() . "\n";
            
            $exection_timer = CLWDProjects_ExecutionTimer::get_instance();
            $exection_timer->mark();
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        $table_subclass_php_class_file = null;
        
        if ($this->has_table_subclass_php_class_file($table_name)) {
            $table_subclass_php_class_file = new FileSystem_PHPClassFile($this->get_table_subclass_php_class_filename($table_name));
        }
        
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "About to return from: CLWDProjects_CLWDSVNWorkingDirectory::get_table_subclass_php_class_file(...)\n";
            $exection_timer->mark();
            
            echo "\$table_subclass_php_class_file:\n";
            echo $table_subclass_php_class_file;
            echo "\n";
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        return $table_subclass_php_class_file;
    }
    
    ##################################################################
    # For when there are subclasses of Database_Row defined
    # in this module.
    
    private function get_row_subclass_php_class_filename($table_name)
    {
        
    }
    
    public function has_row_subclass_php_class_file($table_name)
    {
        
    }
    
    public function get_row_subclass_php_class_file($table_name)
    {
        
    }
    
    ##################################################################
    # For when there are subclasses of Database_Field defined
    # in this module.
    
    private function get_field_subclass_php_class_filename($table_name, $field_name)
    {
        
    }
    
    public function has_field_subclass_php_class_file($table_name, $field_name)
    {
        
    }
    
    public function get_field_subclass_php_class_file($table_name, $field_name)
    {
        
    }
}
?>
