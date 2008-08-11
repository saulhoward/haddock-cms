<?php
/**
 * Goes of a finds the .INC file for a page in the admin section.
 *
 * @copyright Clear Line Web Design, 2007-08-23
 */

$gvm = Caching_GlobalVarManager::get_instance();

$apd = $gvm->get('current-admin-page-directory');

#echo 'print_r($apd): ' . "\n";
#print_r($apd);
#exit;

$apd->render_inc_file('redirect-script');
?>
