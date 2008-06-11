<?php
/**
 * Instructions for resetting a password.
 *
 * @copyright Clear Line Web Design, 2007-09-24
 */

/*
 * Create the singleton objects.
 */
$svm = Caching_SessionVarManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();
$log_in_manager = Shop_LogInManager::get_instance();

/*
 * Reset the password.
 */
if (isset($_GET['password_reset'])) {
    /*
     * Check that we know where to go if something has gone
     * wrong.
     */
    $form_location = new HTMLTags_URL();
    
    if (isset($_GET['form_location'])) {
        $form_location->parse_url($_GET['form_location']);
    } elseif (isset($_SERVER['HTTP_REFERER'])) {
        $form_location->parse_url($_SERVER['HTTP_REFERER']);
    } else {
        throw new Exception('Unable to set the form URL!');
    }
    
    /*
     * Set the session vars.
     */
    if (isset($_POST['email'])) {
        $svm->set('password-reset: email', $_POST['email']);
    }
    
    try {
        //throw
        //    new InputValidation_InvalidInputException(
        //        'Debug error message.'
        //    );
            
        /*
         * Preliminary checks of the user's input.
         */
        if (
            !isset($_POST['email'])
            ||
            (strlen($_POST['email']) == 0)
        ) {
            throw
                new InputValidation_InvalidInputException(
                    'Please set your email address.'
                );
        }
        
        /*
         * Reset the password.
         */
        $log_in_manager->reset_password($_POST['email']);
        
        /*
         * If the customer is logged in and the email address that has
         * just been reset is the same as the email address of the customer
         * who is currently logged in, then the customer should be logged
         * out.
         */
        if ($log_in_manager->is_logged_in()) {
            if ($log_in_manager->get_name() == $_POST['email']) {
                $log_in_manager->log_out();
            }
        }
        
        /*
         * Delete any session variables that were set during
         * any attempts to fill in the form.
         */
        $exception_on_not_set = FALSE;
        
        $svm->delete('password-reset: email', $exception_on_not_set);
        
        /*
         * Set the return location after successfully adding to the database.
         */
       $return_to_url = new HTMLTags_URL();
       
       if (isset($_GET['desired_location'])) {
           $return_to_url->set_url(
               urldecode($_GET['desired_location'])
           );
       } else {
           $return_to_url->set_file('/');
       }
       
       $page_manager->set_return_to_url($return_to_url);
    } catch (InputValidation_InvalidInputException $e) {
        /*
         * If there's been an input error,
         * go back to the form.
         */
        $form_location->set_get_variable('error_message', $e->getMessage());
        
        $page_manager->set_return_to_url($form_location);
    } catch (HaddockProjectOrganisation_PasswordResetException $e) {
        /*
         * If there's been pasword reset error,
         * go back to the form.
         */
        $form_location->set_get_variable('error_message', $e->getMessage());
        
        $page_manager->set_return_to_url($form_location);
    }
}

/*
 * Clear the form.
 */
if (isset($_GET['cancel'])) {
    /*
     * Delete any session variables that were set during
     * any attempts to fill in the form.
     */
    $exception_on_not_set = FALSE;
    
    $svm->delete('password-reset: email', $exception_on_not_set);
    
    /*
     * Set the return to location.
     */
    $return_to_url = new HTMLTags_URL();
    
    if (isset($_GET['cancel_page_location'])) {
        $return_to_url->set_url(
            urldecode($_GET['cancel_page_location'])
        );
    } else {
        $return_to_url->set_file('/');
    }
    
    $page_manager->set_return_to_url($return_to_url);
}
?>
