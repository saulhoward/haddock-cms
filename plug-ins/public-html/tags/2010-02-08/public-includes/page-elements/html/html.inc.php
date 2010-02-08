<?php
/**
 * The default HTML page for a haddock project.
 *
 * @copyright Clear Line Web Design, 2007-07-17
 */

$page_manager = PublicHTML_PageManager::get_instance();

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php
$page_manager->render_inc_file('head');
$page_manager->render_inc_file('body');
?>
</html>
