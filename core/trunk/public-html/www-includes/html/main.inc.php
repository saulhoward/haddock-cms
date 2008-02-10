<?php
/**
 * All the HTML page.
 *
 * @copyright Clear Line Web Design, 2006-11-17
 */

$page_manager = PublicHTML_PageManager::get_instance();

$page_manager->render_inc_file('pre-html');
$page_manager->render_inc_file('html');
$page_manager->render_inc_file('post-html');
?>
