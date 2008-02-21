<?php
/**
 * Content of the "reset-password" admin page.
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();

/*
 * Fetch the database objects.
 */
$user_row = $gvm->get('user-row');
$user_row_renderer = $user_row->get_renderer();

/*
 * Create the reset-password redirect-script URL and the cancel URL.
 */
$rprsb_url = Admin_AdminIncluderURLFactory::get_url('haddock', 'admin', 'reset-password', 'redirect-script');
$rprsb_url->set_get_variable('reset_password');
$rprsb_url->set_get_variable('user_id', $user_row->get_id());

$success_url = Admin_AdminIncluderURLFactory::get_url('haddock', 'admin', 'manage-users', 'html');
$failure_url = Admin_AdminIncluderURLFactory::get_url('haddock', 'admin', 'reset-password', 'html');

$rprsb_url->set_get_variable('success_url', urlencode($success_url->get_as_string()));
$rprsb_url->set_get_variable('failure_url', urlencode($failure_url->get_as_string()));

$cancel_url = Admin_AdminIncluderURLFactory::get_url('haddock', 'admin', 'manage-users', 'html'); 

$confirm_reset_password_p = new HTMLTags_ConfirmationP(
	'Are you sure that you want to reset the password for ' . $user_row->get_real_name() . '?',
	$rprsb_url,
	$cancel_url
);
$confirm_reset_password_p->set_attribute_str('class', 'confirm_p');

$content_div->append_tag_to_content($confirm_reset_password_p);

echo $content_div->get_as_string();

?>

