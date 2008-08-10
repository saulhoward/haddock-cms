<?php
/**
 * The header panel of the navigation page of the Admin Section of
 * a Haddock Project.
 *
 * @copyright Clear Line Web Design, 2007-08-22
 */

$page_manager = PublicHTML_PageManager::get_instance();

?>
<div
    id="header"
>
    <h1>Admin Navigation</h1>
<?php
$page_manager->render_inc_file('body.div.admin-header.log-in-state');
?>
</div>
