<?php
/**
 * The main section of the redirect-script for creating a new account
 * for a customer in the shop plug-in.
 *
 * @copyright Clear Line Web Design, 2007-09-23
 */

#echo '__FILE__: ' . "\n";
#echo __FILE__ . "\n";
#exit;

/*
 * Create the singleton objects.
 */
$svm = Caching_SessionVarManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();
$log_in_manager = Shop_LogInManager::get_instance();

/*
 * If the user wants to create an account.
 */
if (isset($_GET['create_new_account'])) {
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
        $svm->set('create-new-account: email', $_POST['email']);
    }
    
    if (isset($_POST['confirm_email'])) {
        $svm->set('create-new-account: confirm_email', $_POST['confirm_email']);
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
        
        if (
            !isset($_POST['confirm_email'])
            ||
            (strlen($_POST['confirm_email']) == 0)
        ) {
            throw
                new InputValidation_InvalidInputException(
                    'Please confirm your email address.'
                );
        }
        
        if ($_POST['email'] != $_POST['confirm_email']) {
            throw
                new InputValidation_InvalidInputException(
                    'The email addresses don\'t match.'
                );
        }
        
        if (
            !isset($_POST['password'])
            ||
            (strlen($_POST['password']) == 0)
        ) {
            throw
                new InputValidation_InvalidInputException(
                    'Please enter a password.'
                );
        }
        
        if (
            !isset($_POST['confirm_password'])
            ||
            (strlen($_POST['confirm_password']) == 0)
        ) {
            throw
                new InputValidation_InvalidInputException(
                    'Please confirm your password.'
                );
        }
        
        if ($_POST['password'] != $_POST['confirm_password']) {
            throw
                new InputValidation_InvalidInputException(
                    'The passwords don\'t match.'
                );
        }
        
        /*
         * Update the database.
         */
        $log_in_manager->add_new_user($_POST['email'], $_POST['password']);
        
        /*
         * Log in.
         */
        $log_in_manager->log_in($_POST['email'], $_POST['password']);
        
	/*
	 * Make sure shopping baskets are correct (move this to LogInManager?)
	 */
	$user = $log_in_manager->get_user();
	if ($user->get_customer_region_id() != 0)
	{
		$_SESSION['customer_region_id'] = $user->get_customer_region_id();
	}

	$mysql_user_factory = Database_MySQLUserFactory::get_instance();
	$mysql_user = $mysql_user_factory->get_for_this_project();
	$database = $mysql_user->get_database();
	$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
    
    $user_id = $user->get_id();
    #echo "\$user_id: $user_id\n";exit;
	$shopping_baskets_table
        ->convert_shopping_baskets_for_current_session_to_new_customer($user_id);
    #echo __FILE__ . "\n" . __LINE__ . "\n"; exit;
    
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

        /*
     	 * Delete any session variables that were set during
     	 * any attempts to fill in the form.
     	 */
    	$exception_on_not_set = FALSE;

    	$svm->delete('create-new-account: email', $exception_on_not_set);
    	$svm->delete('create-new-account: confirm_email', $exception_on_not_set);
    } catch (InputValidation_InvalidInputException $e) {
        #print_r($e);
        #exit;
        /*
         * If there's been an input error,
         * go back to the form.
         */
        $form_location->set_get_variable('error_message', $e->getMessage());
        
        $page_manager->set_return_to_url($form_location);
    }
    
    #exit;
}

/*
 * If the user wants to wipe the slate.
 */
if (isset($_GET['cancel'])) {
    /*
     * Delete any session variables that were set during
     * any attempts to fill in the form.
     */
    $exception_on_not_set = FALSE;
    
    $svm->delete('create-new-account: email', $exception_on_not_set);
    $svm->delete('create-new-account: confirm_email', $exception_on_not_set);
    
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
