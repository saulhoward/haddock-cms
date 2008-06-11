<?php
/**
 * The log-in redirect script for the shop.
 *
 * @copyright Clear Line Web Design, 2007-07-06
 */

//echo "Foo!\n";
//exit;

/*
 * Create the singleton variables.
 */
$svm = Caching_SessionVarManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();
$log_in_manager = Shop_LogInManager::get_instance();

/*
 * If the user wants to log-in.
 */
if (isset($_GET['log_in'])) {
    //echo "Foo!\n";
    //exit;
    
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
    
    //echo "Foo!\n";
    //exit;
    
    /*
     * Set the session vars.
     */
    if (isset($_POST['email'])) {
        $svm->set('log-in: email', $_POST['email']);
    }
    
    try {
//	throw
//            new InputValidation_InvalidInputException(
//                'Debug error message.'
//            );
	
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
                    'Please enter your email address.'
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
	
	/*
         * Log in.
         */
        $log_in_manager->log_in($_POST['email'], $_POST['password']);
        
	/*
	 * Delete any session variables that were set during
	 * any attempts to fill in the form.
	 */
        $exception_on_not_set = FALSE;
	
        $svm->delete('log-in: email', $exception_on_not_set);
	$svm->set('customer_shipping_details_confirmed', FALSE);
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

	$shopping_baskets_table->convert_shopping_baskets_for_current_session_to_new_customer($user->get_id());

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
    } catch (HaddockProjectOrganisation_LoginException $e) {
	/*
         * If there's been a log-in error,
         * go back to the form.
         */
        $form_location->set_get_variable('error_message', $e->getMessage());
        
        $page_manager->set_return_to_url($form_location);
    }
}

/*
 * If the user wants to log out.
 */
if (isset($_GET['log_out'])) {
    $log_in_manager->log_out();
}

/*
 * If the user wants to clear the log-in form.
 */
if (isset($_GET['cancel'])) {
    /*
     * Delete any session variables that were set during
     * any attempts to fill in the form.
     */
    $exception_on_not_set = FALSE;
    
    $svm->delete('log-in: email', $exception_on_not_set);
    
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
