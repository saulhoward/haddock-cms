<?php
/**
 *For rendering text pages
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/define-include-paths.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/define-debug-constants.inc.php';

header('Content-Type: text/plain');

require_once PROJECT_ROOT
    . '/haddock/admin/classes/'
    . 'Admin_IncFileFinder.inc.php';

$inc_file_finder = Admin_IncFileFinder::get_instance();

/*
 * Define which module is being asked for.
 */
define('MODULE', isset($_GET['module']) ? $_GET['module'] : 'admin');

/*
 * Define which page we are on.
 */
define('PAGE', isset($_GET['page']) ? $_GET['page'] : 'home');

require $inc_file_finder->get_filename('text-file');

?>
