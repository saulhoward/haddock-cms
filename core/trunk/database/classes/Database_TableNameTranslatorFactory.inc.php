<?php
/**
 * Database_TableNameTranslatorFactory
 *
 * @copyright Clear Line Web Design, 2006-11-16
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_TableNameTranslator.inc.php';

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ModuleDirectory.inc.php';

/**
 * Produces Database_TableNameTranslator objects for a given table name.
 *
 * A Database_TableNameTranslatorFactory is associated with a
 * CLWDProjects_CLWDSVNWorkingDirectory object.
 * The Database_TableNameTranslatorFactory will check to see if
 * there is a file in the module's "sql" directory called
 *
 * "database-class-name-overrides.txt"
 *
 * that lists table names with weird/irregular table and row class names.
 * If the requested table name is in this list, then a
 * Database_TableNameTranslator with the relevant information
 * is returned.
 * Otherwise, the Database_TableNameTranslator will return table and
 * row subclass names algorithmically.
 *
 * e.g.
 *
 * The "guestbook" CLWD core module has a table called
 * "comments" and there is no override file for this module.
 *
 * The Database_TableNameTranslator object that will be
 * returned will give the row class name "Guestbook_CommentRow".
 *
 * e.g.
 *
 * 
 */
class Database_TableNameTranslatorFactory
{
    private $clwd_svn_working_directory;
    
    private $database_class_name_overrides;
    
    public function __construct(
        CLWDProjects_CLWDSVNWorkingDirectory $clwd_svn_working_directory
    )
    {
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "Just entered: Database_TableNameTranslatorFactory::__construct(...)\n";
            echo "\$clwd_svn_working_directory:\n";
            echo $clwd_svn_working_directory;
            echo "\n";
            
            $execution_timer = CLWDProjects_ExecutionTimer::get_instance();
            $execution_timer->mark();
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        $this->clwd_svn_working_directory = $clwd_svn_working_directory;
    }
    
    public function get_clwd_svn_working_directory()
    {
        return $this->clwd_svn_working_directory;
    }
    
    private function get_database_class_name_overrides()
    {
        if (!isset($this->database_class_name_overrides)) {
            $this->database_class_name_overrides = array();
            
            $clwd_project_directory = $this->get_clwd_project_directory();
            
            # Are there any database class name override files
            # in any of the CLWD core modules of this project.
            $clwd_core_module_directories = $clwd_project_directory->get_clwd_core_module_directories();
            
            foreach ($clwd_core_module_directories as $clwd_core_module_directory) {
                $c_c_m_d_d_c_n_o_f = $clwd_core_module_directory->get_database_class_name_override_file();
                $c_c_m_d_d_c_n_os = $c_c_m_d_d_c_n_o_f->get_database_class_name_overrides();
                foreach ($c_c_m_d_d_c_n_os as $override) {
                    $this->database_class_name_overrides[$override->get_table_name()] = $override;
                }
            }
            
            # Is there a database class name override file
            # in the project specific directory.
            $project_specific_directory = $clwd_project_directory->get_project_specific_directory();
            $p_s_d_d_c_n_o_f = $project_specific_directory->get_database_class_name_override_file();
            $p_s_d_d_c_n_os = $p_s_d_d_c_n_o_f->get_database_class_name_overrides();
            foreach ($p_s_d_d_c_n_os as $override) {
                $this->database_class_name_overrides[$override->get_table_name()] = $override;
            }
        }
        
        return $this->database_class_name_overrides;
    }
    
    public function get_table_name_translator($table_name)
    {
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "Just entered: Database_TableNameTranslatorFactory::get_table_name_translator(...)\n";
            echo "\$table_name: $table_name\n";
            
            $execution_timer = CLWDProjects_ExecutionTimer::get_instance();
            $execution_timer->mark();
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        $table_name_translator = null;
        
        $database_class_name_overrides = $this->get_database_class_name_overrides();
        
        if (isset($database_class_name_overrides[$table_name])) {
            if (DEBUG) {
                echo DEBUG_DELIM_OPEN;
                
                echo "In: Database_TableNameTranslatorFactory::get_table_name_translator(...)\n";
                $execution_timer->mark();
                
                echo "Found a database class name override in this module for \"$table_name\".\n";
                
                echo DEBUG_DELIM_CLOSE;
            }
            
            $table_name_translator = $database_class_name_overrides[$table_name];
        } else {
            # An override hasn't been found, so we'll use the algorithm.
            if (DEBUG) {
                echo DEBUG_DELIM_OPEN;
                
                echo "In: Database_TableNameTranslatorFactory::get_table_name_translator(...)\n";
                $execution_timer->mark();
                
                echo "No database class name override found in this module for \"$table_name\".\n";
                
                echo "Creating a new Database_TableNameTranslator object.\n";
                
                echo DEBUG_DELIM_CLOSE;
            }
            
            $clwd_svn_working_directory = $this->get_clwd_svn_working_directory();
            $table_name_translator = new Database_TableNameTranslator($clwd_svn_working_directory, $table_name);
        }
        
        if (DEBUG) {
            echo DEBUG_DELIM_OPEN;
            
            echo "About to return from: Database_TableNameTranslatorFactory::get_table_name_translator(...)\n";
            $execution_timer->mark();
            
            echo "\$table_name_translator:\n";
            #print_r($table_name_translator);
            echo $table_name_translator;
            echo "\n";
            
            echo DEBUG_DELIM_CLOSE;
        }
        
        return $table_name_translator;
    }
}

?>