<?php
/**
 * Gets binary data from the db and turns it into
 * a image file.
 *
 * Thanks to
 *  http://www.phpriot.com/d/articles/database/images-in-mysql/
 *
 * @copyright Clear Line Web Design, 2006-09-10
 */

/**
 * Define constants that are used throughout
 * the project.
 */
#require_once $_SERVER['DOCUMENT_ROOT'] . '/define-include-paths.inc.php';
#require_once $_SERVER['DOCUMENT_ROOT'] . '/define-debug-constants.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/haddock/public-html/public-html/define-include-paths.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/haddock/public-html/public-html/define-debug-constants.inc.php';

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

#print_r($_GET);

if (isset($_GET['id'])) {
    $mysql_user_factory = Database_MySQLUserFactory::get_instance();
    $mysql_user = $mysql_user_factory->get_for_this_project();
    $database = $mysql_user->get_database();

    $images_table = $database->get_table('images');
    
    $image = $images_table->get_row_by_id($_GET['id']);
    
    #print_r($image);
    
    header("Content-type: " . $image->get_file_type());
    
    echo $image->get_image();
} else {
    $uri = '/?page=error'
        . '&error_message=' . urlencode('The id must be set!');

    $host = $_SERVER['HTTP_HOST'];
    rtrim($host, '/');
    $url = "http://$host$uri";

    header("Location: $url");
}
?>
