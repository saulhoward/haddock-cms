<?php
/**
 * For rendering JS pages
 *
 * Refactor this out of existence when you get the chance,
 * like the public index.php file.
 *
 * @copyright Clear Line Web Design, 2007-05-02
 */

require_once $_SERVER['DOCUMENT_ROOT']
    . '/haddock/public-html/public-html/define-include-paths.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']
    . '/haddock/public-html/public-html/define-debug-constants.inc.php';

header('Content-Type: application/x-javascript');

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

require $inc_file_finder->get_filename('js-file');

?>
