<?php
/**
 * The redirect-script for the __autoload .INC file
 * page in the admin section of HPO.
 *
 * @copyright Clear Line Web Design, 2007-05-11
 */

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

if (isset($_GET['refresh'])) {
    $project_directory_finder
        = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
    
    $project_directory
        = $project_directory_finder->get_project_directory_for_this_project();
        
    $project_specific_directory = $project_directory->get_project_specific_directory();
    
    $autoload_inc_file
        = $project_specific_directory->get_autoload_inc_file();
        
    $autoload_inc_file->refresh();
}
?>
