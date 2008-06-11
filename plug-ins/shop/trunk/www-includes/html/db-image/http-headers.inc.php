<?php
/**
 * The HTTP header directives for the db-image page for the shop
 * plug-in.
 *
 * @copyright Clear Line Web Design, 2007-07-25
 */

/*
 * Get the image we made earlier.
 */
$global_var_manager = Caching_GlobalVarManager::get_instance();
$image = $global_var_manager->get('image');

header("Content-type: " . $image->get_file_type());
?>
