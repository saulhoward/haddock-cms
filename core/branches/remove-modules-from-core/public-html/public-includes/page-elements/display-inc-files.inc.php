<?php
/**
 * The .INC files that display stuff.
 *
 * @copyright Clear Line Web Design, 2007-07-30
 */

$page_manager = PublicHTML_PageManager::get_instance();

$page_manager->render_inc_file('pre-main');
$page_manager->render_inc_file('main');
$page_manager->render_inc_file('post-main');
?>
