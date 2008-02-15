<?php
/**
 * The page that tells other computers what this machine
 * is doing right now.
 *
 * e.g.
 * If the dump script is running when this page is requested,
 * a download script on a backup machine should wait a bit and
 * then ask again.
 *
 * This is also where scripts tell the database that it's starting
 * or stopping.
 *
 * @copyright Clear Line Web Design, 2007-03-28
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_LocalControlCentre.inc.php';

/*
 * Start doing stuff.
 */

echo "# Task Status\n";

$control_centre = new ServerAdminScripts_LocalControlCentre();

if (isset($_GET['start'])) {
    /*
     * To start a task.
     */
    echo "# Starting\n";
    
    if (!isset($_GET['task'])) {
        throw new Exception('No task set!');
    }
    
    if (!isset($_GET['system'])) {
        throw new Exception('No system set!');
    }
    
    if (!isset($_GET['host'])) {
        throw new Exception('No host set!');
    }
    
    echo 'Task: ' . $_GET['task'] . "\n";
    echo 'System: ' . $_GET['system'] . "\n";
    echo 'Host: ' . $_GET['host'] . "\n";
    
    $task_event_id = $control_centre->start(
        $_GET['task'],
        $_GET['system'],
        $_GET['host']
    );
    
    echo "Task Event ID: $task_event_id\n";
} elseif (isset($_GET['finish'])) {
    /*
     * To finish a task.
     */
    echo "# Finishing ...\n";
    
    if (!isset($_GET['task_event_id'])) {
        throw new Exception('No task event ID set!');
    }
    
    echo 'Task Event ID: ' . $_GET['task_event_id'] . "\n";
    
    $finish_datetime = $control_centre->finish($_GET['task_event_id']);
    
    echo "Finished: $finish_datetime\n";
} else {
    /*
     * List the currently running tasks.
     */
    echo "# Current Tasks:\n";
    echo "# task_event_id, host, system, task, start\n";
    $current_task_events = $control_centre->get_current_task_events();
    
    foreach ($current_task_events as $current_task_event) {
        #print_r($current_task_event);
        #echo 'get_class($current_task_event): ';
        #echo get_class($current_task_event);
        #echo "\n";
        #
        #$table = $current_task_event->get_table();
        #echo 'get_class($table): ';
        #echo get_class($table);
        #echo "\n";
        
        echo $current_task_event->get('ps_task_events.id');
        echo ',';
        echo $current_task_event->get('ps_hosts.name');
        echo ',';
        echo $current_task_event->get('ps_systems.name');
        echo ',';
        echo $current_task_event->get('ps_tasks.name');
        echo ',';
        echo $current_task_event->get('ps_task_events.start');
        
        echo "\n";
    }
}
?>
