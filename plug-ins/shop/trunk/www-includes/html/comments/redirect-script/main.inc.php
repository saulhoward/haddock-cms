<?php
/**
 * The redirect-script for the comments table.
 * 
 * @copyright Clear Line Web Design, 2007-08-03
 */

$page_manager = PublicHTML_PageManager::get_instance();

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$comments_table = $database->get_table('hpi_shop_comments');

if (isset($_GET['add_comment'])) {
    $return_to_url = $page_manager->get_return_to_url();
    
    if ($_POST['name'] != '' && $_POST['email'] != '' && $_POST['comment'] != '') {
        $ip = $_SERVER['REMOTE_ADDR'];
        
        $last_added_id = $comments_table->add_comment(
            $_POST['name'],
            $ip,
            $_POST['email'],
            $_POST['url'],
            $_POST['homepage_title'],
            $_POST['comment'],
            $_POST['product_id']
        );
        
        #$return_to .= '&last_added_id=' . $last_added_id;
        $return_to_url->set_get_variable('last_added_id', $last_added_id);
    }
    else {
        #$return_to .= '&form_incomplete=1';
        $return_to_url->set_get_variable('form_incomplete');
    }
}
?>
