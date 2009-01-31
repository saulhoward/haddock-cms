<?php
/**
 * A script to add, update and delete
 * rows in a database table.
 *
 * RFI & SANH 2006-09-21
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/define-globals.inc.php';

#print_r($_GET);
#print_r($_POST);

$host = $_SERVER['HTTP_HOST'];
rtrim($host, '/');

$url = "http://$host";

# Users who link to this page can override the return to.
# E.g. the shop admin pages want to return to the shop
# adming section.
if (isset($_GET['return_to'])) {
    $return_to = $_GET['return_to'];
} else {    
    $return_to = '/database/';
}

try {
    if (!isset($_GET['table'])) {
        throw new Exception('No table set!');
    }
    
    # Declare classes
    require_once CLWD_CORE_ROOT . '/database/MySQLUserFactory.inc.php';
    
    # Make a table object to access the table.
    $mysql_user_factory = MySQLUserFactory::get_instance();
    $mysql_user = $mysql_user_factory->get_for_this_server();
    $database = $mysql_user->get_database();
    
    $table = $database->get_table($_GET['table']);
    
    # Remember, this can be overridden!
    if (!isset($_GET['return_to'])) {
        $return_to .= 'tables/' . $table->get_name() . '.html';
    }
    
    # Delete the project from the database.
    if (isset($_GET['delete_id']) or isset($_GET['delete_all'])) {
        if (isset($_GET['delete_id'])) {
            $table->delete_by_id($_GET['delete_id']);
        }
        
        if (isset($_GET['delete_all'])) {
            $table->delete_all();
        }
    } else {
        $fields = $table->get_fields();
        
        $values = array();
        
        #print_r($_POST);
        
        foreach ($fields as $field) {
            #echo $field->get_name();
            
            if (isset($_POST[$field->get_name()])) {
                $values[$field->get_name()] = $_POST[$field->get_name()];
            }
        }
        
        #print_r($values);
        
        # Add a new row to the table.
        if (isset($_GET['add_new_row'])) {
            $id = $table->add($values);
        }
        
        # Update a project in the database.
        if (isset($_GET['edit_id'])) {
            $table->update_by_id($_GET['edit_id'], $values);
        }
    }
} catch (Exception $e) {
    $return_to = '/database/index.php?page=error'
        . '&error_message=' . urlencode($e->getMessage())
        . "&return_to=$return_to";
}

$url .= $return_to;

#echo "$url\n";
header("Location: $url");
?>
