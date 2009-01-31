<?php
/**
 * Database_DatabaseClassNameOverride
 *
 * RFI & SANH 2006-11-16
 */

#if (DEBUG) {
#    echo DEBUG_DELIM_OPEN;
#
#    require_once CLWD_CORE_ROOT . '/formatting/classes/Formatting_FileName.inc.php';
#    require_once CLWD_CORE_ROOT . '/clwd-projects/classes/CLWDProjects_ExecutionTimer.inc.php';
#    
#    $file = new Formatting_FileName(__FILE__);
#    echo "Entering \n";
#    echo $file->get_pretty_name();
#    echo "\n";
#    
#    $execution_timer = CLWDProjects_ExecutionTimer::get_instance();
#    $execution_timer->mark();
#    
#    echo DEBUG_DELIM_CLOSE;
#}
#
#/**
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT . '/haddock/database/classes/Database_TableNameTranslator.inc.php';
#
#if (DEBUG) {
#    echo DEBUG_DELIM_OPEN;
#    
#    echo "Defining: Database_DatabaseClassNameOverride\n";
#    
#    $execution_timer->mark();
#    
#    echo DEBUG_DELIM_CLOSE;
#}

class Database_DatabaseClassNameOverride extends Database_TableNameTranslator
{
    public function __contruct(
        $clwd_svn_working_directory,
        $table_name,
        $row_class_name,
        $table_class_name
    )
    {
        # Put the module name at the front.
        $module_name .= $clwd_svn_working_directory->get_module_name();
        
        $this->row_class_name = $module_name . '_' . $row_class_name;
        $this->table_class_name = $module_name . '_' . $table_class_name;
        
        parent::__contruct($clwd_svn_working_directory, $table_name);
    }
}

#if (DEBUG) {
#    echo DEBUG_DELIM_OPEN;
#    
#    echo "Finished defining: Database_DatabaseClassNameOverride\n";
#    
#    $execution_timer->mark();
#    
#    echo DEBUG_DELIM_CLOSE;
#}
?>
