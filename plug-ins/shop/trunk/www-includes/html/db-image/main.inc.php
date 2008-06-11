<?php
/**
 * The main section of the db-image page for the shop plug-in.
 *
 * @copyright Clear Line Web Design, 2007-07-25
 */

$global_var_manager = Caching_GlobalVarManager::get_instance();
$image = $global_var_manager->get('image');

echo $image->get_image();
?>
