<?php
/**
 * A small div to go on the side of a page to do with the customers accounts.
 *
 * @copyright Clear Line Web Design, 2007-11-01
 */

/*
 * Create the singleton objects.
 */
$page_manager = PublicHTML_PageManager::get_instance();

$mini_shop_accounts_div = new HTMLTags_Div();
$mini_shop_accounts_div->set_attribute_str('id', 'mini_shop_accounts');

#----------------------------------
# LOG IN CONFIRMATION & FORM
#----------------------------------
$log_in_manager = Shop_LogInManager::get_instance();
$log_in_to_account_div = new HTMLTags_Div();
$log_in_to_account_div->set_attribute_str('class', 'log-in-div');

if ($log_in_manager->is_logged_in())
{
	$log_in_to_account_div->set_attribute_str('id', 'already-logged-in');

//        /* GRAVATAR */
//        $gravatar_email = $log_in_manager->get_name();

//        $gravatar_default = "http://" . $_SERVER['SERVER_NAME'] . "/images/default-avatar.png";
//        $gravatar_size = 80;
//        $gravatar_url = new HTMLTags_URL();
//        $gravatar_url->set_file('http://www.gravatar.com/avatar.php?
//                gravatar_id=' . md5($gravatar_email) .
//                '&amp;default=' . urlencode($gravatar_default) .
//                '&amp;size=' . $gravatar_size);

//        $gravatar_img = new HTMLTags_IMG();
//        $gravatar_img->set_src($gravatar_url);
//        $gravatar_img->set_attribute_str('alt', $log_in_manager->get_name());
//        $gravatar_img->set_attribute_str('class', 'avatar');
//        $log_in_to_account_div->append_tag_to_content($gravatar_img);
//        /* END OF GRAVATAR */

//        /* JUST NORMAL DEFAULT AVATAR */
//        $avatar_url = new HTMLTags_URL();
//        $avatar_url->set_file('/images/default-avatar.png');
//        $avatar_img = new HTMLTags_IMG();
//        $avatar_img->set_src($avatar_url);
//        $avatar_img->set_attribute_str('alt', $log_in_manager->get_name());
//        $avatar_img->set_attribute_str('class', 'avatar');
//        $log_in_to_account_div->append_tag_to_content($avatar_img);
//        /* END OF NORMAL DEFAULT AVATAR */

	$p_text = <<<TXT
You are logged in as&nbsp;
TXT;
	$p_text .=  '<em>' . $log_in_manager->get_name() . '</em>';
	$log_in_to_account_div->append_tag_to_content(new HTMLTags_P($p_text));

	$log_out_link = new HTMLTags_A('Log Out');
	$log_out_link->set_href($log_in_manager->get_log_out_url());
	$log_in_to_account_div->append_tag_to_content($log_out_link);
	$navigation_div->append_tag_to_content($log_in_to_account_div);
}
else
{
	if (
		$page_manager->get_page() != 'checkout' 
		&&
		$page_manager->get_page() != 'log-in' 
		&&
		$page_manager->get_page() != 'create-new-account' 
	)
	{
		
		$log_in_to_account_div->set_attribute_str('id', 'not-logged-in');
		$login_form_div = new HTMLTags_Div();
		$login_form_div->set_attribute_str('class', 'cmx-form');
		$login_form_div->set_attribute_str('id', 'sidebar');
		/*
		 * Tell the customer about any log in errors.
		 */
		if (isset($_GET['error_message'])) {
			$login_form_div->append_tag_to_content(
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
		$current_page_url = new HTMLTags_URL();
		$current_page_url->set_file('/');
		foreach (array_keys($_GET) as $get_key)
		{
			$current_page_url->set_get_variable($get_key, $_GET[$get_key]);
		}

		$form_location = clone $current_page_url;
		$redirect_script_location
			= PublicHTML_PublicURLFactory
			::get_url(
				'plug-ins',
				'shop',
				'log-in',
				'redirect-script'
			);
		$desired_location = clone $current_page_url;
		$cancel_page_location = clone $current_page_url;

		$login_form_div->append_tag_to_content(
			$log_in_manager->get_log_in_form(
				$form_location,
				$redirect_script_location,
				$desired_location,
				$cancel_page_location
			)
		);

		$log_in_to_account_div->append_tag_to_content($login_form_div);

		$password_reset_confirmation_url = $log_in_manager->get_password_reset_confirmation_url();
		$password_reset_confirmation_a = new HTMLTags_A('Forgotten your password?');
		$password_reset_confirmation_a->set_href($password_reset_confirmation_url);
		$log_in_to_account_div->append_tag_to_content($password_reset_confirmation_a);

		#$navigation_div->append_tag_to_content($log_in_to_account_div);
		$mini_shop_accounts_div->append_tag_to_content($log_in_to_account_div);
	}
}

echo $mini_shop_accounts_div->get_as_string();
?>
