<?php
/**
 * Calls in any pre-display code for an admin-includer page.
 *
 * @copyright Clear Line Web Design, 2007-08-23
 */

$gvm = Caching_GlobalVarManager::get_instance();

$apd = $gvm->get('current-admin-page-directory');

if ($apd->has_inc_file('pre-html')) {
    $apd->render_inc_file('pre-html');
}

?>
