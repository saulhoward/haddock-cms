<?php
/**
 * The log in redirect script for the shop.
 *
 * @copyright Clear Line Web Design, 2007-07-06
 */

#require_once PROJECT_ROOT
#    . '/plug-ins/shop/classes/'
#    . 'Shop_LogInManager.inc.php';

#echo "\$_SESSION['log-in-manager']\n";
#print_r($_SESSION['log-in-manager']);
#print_r($_SESSION);

#session_start();

$log_in_manager = Shop_LogInManager::get_instance();

#echo "\$_POST\n";
#print_r($_POST);

#echo "\$_SESSION['log-in-manager']\n";
#print_r($_SESSION['log-in-manager']);

#echo "Logging in\n";

if (isset($_GET['log_in'])) {
    try {
        $log_in_manager->log_in(
            $_POST['login_name'],
            $_POST['password']
        );
        
	if (isset($_GET['return_to'])) 
	{
		$return_to = '/' . $_GET['return_to'] . '.html';
	}
	else
	{
		$return_to = '/';
	}
        #echo $return_to;
    } catch (Shop_LogInException $e) {
        $return_to = '/?page=log-in&error_message=' . urlencode($e->getMessage());
    }

}

if (isset($_GET['log_out'])) {
	unset($_SESSION['log-in-manager']);
        $return_to = '/';
}
?>
