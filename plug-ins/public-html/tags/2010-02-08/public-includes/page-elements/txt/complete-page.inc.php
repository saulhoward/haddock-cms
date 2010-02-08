<?php
/**
 * Calls in the main .INC file to be rendered as .TXT.
 *
 * @copyright Clear Line Web Design, 2007-04-04
 */

require_once PROJECT_ROOT
    . '/haddock/public-html/classes/'
    . 'PublicHTML_PageManager.inc.php';
    
$page_manager = PublicHTML_PageManager::get_instance();

require $page_manager->get_filename('main');
?>
