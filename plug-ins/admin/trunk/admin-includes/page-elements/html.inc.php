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
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php

require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_IncFileFinder.inc.php';

$inc_file_finder = Admin_IncFileFinder::get_instance();

require $inc_file_finder->get_filename('head');
require $inc_file_finder->get_filename('body');

?>
</html>
<?php
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
