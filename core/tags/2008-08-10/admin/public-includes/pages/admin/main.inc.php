<?php
/**
 * The main section of any admin page of any type.
 *
 * @copyright Clear Line Web Design, 2007-080-07
 */

//header('Content-type: text/plain');
//echo 'print_r($_GET)' . "\n";
//print_r($_GET);
//exit;

/*
 * Define which module is being asked for.
 */
#define('MODULE', isset($_GET['module']) ? $_GET['module'] : 'admin');
define('MODULE', isset($_GET['admin-module']) ? $_GET['admin-module'] : 'admin');

/*
 * Define which page we are on.
 */
define('PAGE', isset($_GET['admin-page']) ? $_GET['admin-page'] : 'home');

$inc_file_finder = Admin_IncFileFinder::get_instance();

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

/*
 * Does this project have an __autoload function?
 */
#$project_directory->define_autoload_inc_file();

$current_module_directory
    = $project_directory->get_module_directory(MODULE);

$current_admin_includes_directory = null;

if ($current_module_directory->has_admin_includes_directory()) {
    $current_admin_includes_directory
        = $current_module_directory->get_admin_includes_directory();
}

#$current_module_config_file = null;

#if ($current_module_directory->has_module_config_file()) {
#    $current_module_config_file = $current_module_directory->get_module_config_file();
#}

if (isset($current_admin_includes_directory)) {
    if (
        $current_admin_includes_directory->has_page_directory(PAGE)
        &&
        PAGE != 'home'
    ) {
        $current_admin_page_directory
            = $current_admin_includes_directory->get_page_directory(PAGE);
    }
}

/*
 * Session code.
 */
require $inc_file_finder->get_filename('session-objects');
require $inc_file_finder->get_filename('sessions');

$http_error = 0;

if (!$inc_file_finder->is_page(PAGE)) {
    header('HTTP/1.1 404 Not found');
    $http_error = 404;
}

/*
 * Run any pre-display code.
 */
require $inc_file_finder->get_filename('pre-display');

/*
 * Print out the HTML.
 */
require $inc_file_finder->get_filename('html');

?>
