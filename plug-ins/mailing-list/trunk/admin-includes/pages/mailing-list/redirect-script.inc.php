<?php
/**
 * The redirect script for the mailing_list admin page.
 *
 * @copyright Clear Line Web Design, 2007-03-12
 */

#echo 'print_r($_GET): ' . "\n";
#print_r($_GET);
#echo 'print_r($_POST): ' . "\n";
#print_r($_POST);
##echo 'print_r($_SESSION): ' . "\n";
##print_r($_SESSION);
#echo 'print_r($_FILES): ' . "\n";
#print_r($_FILES);

/*
 * Create the database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$people_table = $database->get_table('hpi_mailing_list_people');

/*
 * Set the default return to page.
 */
$return_to = '/admin/?module=mailing-list&page=mailing-list';

    /*
     * Add or update the web_videos table (and tags and tag links and images.)
     */
    if (
        isset($_GET['add_person'])
        ||
        isset($_GET['edit_id'])
    ) {

                if (isset($_GET['add_person'])) {
        
                        $ip = $_SERVER['REMOTE_ADDR'];            
                        #print_r($_POST);
                    
                        $last_added_id = $people_table->add_person(
                        $_POST['name'],
                        $_POST['email'],
                        $_POST['status']
                    );
                    
                    $return_to .= '&last_added_id=' . $last_added_id;
                    }
                
                if (isset($_GET['edit_id'])) {
                    $people_table->edit_person(
                        $_GET['edit_id'],
                        $_POST['name'],
                        $_POST['email'],
                        $_POST['status']
                    );
                    $return_to .= '&last_edited_id=' . $_GET['edit_id'];
                }
              
    }
    
    if (isset($_GET['delete_id'])) {
        $people_table->delete_person($_GET['delete_id']);
        
        $return_to .= '&last_deleted_id=' . $_GET['delete_id'];
    }

#echo "\$return_to: $return_to\n";
#exit;
?>
