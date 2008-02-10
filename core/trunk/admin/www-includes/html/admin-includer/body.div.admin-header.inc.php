<?php
/**
 * The header panel of the Admin Section of
 * a Haddock Project.
 *
 * @copyright Clear Line Web Design, 2006-11-20
 */

$page_manager = PublicHTML_PageManager::get_instance();

?>
<div id="header">
<?php
$page_manager->render_inc_file('body.div.admin-header.title');
#$page_manager->render_inc_file('body.div.admin-header.tabs');
$page_manager->render_inc_file('body.div.admin-header.log-in-state');
$page_manager->render_inc_file('body.div.admin-header.navigation-link');
?>
</div>
