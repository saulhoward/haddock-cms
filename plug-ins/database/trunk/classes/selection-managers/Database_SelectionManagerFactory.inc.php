<?php
/**
 * Database_SelectionManagerFactory
 *
 * @copyright Clear Line Web Design, 2007-03-16
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/file-system/classes/'
    . 'FileSystem_PHPClassFile.inc.php';

require_once PROJECT_ROOT
    . '/haddock/database/classes/selection-managers/'
    . 'Database_SelectionManagersFile.inc.php';

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';
    
class
    Database_SelectionManagerFactory
{
    static private $instance = NULL;
    
    private $default_selection_manager_reflection_class;
    
    private $selection_managers_file = NULL;
    
    private $selection_managers;
    
    private function
        __construct()
    {
        /*
         * The default selection manager.
         */
        $default_selection_manager_class_file
            = new FileSystem_PHPClassFile(
                PROJECT_ROOT
                . '/haddock/database/classes/selection-managers/'
                . 'Database_SelectionManager.inc.php');
        
        $default_selection_manager_class_file->declare_class();
        
        $this->default_selection_manager_reflection_class
            = new ReflectionClass(
                $default_selection_manager_class_file->get_php_class_name()
            );
        
        /*
         * Has this project set up any selection managers?
         */
        $selection_managers_filename =
            PROJECT_ROOT
            . '/project-specific/sql/'
            . 'selection-managers-file.txt';
        
        #echo "\$selection_managers_filename: $selection_managers_filename\n";
        
        $this->selection_managers = array();
        
        if (file_exists($selection_managers_filename)) {
            $this->selection_managers_file = new Database_SelectionManagersFile(
                $selection_managers_filename
            );
        } else {
            #echo "No selection manager file in this project!\n";
        }
    }
    
    public static function
        get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Database_SelectionManagerFactory();
        }
        
        return self::$instance;
    }
    
    public function
        get_selection_manager($table_name)
    {
        #print_r($this->selection_managers);
        
        if (!isset($this->selection_managers[$table_name])) {
            #print_r($this->selection_managers_file);
            
            $mysql_user_factory = Database_MySQLUserFactory::get_instance();
            $mysql_user = $mysql_user_factory->get_for_this_project();
            $database = $mysql_user->get_database();
            
            $table = $database->get_table($table_name);
            
            if (
                isset($this->selection_managers_file)
                &&
                $this->selection_managers_file->has_selection_manager($table_name)
            ) {
                $selection_manager_filename
                    = $this->selection_managers_file
                            ->get_selection_manager_filename($table_name);
                
                #echo "\$selection_manager_filename: $selection_manager_filename\n";
                
                $selection_manager_file
                    = new FileSystem_PHPClassFile(
                        $selection_manager_filename
                    );
                
                $selection_manager_file->declare_class();
                
                $selection_manager_reflection_class
                    = new ReflectionClass(
                        $selection_manager_file->get_php_class_name()
                    );
                    
                $this->selection_managers[$table_name]
                    = $selection_manager_reflection_class->newInstance($table);
            } else {
                #echo "Using default selection manager for $table_name\n";
                
                $this->selection_managers[$table_name]
                    = $this->default_selection_manager_reflection_class
                        ->newInstance($table);
            }
        }
        
        return $this->selection_managers[$table_name];
    }
}
?>
