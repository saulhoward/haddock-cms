<?php
/**
 * The Login page of the Shop hpi.
 * 
 * @copyright Clear Line Web Design, 2006-09-27
 */

/*
 * Create singleton objects.
 */
$log_in_manager = Shop_LogInManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();

/*
 * CONTENT DIV
 */ 
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Show The Header
 */
$content_div->append_str_to_content(
    $page_manager->get_inc_file_as_string('body.h2.main-page-header')
);

/*
 * Already Logged in?
 */
if ($log_in_manager->is_logged_in()) {
	$content_div->append_str_to_content(
        $page_manager->get_inc_file_as_string('body.div.already-logged-in')
    );
}

/*
 * Going through the Checkout process?
 */
if (isset($_GET['return_to'])) {
	if ($_GET['return_to'] == 'payment-options') {
		$content_div->append_str_to_content(
            $page_manager
                ->get_inc_file_as_string('body.div.checkout-process')
        );
	}
}

/*
 * Log into existing account (if already logged in - change account)
 */
$content_div->append_str_to_content(
    $page_manager->get_inc_file_as_string('body.div.log-in')
);

if ($log_in_manager->is_logged_in()) {
    /*
     * The log-out div.
     */
    $content_div->append_str_to_content(
        $page_manager->get_inc_file_as_string('body.a.log-out')
    );
} else {
    /*
     * Create new account (go to customer-details.html)
     */
    $content_div->append_str_to_content(
        $page_manager->get_inc_file_as_string('body.div.create-new-customer')
    );
    
    /*
     * Link for customers who have forgotten their password.
     */
    $content_div->append_str_to_content(
        $page_manager->get_inc_file_as_string('body.a.password-reset')
    );
    
    /*
     * Blurb at bottom
     */
   $content_div->append_str_to_content(
       $page_manager->get_inc_file_as_string('body.p.have-a-nice-day')
   );
}

echo $content_div->get_as_string();
?>
