<?php
/**
 * The redirct script for the products page.
 *
 * @copyright Clear Line Web Design, 2007-02-19
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

$mysql_user_factory = Database_MySQLUserFactory::get_instance();

$mysql_user = $mysql_user_factory->get_for_this_project();

$database = $mysql_user->get_database();

$comments_table = $database->get_table('hpi_shop_comments');

#print_r($_GET);

/*
 * Set the default return to page.
 */

$page_manager = PublicHTML_PageManager::get_instance();
$return_to_url = $page_manager->get_return_to_url();

if (isset($_GET['product_id']))
{
	$return_to_url->set_get_variable('product_id', $_GET['product_id']);
}

if (isset($_GET['add_comment'])) {
//        public function
//        add_comment (
//            $name,
//            $ip,
//            $email,
//            $url,
//            $homepage_title,
//            $comment,
//            $product_id,
//            $status = 'new',
//            $front_page = 'no'
//        )
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
        
	$return_to_url->set_get_variable('last_added_id', $last_added_id);
    }
    else {
	$return_to_url->set_get_variable('form_incomplete', '1');
    }
$page_manager->set_return_to_url($return_to_url);
}

?>
