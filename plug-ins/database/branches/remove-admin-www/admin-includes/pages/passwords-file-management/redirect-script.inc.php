<?php
/**
 * The Password File Management Redirect Script.
 *
 * This is where
 * 
 *  - the host
 *  - the username
 *  - the database
 *  - the password
 *
 * that are used by this project are saved to file.
 *
 * @copyright Clear Line Web Design, 2007-01-26
 */

/*
 * -----------------------------------------------------------------------------
 */

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

/*
 * -----------------------------------------------------------------------------
 */

/*
 * Define the necessary classes.
 */
$return_to = '/admin/database/passwords-file-management.html';

if (
    isset($_POST['host'])
    && isset($_POST['username'])
    && isset($_POST['database'])
    && isset($_POST['password'])
) {
    $project_directory_finder
        = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
    
    $project_directory
        = $project_directory_finder->get_project_directory_for_this_project();
    
    $project_specific_directory
        = $project_directory->get_project_specific_directory();
    
    $password_file = $project_specific_directory->get_passwords_file();
    
    $password_file->set_host($_POST['host']);
    $password_file->set_username($_POST['username']);
    $password_file->set_database($_POST['database']);
    $password_file->set_password($_POST['password']);
    
    $password_file->commit();
}
?>
