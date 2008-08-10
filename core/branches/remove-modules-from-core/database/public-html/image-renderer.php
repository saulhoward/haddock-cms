<?php
/**
 * Gets binary data from the db and turns it into
 * a image file.
 *
 * Thanks to
 *  http://www.phpriot.com/d/articles/database/images-in-mysql/
 *
 * RFI 2006-09-10
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/define-include-paths.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/define-debug-constants.inc.php';

if (DEBUG) {
    header('Content-Type: text/plain');
    
    echo DEBUG_DELIM_OPEN;
    
    require_once CLWD_CORE_ROOT . '/formatting/classes/Formatting_FileName.inc.php';
    require_once CLWD_CORE_ROOT . '/clwd-projects/classes/CLWDProjects_ExecutionTimer.inc.php';
    
    $file = new Formatting_FileName(__FILE__);
    echo "Just entered:\n";
    echo $file->get_pretty_name();
    echo "\n";
    
    $execution_timer = CLWDProjects_ExecutionTimer::get_instance();
    $execution_timer->mark();
    
    echo DEBUG_DELIM_CLOSE;
}

require_once CLWD_CORE_ROOT . '/database/classes/Database_MySQLUserFactory.inc.php';

#print_r($_GET);

if (isset($_GET['table_name']) && isset($_GET['id'])) {
    $mysql_user_factory = Database_MySQLUserFactory::get_instance();
    $mysql_user = $mysql_user_factory->get_for_this_project();
    $database = $mysql_user->get_database();

    $images_table = $database->get_table($_GET['table_name']);
    
    $image = $images_table->get_row_by_id($_GET['id']);
    
    if (DEBUG) {
        echo DEBUG_DELIM_OPEN;
        
        $file = new Formatting_FileName(__FILE__);
        echo "In:\n";
        echo $file->get_pretty_name();
        echo "\n";
        
        echo "print_r(\$image):\n";
        print_r($image);
        echo "\n";
        
        $execution_timer->mark();
        
        echo DEBUG_DELIM_CLOSE;
    }
    
    header("Content-type: " . $image->get_file_type());
    
    echo $image->get_image();
} else {
    $uri = '/database/index.php?page=error'
        . '&error_message=' . urlencode('table_name and id must be set!')
        . "&return_to=/database/";

    $host = $_SERVER['HTTP_HOST'];
    rtrim($host, '/');
    $url = "http://$host$uri";

    header("Location: $url");
}
?>
