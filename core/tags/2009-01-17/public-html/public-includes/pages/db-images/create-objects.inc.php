<?php
/**
 * Create any objects that are used to render an
 * image from the database here.
 *
 * @copyright Clear Line Web Design, 2007-04-04
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$images_table = $database->get_table('hc_database_images');

$image = $images_table->get_row_by_id($_GET['id']);

#print_r($image);
?>
