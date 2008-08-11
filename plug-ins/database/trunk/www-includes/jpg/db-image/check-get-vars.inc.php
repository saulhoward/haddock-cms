<?php
/**
 * Check the image ID has been set.
 *
 * @copyright Clear Line Web Design, 2007-07-25
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();

if (isset($_GET['image_id'])) {
    $gvm->set('image_id', $_GET['image_id']);
} else {
    throw new Exception('The image ID must be set with image_id!');
}

?>
