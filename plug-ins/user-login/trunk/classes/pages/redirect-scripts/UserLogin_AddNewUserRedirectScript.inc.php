<?php
/**
 * UserLogin_AddNewUserRedirectScript
 *
 * @copyright 2009-06-13, Saul Howard
 */


class
UserLogin_AddNewUserRedirectScript
extends
UserLogin_RedirectScript                                                                                                          
{

    protected function
        do_actions() 
    {
        $return_url = $this->get_failed_manage_user_return_url();

        /*
         * Create the singleton objects.
         */
        $svm = Caching_SessionVarManager::get_instance();
        $login_manager = UserLogin_LoginManager::get_instance();

        /*
         * ----------------------------------------
         * Perform the actions.
         * ----------------------------------------
         */
        $_POST['type'] = 'User'; // faking this for now, might be useful later

        if (
            isset($_GET['add-new-user'])
        ) {
            /*
             * Set the session vars for the form.
             */
            $svm->set('manage-users-form: name', $_POST['name']);
            // $svm->set('manage-users-form: type', $_POST['type']);
            $svm->set('manage-users-form: real_name', $_POST['real_name']);
            $svm->set('manage-users-form: email', $_POST['email']);

            try {
                /*
                 * Preliminary checks that the values are valid.
                 */
                if (
                    (
                        isset($_GET['add-new-user'])
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
                ) {
                    // if (
                        // !isset($_POST['type'])
                        // ||
                        // (strlen($_POST['type']) == 0)
                    // ) {
                        // throw new InputValidation_InvalidInputException(
                            // 'The type for the user must be set!'
                        // );
                    // }

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

                $return_url = $this->get_successful_manage_user_return_url();

                $exception_on_not_set = FALSE;

                $svm->delete('manage-users-form: name', $exception_on_not_set);
                $svm->delete('manage-users-form: email', $exception_on_not_set);
                $svm->delete('manage-users-form: type', $exception_on_not_set);
                $svm->delete('manage-users-form: real_name', $exception_on_not_set);
            } catch (InputValidation_InvalidInputException $e) {
                if (isset($_GET['add-new-user'])) {
                    $return_url = $this->get_failed_add_user_return_url();
                }
                $return_url->set_get_variable(
                    'error_message',
                    urlencode($e->getMessage())
                );
            }
        }
        $this->set_return_to_url($return_url);
    }

    private function     
        get_failed_add_user_return_url()     
    {
        return UserLogin_URLHelper::get_registration_page_url();     
    }

    private function     
        get_failed_edit_user_return_url($user_id)     
    {
        return UserLogin_URLHelper::get_account_page_url();     
    }

    private function     
        get_failed_manage_user_return_url()     
    {
        return UserLogin_URLHelper::get_registration_page_url();     
    }

    private function     
        get_successful_manage_user_return_url()     
    {
        return UserLogin_URLHelper::get_account_page_url();     
    }
}       
?> 
