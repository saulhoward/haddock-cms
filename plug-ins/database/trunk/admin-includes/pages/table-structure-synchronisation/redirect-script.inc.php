<?php
/**
 * The commands for the redirect script for
 * synchronising table structure and specification
 * files.
 *
 * @copyright Clear Line Web Design, 2007-02-01
 */

# TO DO:
# Will this ever work?
# Isn't the CLI version always going to be good enough?

throw new Exception(
    'The redirect script for table structure synchronisation has been disabled! '
    . 'Use the CLI version of this script instead.'
);

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

$table_structure_manager
    = $project_directory->get_table_structure_manager();
    
if (isset($_GET['sync_files_with_db'])) {
    $table_structure_manager->synchronise_files_with_database();
}

if (isset($_GET['sync_db_with_files'])) {
    $table_structure_manager->synchronise_database_with_files();
}
?>
