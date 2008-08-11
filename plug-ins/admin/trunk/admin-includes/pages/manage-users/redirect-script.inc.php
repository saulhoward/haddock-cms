<?php
/**
 * Redirect script for the "manage-users" admin page.
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

//header('Content-Type: text/plain');
//echo 'print_r($_GET)' . "\n";
//print_r($_GET);
//echo 'print_r($_POST)' . "\n";
//print_r($_POST);
//echo 'print_r($_SESSION)' . "\n";
//print_r($_SESSION);

/*
 * Create the singleton objects.
 */
$svm = Caching_SessionVarManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();
$login_manager = Admin_LoginManager::get_instance();

/*
 * ----------------------------------------
 * Perform the actions.
 * ----------------------------------------
 */

if (
    isset($_GET['add-new-user'])
    ||
    isset($_GET['edit-user'])
    ||
    isset($_GET['change-password'])
) {
    /*
     * Set the session vars for the form.
     */
    $svm->set('manage-users-form: name', $_POST['name']);
    $svm->set('manage-users-form: type', $_POST['type']);
    $svm->set('manage-users-form: real_name', $_POST['real_name']);
    $svm->set('manage-users-form: email', $_POST['email']);
    
    try {
        /*
         * Preliminary checks that the values are valid.
         */
        if (
            (
                isset($_GET['edit-user'])
                ||
                isset($_GET['change-password'])
            )
            &&
            (
                !isset($_GET['user_id'])
                ||
                ($_GET['user_id'] < 1)
            )
        ) {
            throw new InputValidation_InvalidInputException(
                'The user\'s ID must be set!'
            );
        }
        
        if (
            (
                isset($_GET['add-new-user'])
                ||
                isset($_GET['edit-user'])
            )
            &&
            (
                !isset($_POST['name'])
                ||
                (strlen($_POST['name']) == 0)
            )
        ) {
            throw new InputValidation_InvalidInputException(
                'The name for the user must be set!'
            );
        }
        
        if (
            isset($_GET['add-new-user'])
            ||
            isset($_GET['change-password'])
        ) {
            if (
                !isset($_POST['password'])
                ||
                (strlen($_POST['password']) == 0)
            ) {
                throw new InputValidation_InvalidInputException(
                    'The password for the user must be set!'
                );
            }
    
            if (
                !isset($_POST['confirm_password'])
                ||
                (strlen($_POST['confirm_password']) == 0)
            ) {
                throw new InputValidation_InvalidInputException(
                    'Please confirm the password for the user.'
                );
            }
    
            if (($_POST['password'] != $_POST['confirm_password'])) {
                throw new InputValidation_InvalidInputException(
                    'The passwords do not match!'
                );
            }
        }
        
        if (
            isset($_GET['add-new-user'])
            ||
            isset($_GET['edit-user'])
        ) {
            if (
                !isset($_POST['type'])
                ||
                (strlen($_POST['type']) == 0)
            ) {
                throw new InputValidation_InvalidInputException(
                    'The type for the user must be set!'
                );
            }
    
            if (
                !isset($_POST['real_name'])
                ||
                (strlen($_POST['real_name']) == 0)
            ) {
                throw new InputValidation_InvalidInputException(
                    'The real name of the user must be set!'
                );
            }
    
            if (
                !isset($_POST['email'])
                ||
                (strlen($_POST['email']) == 0)
            ) {
                throw new InputValidation_InvalidInputException(
                    'The email address of the user must be set!'
                );
            }
        }
        
        /*
         * Update the tables.
         */
        if (isset($_GET['add-new-user'])) {
            $login_manager->add_new_user(
                $_POST['name'],
                $_POST['password'],
                $_POST['type'],
                $_POST['real_name'],
                $_POST['email']
            );
        }
        
        if (isset($_GET['edit-user'])) {
            $login_manager->update_user(
                $_GET['user_id'],
                $_POST['name'],
                $_POST['type'],
                $_POST['real_name'],
                $_POST['email']
            );
        }
        
        if (isset($_GET['change-password'])) {
            $login_manager->update_password(
                $_GET['user_id'],
                $_POST['password']
            );            
        }
        
        $exception_on_not_set = FALSE;
        
        $svm->delete('manage-users-form: name', $exception_on_not_set);
        $svm->delete('manage-users-form: email', $exception_on_not_set);
        $svm->delete('manage-users-form: type', $exception_on_not_set);
        $svm->delete('manage-users-form: real_name', $exception_on_not_set);
    } catch (InputValidation_InvalidInputException $e) {
        if (isset($_GET['add-new-user'])) {
            $admin_page = 'add-new-user';
        }
        
        if (isset($_GET['edit-user'])) {
            $admin_page = 'edit-user';
        }
        
        $return_to_url = Admin_AdminIncluderURLFactory
	    ::get_url(
		'haddock',
		'admin',
		$admin_page,
		'html'
	    );
        
        $return_to_url->set_get_variable(
            'error_message',
            urlencode($e->getMessage())
        );
        
        if (isset($_GET['edit-user'])) {
            $return_to_url->set_get_variable(
                'user_id',
                $_GET['user_id']
            );
        }
        
        $page_manager->set_return_to_url($return_to_url);
    }
}

if (isset($_GET['cancel'])) {
    $exception_on_not_set = FALSE;
    
    $svm->delete('manage-users-form: name', $exception_on_not_set);
    $svm->delete('manage-users-form: email', $exception_on_not_set);
    $svm->delete('manage-users-form: type', $exception_on_not_set);
    $svm->delete('manage-users-form: real_name', $exception_on_not_set);
    
    $return_to_url = Admin_AdminIncluderURLFactory
        ::get_url(
            'haddock',
            'admin',
            'manage-users',
            'html'
        );
    
    $page_manager->set_return_to_url($return_to_url);
}
?>

