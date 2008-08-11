<?php
/**
 * The commands that are carried out by the redirect script
 * for the "sign-in-as-root" page in the database admin section.
 *
 * @copyright Clear Line Web Design, 2007-01-28
 */

session_start();

$return_to = '/admin/database/sign-in-as-root.html';

if (isset($_POST['password'])) {
    $_SESSION['mysql-root-password'] = $_POST['password'];
    
    #print_r($_SESSION);
}

if (isset($_GET['sign_out'])) {
    unset($_SESSION['mysql-root-password']);
    
    $return_to = '/admin/database/home.html';    
}
?>
