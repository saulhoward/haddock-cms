<?php
/**
 * Database_DatabaseClassNameOverrideFile
 *
 * RFI & SANH 2006-11-13
 */

if (DEBUG) {
    echo DEBUG_DELIM_OPEN;
    
    require_once CLWD_CORE_ROOT . '/formatting/classes/Formatting_FileName.inc.php';
    require_once CLWD_CORE_ROOT . '/clwd-projects/classes/CLWDProjects_ExecutionTimer.inc.php';
    
    $file = new Formatting_FileName(__FILE__);
    echo "Entering \n";
    echo $file->get_pretty_name();
    echo "\n";
    
    $execution_timer = CLWDProjects_ExecutionTimer::get_instance();
    $execution_timer->mark();
    
    echo DEBUG_DELIM_CLOSE;
}

/**
 * Define the necessary classes.
 */
require_once PROJECT_ROOT . '/haddock/file-system/classes/FileSystem_DataFile.inc.php';

require_once PROJECT_ROOT . '/haddock/database/classes/Database_DatabaseClassNameOverride.inc.php';

if (DEBUG) {
    echo DEBUG_DELIM_OPEN;
    
    echo "Defining: Database_DatabaseClassNameOverrideFile\n";
    
    $execution_timer->mark();
    
    echo DEBUG_DELIM_CLOSE;
}

/**
 * Represents a file containing instructions
 * for overriding table name translations to PHP
 * class names.
 * e.g.
 *
 * user_data UserDatumRow UserDataTable
 */
class Database_DatabaseClassNameOverrideFile extends FileSystem_DataFile
{
    private $clwd_svn_working_directory;
    
    private $database_class_name_overrides;
    
    public function __construct($name, $clwd_svn_working_directory)
    {
        $this->clwd_svn_working_directory = $clwd_svn_working_directory;
        parent::__construct($name);
    }
    
    public function get_database_class_name_overrides()
    {
        if (!isset($this->database_class_name_overrides)) {
            $this->database_class_name_overrides = array();
            
            foreach ($this->get_data() as $data_line) {
                $this->database_class_name_overrides[] = new Database_DatabaseClassNameOverride($this->clwd_svn_working_directory, $data_line[0], $data_line[1], $data_line[2]);
            }
        }
        
        return $this->database_class_name_overrides;
    }
}

if (DEBUG) {
    echo DEBUG_DELIM_OPEN;
    
    echo "Finished defining: Database_DatabaseClassNameOverrideFile\n";
    
    $execution_timer->mark();
    
    echo DEBUG_DELIM_CLOSE;
}
?>
