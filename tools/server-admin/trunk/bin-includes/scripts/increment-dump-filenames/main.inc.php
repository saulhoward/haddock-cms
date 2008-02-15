<?php
/**
 * The dump filename incrementing script.
 *
 * @copyright Clear Line Web Design, 2007-02-08
 */

require_once PROJECT_ROOT
    . '/project-specific/classes/'
    . 'ServerAdminScripts_DumpDirectory.inc.php';

$directory
    = new ServerAdminScripts_DumpDirectory($directory_name);

#print_r($directory);

$directory->shift_names_up();

$directory->delete_all_but_youngest($max_copies);
?>
