<?php
/**
 * The main .INC for the add-admin-user script.
 *
 * @copyright Clear Line Web Design, 2007-08-07
 */

$admin_login_manager
    ->add_new_user(
        $name,
        $password,
        $type,
        $real_name,
        $email
    );

if (!$silent) {
    echo "New user added.\n";
}

?>
