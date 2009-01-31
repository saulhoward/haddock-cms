<?php
/**
 * A script to add images to the database.
 *
 * RFI & SANH 2006-09-23
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/define-globals.inc.php';

$host = $_SERVER['HTTP_HOST'];
rtrim($host, '/');

$url = "http://$host";

if (isset($_GET['return_to'])) {
    $return_to = $_GET['return_to'];
} else {    
    $return_to = '/admin/database/home.html';
}

try {
    if (isset($_FILES['user_file']) and isset($_GET['table_name'])) {
        $size = getimagesize($_FILES['user_file']['tmp_name'][0]);
        
        $values['file_type'] = $size['mime'];
        
        #$values['image'] = addslashes(file_get_contents($_FILES['user_file']['tmp_name'][0]));
        $values['image'] = file_get_contents($_FILES['user_file']['tmp_name'][0]);
        
        # Declare classes
        require_once CLWD_CORE_ROOT . '/database/classes/Database_MySQLUserFactory.inc.php';
        
        # Make a table object to access the table.
        $mysql_user_factory = MySQLUserFactory::get_instance();
        $mysql_user = $mysql_user_factory->get_for_this_server();
        $database = $mysql_user->get_database();
        
        $images_table = $database->get_table($_GET['table_name']);
        
        #print_r($images_table);
        
        if (!isset($_GET['return_to'])) {
            $return_to .= 'tables/' . $images_table->get_name() . '.html';
        }
        
        $images_table->add($values);
    }
} catch (Exception $e) {
    $return_to = '/database/index.php?page=error'
        . '&error_message=' . urlencode($e->getMessage())
        . "&return_to=$return_to";
}

if (isset($_GET['return_to'])) {
    $return_to = $_GET['return_to'];
}

$url .= $return_to;

#echo "$url\n";
header("Location: $url");
?>
