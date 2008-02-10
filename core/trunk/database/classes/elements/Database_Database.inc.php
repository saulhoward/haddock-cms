<?php
/**
 * Database_Database
 *
 * @copyright Clear Line Web Design, 2006-09-17
 */

/**
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_Element.inc.php';

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_DatabaseClassFactory.inc.php';

/**
 * A class to represent a database.
 */
class
    Database_Database
extends
    Database_Element
{
    private $mysql_user;
    private $name;
    
    ###################
    # The constructor #
    ###################
    
    public function
        __construct($mysql_user, $name)
    {
        $this->mysql_user = $mysql_user;
        $this->name = $name;
    }
    
    public function __toString()
    {
        $str = '';
        
        $reflection_object = new ReflectionObject($this);
        
        $str .= 'Start: ' . $reflection_object->getName() . "\n";
        
        $str .= "\$this->mysql_user:\n";
        
        $str .= "\n";
        $str .= $this->mysql_user->__toString();
        $str .= "\n";
        
        $str .= "\$this->name:\n";
        
        $str .= $this->name;
        $str .= "\n";
        
        $str .= 'End: ' . $reflection_object->getName() . "\n";
        
        return $str;
    }
    
    #############
    # Accessors #
    #############
    
    public function
        get_name()
    {
        return $this->name;
    }
    
    public function
        get_mysql_user()
    {
        return $this->mysql_user;
    }
    
    public function
        get_database_handle()
    {
        $mysql_user = $this->get_mysql_user();
        return $mysql_user->get_database_handle();
    }
    
    ##################
    # Getting Tables #
    ##################
    
    /**
     * @return An array of strings of the names of the tables in this database.
     */
    public function
        get_table_names()
    {
        $dbh = $this->get_database_handle();
        
        $query = 'SHOW TABLES';
        
        $result = mysql_query($query, $dbh);
        
        $table_names = array();
        
        while ($row = mysql_fetch_array($result)) {
            $table_names[] = $row[0];
        }
        
        return $table_names;
    }
    
    /**
     * @return An array of Table (or Table subclass) objects for the tables in this database.
     */
    public function
        get_tables()
    {
        $table_names = $this->get_table_names();
        
        $tables = array();
        
        foreach ($table_names as $table_name) {
            $tables[] = $this->get_table($table_name);
        }
        
        return $tables;
    }
    
    public function
        has_table($table_name)
    {
        $table_names = $this->get_table_names();
        return in_array($table_name, $table_names);
    }
    
    #####################################
    # Factory methods for Table classes #
    #####################################
    
    /**
     * Returns the filename of the Table subclass.
     *
     * Does no filechecking!
     */
    #public function get_table_subclass_filename($table_name)
    #{
    #    $table_name_translator = TableNameTranslator::get_instance();
    #    
    #    #print_r($table_name_translator);
    #    
    #    $table_subclass_name = $table_name_translator->get_table_subclass_name($table_name);
    #    
    #    $table_subclasses_directory = PROJECT_ROOT . '/classes/database/elements/table-subclasses';
    #    
    #    $table_subclass_file_name = "$table_subclasses_directory/$table_subclass_name.inc.php";
    #    
    #    #echo "TScFm: $table_subclass_file_name\n";
    #    
    #    return $table_subclass_file_name;
    #}
    #
    #public function has_table_subclass($table_name)
    #{
    #    return file_exists($this->get_table_subclass_filename($table_name));
    #}
    #
    #/**
    # * If the table has a Table subclass that name is
    # * returned, otherwise the default Table class
    # * filename is returned.
    # */
    #public function get_table_class_filename($table_name)
    #{
    #    if ($this->has_table_subclass($table_name)) {
    #        return $this->get_table_subclass_filename($table_name);
    #    } else {
    #        if (preg_match('/\w+_images/', $table_name)) {
    #            return CLWD_CORE_ROOT . '/database/elements/table-subclasses/ImagesTable.inc.php';
    #        } else {
    #            return CLWD_CORE_ROOT . '/database/elements/Table.inc.php';
    #        }
    #    }
    #}
    #
    #public function get_table_class_name($table_name)
    #{
    #    if ($this->has_table_subclass($table_name)) {
    #        #echo "Has table subclass!\n";
    #        $table_name_translator = TableNameTranslator::get_instance();
    #        return $table_name_translator->get_table_subclass_name($table_name);
    #    } else {
    #        if (preg_match('/\w+_images/', $table_name)) {
    #            return 'ImagesTable';
    #        } else {
    #            #echo "Doesn't have table subclass!\n";
    #            return 'Table';
    #        }
    #    }
    #}
    #
    #public function declare_table_class($table_name)
    #{
    #    require_once $this->get_table_class_filename($table_name);
    #}
    #
    #public function get_table_class($table_name)
    #{
    #    $this->declare_table_class($table_name);
    #    return new ReflectionClass($this->get_table_class_name($table_name));
    #}
    
    public final function
        get_table($table_name)
    {
        if ($this->has_table($table_name)) {
            $database_class_factory = Database_DatabaseClassFactory::get_instance();
            
            $table_class = $database_class_factory->get_table_class($table_name);
                    
            $table = $table_class->newInstance($this, $table_name);
            #print_r($table);
            
            return $table;
        } else {
            $database_name = $this->get_name();
            
            $msg = <<<MSG
No table called "$table_name" in the "$database_name" database!
MSG;

            throw new Exception($msg);
        }
    }
    
    ####################################
    # Methods for getting the renderer #
    ####################################
    
    #public function get_renderer_class_filename()
    #{
    #    return CLWD_CORE_ROOT . '/database/renderers/DatabaseRenderer.inc.php';
    #}
    #
    #public function get_renderer_class_name()
    #{
    #    return 'DatabaseRenderer';
    #}
    #
    #public function declare_renderer_class()
    #{
    #    require_once $this->get_renderer_class_filename();
    #}
    #
    #public function get_renderer_class()
    #{
    #    $this->declare_renderer_class();
    #    return new ReflectionClass($this->get_renderer_class_name());
    #}
    
    public final function
        get_renderer()
    {
        #$renderer_class = $this->get_renderer_class();
        #return $renderer_class->newInstance($this);
        
        $database_class_factory = Database_DatabaseClassFactory::get_instance();
        
        $database_renderer_class = $database_class_factory->get_database_renderer_class();
        
        $renderer = $database_renderer_class->newInstance($this);
        
        return $renderer;
    }
    
    public function
        get_disk_usage()
    {
        $disk_usage = 0;
        
        $dbh = $this->get_database_handle();
        
        $result = mysql_query("SHOW TABLE STATUS", $dbh);
        
        while ($row = mysql_fetch_array($result)) {
            #print_r($row);
            
            $disk_usage += $row["Data_length"];
            $disk_usage += $row["Index_length"];
        }
        
        $disk_usage /= pow(2, 10);
        
        return $disk_usage;
    }
}

?>
