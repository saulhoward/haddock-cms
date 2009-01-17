<?php
/**
 * The log in state for an admin page for a haddock project.
 *
 * @copyright Clear Line Web Design, 2006-08-23
 */

$page_manager = PublicHTML_PageManager::get_instance();

?>
<div id="log-in-state"> 
<?php
$page_manager->render_inc_file('body.p.admin-header.logged-in-as');
$page_manager->render_inc_file('body.p.admin-header.log-out');
?>
</div>
