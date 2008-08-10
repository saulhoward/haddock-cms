<?php
/**
 * The Admin Section for a haddock Project
 *
 * @copyright Clear Line Web Design, 2006-11-20
 */

/*
 * Define constants that are used throughout
 * the project.
 */
#require_once $_SERVER['DOCUMENT_ROOT'] . '/define-include-paths.inc.php';
#require_once $_SERVER['DOCUMENT_ROOT'] . '/define-debug-constants.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/haddock/public-html/public-html/define-include-paths.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/haddock/public-html/public-html/define-debug-constants.inc.php';

/*
 * Does this project have an __autoload function?
 */
$autoload_filename = PROJECT_ROOT
    . '/project-specific/haddock-project-organisation/'
    . 'autoload.inc.php';
    
if (file_exists($autoload_filename)) {
    require_once $autoload_filename;
}

/*
 * Define which module is being asked for.
 */
define('MODULE', isset($_GET['module']) ? $_GET['module'] : 'admin');

/*
 * Define which page we are on.
 */
define('PAGE', isset($_GET['page']) ? $_GET['page'] : 'home');

if (DEBUG) {
    header('Content-Type: text/plain');
    
    echo DEBUG_DELIM_OPEN;
    
    require_once PROJECT_ROOT
        . '/haddock/code-analysis/classes/'
        . 'CodeAnalysis_ExecutionTimer.inc.php';
        
    require_once PROJECT_ROOT
        . '/haddock/formatting/classes/'
        . 'Formatting_FileName.inc.php';
    
    echo "Running in DEBUG mode...\n";
    
    $execution_timer = CodeAnalysis_ExecutionTimer::get_instance();
    
    $file = new Formatting_FileName(__FILE__);
    echo "In:\n";
    echo $file->get_pretty_name();
    echo "\n";
    
    echo 'print_r($_GET)' . "\n";
    print_r($_GET);
    echo "\n";

    echo 'print_r($_POST)' . "\n";
    print_r($_POST);
    echo "\n";

    echo 'print_r($_SERVER)' . "\n";
    print_r($_SERVER);
    echo "\n";
    
    echo 'print_r($_FILES)' . "\n";
    print_r($_FILES);
    echo "\n";
    
    echo 'MODULE: ' . MODULE . "\n\n";
    
    echo 'PAGE: ' . PAGE . "\n\n";
    
    echo DEBUG_DELIM_CLOSE;
}

require_once PROJECT_ROOT
    . '/haddock/admin/classes/'
    . 'Admin_IncFileFinder.inc.php';

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

$inc_file_finder = Admin_IncFileFinder::get_instance();

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

/*
 * Does this project have an __autoload function?
 */
$project_directory->define_autoload_inc_file();

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

if (DEBUG) {
    echo DEBUG_DELIM_OPEN;
    
    echo "\$http_error: $http_error\n";
    
    $execution_timer->mark();
    
    echo DEBUG_DELIM_CLOSE;
}

/*
 * Run any pre-display code.
 */
require $inc_file_finder->get_filename('pre-display');

/*
 * Print out the HTML.
 */
require $inc_file_finder->get_filename('html');

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
