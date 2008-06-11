<?php
/**
 * The log-in div.
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */

/*
 * Create singleton objects.
 */
$log_in_manager = Shop_LogInManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();

/*
 * Create the HTML tags objects.
 */
$log_in_to_account_div = new HTMLTags_Div();
$log_in_to_account_div->set_attribute_str('id', 'log_in_to_account_div');

if ($log_in_manager->is_logged_in()) {
	// Change Account
	$log_in_to_account_div->append_str_to_content(
		$page_manager->get_inc_file_as_string('body.p.log-out')
	);
	
	//$log_in_to_account_div->append_str_to_content(
	//	$page_manager->get_inc_file_as_string('body.a.log-out')
	//);
} else {
    /*
     * Tell the customer about any log in errors.
     */
    if (isset($_GET['error_message'])) {
        $log_in_to_account_div->append_tag_to_content(
            new HTMLTags_LastActionBoxDiv(
                $message = stripslashes(urldecode($_GET['error_message'])),
                $no_script_href = '',
                $status = 'error'
            )
        );
    }
    
	/*
     * Log into the customer's account.
     */	
    $form_location
        = PublicHTML_PublicURLFactory
            ::get_url(
                'plug-ins',
                'shop',
                'log-in',
                'html'
            );
            
    $redirect_script_location
        = PublicHTML_PublicURLFactory
            ::get_url(
                'plug-ins',
                'shop',
                'log-in',
                'redirect-script'
            );
            
    $desired_location
        = PublicHTML_PublicURLFactory
            ::get_url(
                'plug-ins',
                'shop',
                'products',
                'html'
            );
    
    $cancel_page_location
        = PublicHTML_PublicURLFactory
            ::get_url(
                'plug-ins',
                'shop',
                'products',
                'html'
            );
    
    //$login_form_div = $log_in_manager->get_login_form_div();
    
    $login_form_div = new HTMLTags_Div();
	$login_form_div->set_attribute_str('class', 'cmx-form');

    $login_form_div->append_tag_to_content(
        $log_in_manager->get_log_in_form(
            $form_location,
            $redirect_script_location,
            $desired_location,
            $cancel_page_location
        )
    );
    
	$log_in_to_account_div->append_tag_to_content($login_form_div);
}

echo $log_in_to_account_div->get_as_string();
?>
