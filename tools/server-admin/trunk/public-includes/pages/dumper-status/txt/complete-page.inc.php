<?php
/**
 * The page that tells other computers what this machine
 * is doing right now.
 *
 * If the dump script is running when this page is requested,
 * a download script on a backup machine should wait a bit and
 * then ask again.
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
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_LocalControlCentre.inc.php';

/*
 * Start doing stuff.
 */

echo "# dumper status\n";

$project_directory_factory
    = HaddockProjectOrganisation_ProjectDirectoryFinder
        ::get_instance();
$project_directory =
    $project_directory_factory->get_project_directory_for_this_project();

$control_centre = new ServerAdminScripts_LocalControlCentre();

/*
 * To start a dump.
 */
if (isset($_GET['start'])) {
    echo "# Starting ...\n";
    
    $task_event_id = $control_centre->start(
        'dumping',
        'mysql',
        $project_directory->get_current_host_name()
    );
    
    echo "Task Event ID: $task_event_id\n";
}

/*
 * To finish a dump.
 */
if (isset($_GET['finish'])) {
    echo "# Finishing\n";
    
    $finish_datetime = $control_centre->finish($task_id);
}
?>
