<?php
/**
 * Content of the page where the customer can confirm that
 * they want to reset their password.
 *
 * @copyright Clear Line Web Design, 2007-09-24
 */

/*
 * Create the singleton objects.
 */
$log_in_manager = Shop_LogInManager::get_instance();
$page_manager =  PublicHTML_PageManager::get_instance();

/*
 * Create the HTML tags objects.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Append the heading.
 */
$content_div->append_str_to_content(
    $page_manager->get_inc_file_as_string(
        'body.h2.reset-password'
    )
);

/*
 * Decide on the locations of the various scripts
 * and pages.
 */
$form_location
    = PublicHTML_PublicURLFactory
        ::get_url(
            'plug-ins',
            'shop',
            'password-reset-confirmation',
            'html'
        );
        
$redirect_script_location
    = PublicHTML_PublicURLFactory
        ::get_url(
            'plug-ins',
            'shop',
            'password-reset-confirmation',
            'redirect-script'
        );
        
$desired_location
    = PublicHTML_PublicURLFactory
        ::get_url(
            'plug-ins',
            'shop',
            'log-in',
            'html'
        );

$cancel_page_location
    = PublicHTML_PublicURLFactory
        ::get_url(
            'plug-ins',
            'shop',
            'home',
            'html'
        );

/*
 * Append the form.
 */
$reset_password_form_div = new HTMLTags_Div();
#$login_form_div->set_attribute_str('class', 'cmx-form');

if (isset($_GET['error_message'])) {
    $reset_password_form_div->append_tag_to_content(
        new HTMLTags_LastActionBoxDiv(
            $message = stripslashes(urldecode($_GET['error_message'])),
            $no_script_href = '',
            $status = 'error'
        )
    );
}

$reset_password_form_div->append_tag_to_content(
    $log_in_manager->get_password_reset_form(
        $form_location,
        $redirect_script_location,
        $desired_location,
        $cancel_page_location
    )
);

$content_div->append_tag_to_content($reset_password_form_div);

/*
 * Tell the user about the password reset process.
 */
$content_div->append_str_to_content(
    $page_manager->get_inc_file_as_string(
        'body.div.reset-password-process-explanation'
    )
);


/*
 * Print everything.
 */
echo $content_div->get_as_string();
?>
