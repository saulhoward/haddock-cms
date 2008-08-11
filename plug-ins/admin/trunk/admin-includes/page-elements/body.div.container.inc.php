<?php
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

require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_IncFileFinder.inc.php';

$inc_file_finder = Admin_IncFileFinder::get_instance();
?>
<div id="container">
<?php
require $inc_file_finder->get_filename('body.div.header');
require $inc_file_finder->get_filename('body.div.wrapper');
require $inc_file_finder->get_filename('body.div.navigation');
require $inc_file_finder->get_filename('body.div.footer');
?>

    <div id="clear-footer">
    </div>
</div>
<?php
if (DEBUG) {
    echo DEBUG_DELIM_OPEN;
    
    $file = new Formatting_FileName(__FILE__);
    echo "Reached the end of \n";
    echo $file->get_pretty_name();
    echo "\n";
    
    $execution_timer->mark();
    
    echo DEBUG_DELIM_CLOSE;
}
?>
