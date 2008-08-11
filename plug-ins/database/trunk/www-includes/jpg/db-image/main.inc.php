<?php
/**
 * Main code for the "db-image" page.
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();

$image = $gvm->get('image');

echo $image->get_image();
?>

