<?php
/**
 * The Product Page!
 * 
 * RFI & SANH 2007-03-02
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_P.inc.php';
    
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$comments_table = $database->get_table('hpi_shop_comments');

if (isset($_GET['add_comment'])) {
    
    if ($_POST['name'] != '' && $_POST['email'] != '' && $_POST['comment'] != '')
    {
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
        
        $form_notification = new HTMLTags_P('Thank you for your comment.<br />Comments can take up to 24 hours to appear in the shop.');
        echo $form_notification->get_as_string();
    }
    else {
        $form_notification = new HTMLTags_P('Please complete name, email and comment');
        echo $form_notification->get_as_string();
    }
}

?>
