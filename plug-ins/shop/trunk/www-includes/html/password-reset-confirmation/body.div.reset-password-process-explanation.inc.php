<?php
/**
 * A div where the password resetting process is explained.
 *
 * @copyright Clear Line Web Design, 2007-09-24
 */

$password_reset_explanation = <<<TXT
If you have created an account at this shop before
but have forgotten your password, please enter your
email into the form above and hit the reset button.

A new random password will be emailed to you immediately.
TXT;

$ps = HTMLTags_BLSeparatedPFactory
    ::get_ps_from_str($password_reset_explanation);
    
$reset_password_process_explanation_div = new HTMLTags_Div();
$reset_password_process_explanation_div->set_attribute_str(
    'id',
    'reset_password_process_explanation'
);

foreach ($ps as $p) {
    $reset_password_process_explanation_div->append_tag_to_content($p);
}

echo $reset_password_process_explanation_div->get_as_string();
?>
