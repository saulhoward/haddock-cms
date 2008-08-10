<?php
/**
 * If there's a file called 'head.script.inc.php' in the admin-includes
 * folder for the requested admin-includer page, it is rendered.
 *
 * @copyright Clear Line Web Design, 2007-09-04
 */

$gvm = Caching_GlobalVarManager::get_instance();

$apd = $gvm->get('current-admin-page-directory');

//echo 'print_r($apd): ' . "\n";
//print_r($apd);

if ($apd->has_file('head.script.inc.php')) {
	$apd->render_inc_file('head.script');
}
?>
