<?php
/**
 * Check the image ID has been set.
 *
 * @copyright Clear Line Web Design, 2007-07-25
 */

if (!isset($_GET['image_id'])) {
    throw new Exception('The image ID must be set with image_id!');
}

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$images_table = $database->get_table('hpi_shop_images');

$image = $images_table->get_row_by_id($_GET['image_id']);

$global_var_manager = Caching_GlobalVarManager::get_instance();

$global_var_manager->set('image', $image);

?>
