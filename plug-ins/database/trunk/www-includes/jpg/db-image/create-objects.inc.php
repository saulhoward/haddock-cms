<?php
/**
 * Create the database objects that are needed to render the image.
 *
 * @copyright Clear Line Web Design, 2007-09-18
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();
$mysql_user_factory = Database_MySQLUserFactory::get_instance();

/*
 * Create the database objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$images_table = $database->get_table('hc_database_images');

$image = $images_table->get_row_by_id($gvm->get('image_id'));

$gvm->set('image', $image);
?>