<?php
/**
 * Content of the "log-on-details" admin page.
 *
 * @copyright Clear Line Web Design, 2007-10-02
 */

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
$pd = $pdf->get_project_directory_for_this_project();

$paypal_payments_module = $pd->get_plug_in_module_directory('paypal-payments');

if ($paypal_payments_module->has_config_variable('server-name')) {
    $server_name = $paypal_payments_module->get_config_variable('server-name');
    
    $content_div->append_tag_to_content(new HTMLTags_P("Server name: $server_name"));
} else {
    $content_div->append_tag_to_content(new HTMLTags_P('Server name not found!'));
}

if ($paypal_payments_module->has_config_variable('account')) {
    $account = $paypal_payments_module->get_config_variable('account');
    
    $content_div->append_tag_to_content(new HTMLTags_P("Account: $account"));
} else {
    $content_div->append_tag_to_content(new HTMLTags_P('Account not found!'));
}

echo $content_div->get_as_string();

?>

