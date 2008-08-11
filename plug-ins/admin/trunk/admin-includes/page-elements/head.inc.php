<?php
if (DEBUG) {
    echo DEBUG_DELIM_OPEN;
    
    require_once CLWD_CORE_ROOT . '/clwd-projects/classes/CLWDProjects_ExecutionTimer.inc.php';
    require_once CLWD_CORE_ROOT . '/formatting/classes/Formatting_FileName.inc.php';
    
    $file = new Formatting_FileName(__FILE__);
    echo "Entering:\n";
    echo $file->get_pretty_name();
    echo "\n";
    
    $execution_timer = CLWDProjects_ExecutionTimer::get_instance();
    $execution_timer->mark();
    
    echo DEBUG_DELIM_CLOSE;
}

echo "<head>\n";

require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_IncFileFinder.inc.php';

$inc_file_finder = Admin_IncFileFinder::get_instance();

require $inc_file_finder->get_filename('head.title');
require $inc_file_finder->get_filename('head.styles');
require $inc_file_finder->get_filename('head.script');
require $inc_file_finder->get_filename('head.written-by');

echo "</head>\n";

if (DEBUG) {
    echo DEBUG_DELIM_OPEN;
    
    $file = new Formatting_FileName(__FILE__);
    echo "Reached the end of:\n";
    echo $file->get_pretty_name();
    echo "\n";
    
    $execution_timer->mark();
    
    echo DEBUG_DELIM_CLOSE;
}
?>
