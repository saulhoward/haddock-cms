<?php
/**
 *For rendering text pages
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/define-include-paths.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/define-debug-constants.inc.php';

header('Content-Type: text/rtf');

 $inc_file =
        PROJECT_ROOT
        . '/project-specific/public-includes/pages/'
        . $_GET['page']
        . '/rtf-file.inc.php';
        
require $inc_file;
?>
