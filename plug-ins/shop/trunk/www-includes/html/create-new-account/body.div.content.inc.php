<?php
/**
 * Content of the page where customers create accounts for
 * the shop plug-in.
 *
 * @copyright Clear Line Web Design, 2007-09-23
 */

/*
 * Create the singleton objects.
 */
$log_in_manager = Shop_LogInManager::get_instance();

/*
 * Create the HTML tags objects.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * The title of the page.
 */
$content_div->append_tag_to_content(
    new HTMLTags_Heading(2, 'Create New Account')
);

/*
 * Error messages.
 */
if (isset($_GET['error_message'])) {
    $content_div->append_tag_to_content(
        new HTMLTags_LastActionBoxDiv(
            $message = stripslashes(urldecode($_GET['error_message'])),
            $no_script_href = '',
            $status = 'error'
        )
    );
}

/*
 * The form for creating an account.
 */
$form_location
    = PublicHTML_PublicURLFactory
        ::get_url(
            'plug-ins',
            'shop',
            'create-new-account',
            'html'
        );
        
$redirect_script_location
    = PublicHTML_PublicURLFactory
        ::get_url(
            'plug-ins',
            'shop',
            'create-new-account',
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

$create_new_account_form_div = new HTMLTags_Div();
$create_new_account_form_div->set_attribute_str('class', 'cmx-form');

$create_new_account_form = $log_in_manager->get_create_new_account_form(
    $form_location,
    $redirect_script_location,
    $desired_location,
    $cancel_page_location
);

$create_new_account_form->set_attribute_str('class', 'cmxform');

$create_new_account_form_div->append_tag_to_content(
    $create_new_account_form
);

$content_div->append_tag_to_content(
    $create_new_account_form_div
);

/*
 * Print everything.
 */
echo $content_div->get_as_string();
?>
