<?php
/**
 * The main file for assemble-autoload-file
 *
 * @copyright Clear Line Web Design, 2007-07-06
 */

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();
    
//$project_specific_directory = $project_directory->get_project_specific_directory();
//
//$autoload_inc_file
//    = $project_specific_directory->get_autoload_inc_file();
//    
////echo 'print_r($autoload_inc_file)' . "\n";
////print_r($autoload_inc_file);
//
//$autoload_inc_file->refresh();

$project_directory->refresh_autoload_file();
?>