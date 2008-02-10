<?php
/**
 * The div that contains all the code for submitting an email
 * to the mailing list.
 *
 * @copyright Clear Line Web Design, 2007-07-13
 */

$page_manager = PublicHTML_PageManager::get_instance();

//echo 'print_r($_GET)' . "\n";
//print_r($_GET);
//echo '$_SESSION[\'name\']: ' . $_SESSION['name'] . "\n";
//echo '$_SESSION[\'email\']: ' . $_SESSION['email'] . "\n";

?>
<div
    id="email_adding"
>
<?php
if (isset($_GET['person_added'])) {
    $page_manager->render_inc_file(
        'body.div.thank-you',
        'plug-ins',
        'mailing-list',
        'sign-up'
    );
} else {
    if (isset($_GET['form_incomplete'])) {
        $page_manager->render_inc_file(
            'body.p.name-and-email',
            'plug-ins',
            'mailing-list',
            'sign-up'
        );
    }
    
    if (isset($_GET['name_too_long'])) {
        $page_manager->render_inc_file(
            'body.p.name-too-long',
            'plug-ins',
            'mailing-list',
            'sign-up'
        );
    }
    
    if (isset($_GET['email_too_long'])) {
        $page_manager->render_inc_file(
            'body.p.email-too-long',
            'plug-ins',
            'mailing-list',
            'sign-up'
        );
    }
    
    if (isset($_GET['email_incorrect'])) {
        $page_manager->render_inc_file(
            'body.p.email-not-correct',
            'plug-ins',
            'mailing-list',
            'sign-up'
        );
    }
    
    $page_manager->render_inc_file(
        'body.form.add-email',
        'plug-ins',
        'mailing-list',
        'sign-up'
    );
}
?>
</div>
