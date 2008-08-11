<?php
/**
 * The HTML body of an admin page.
 *
 * @copyright Clear Line Web Design, 2007-08-22
 */

$page_manager = PublicHTML_PageManager::get_instance();

echo "<body>\n";

$page_manager->render_inc_file('body.div.admin-header');
    
$page_manager->render_inc_file('body.div.admin-content');

$page_manager->render_inc_file('body.div.admin-navigation');

$page_manager->render_inc_file('body.div.admin-footer');

echo "</body>\n";
  
?>
