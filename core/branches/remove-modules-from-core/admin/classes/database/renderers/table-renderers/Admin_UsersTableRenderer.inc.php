<?php
/**
 * Admin_UsersTableRenderer
 *
 * @copyright 2007-08-27, Robert Impey
 */

class
	Admin_UsersTableRenderer
extends
	Database_TableRenderer
{
	//public function
	//    get_admin_users_html_div(
	//        $order_by,
	//        $direction,
	//        $limit,
	//        $offset
	//    )
	//{
	//    $users_table = $this->get_element();
	//    
	//    //$admin_users_html_table = new HTMLTags_Table();
	//    //$admin_users_html_table->set_attribute_str('id', 'admin_users_table');
	//    //
	//    ///*
	//    // * The head
	//    // */
	//    //$thead = new HTMLTags_THead();
	//    //
	//    //$header_tr = new HTMLTags_TR();
	//    //
	//    //$header_tr->append_tag_to_content(new HTMLTags_TH('Name'));
	//    //$header_tr->append_tag_to_content(new HTMLTags_TH('Email'));
	//    //$header_tr->append_tag_to_content(new HTMLTags_TH('Real Name'));
	//    //$header_tr->append_tag_to_content(new HTMLTags_TH('Type'));
	//    //
	//    //$actions_th = new HTMLTags_TH('Actions');
	//    //
	//    //$actions_th->set_attribute_str('colspan', 3);
	//    //
	//    //$header_tr->append_tag_to_content($actions_th);
	//    //
	//    //$thead->append_tag_to_content($header_tr);
	//    //
	//    //$admin_users_html_table->append_tag_to_content($thead);
	//    //
	//    ///*
	//    // * The body.
	//    // */
	//    //$tbody = new HTMLTags_TBody();
	//    //
	//    //$admin_users = $users_table->get_admin_users_viewable_by_currently_logged_in_user();
	//    //
	//    //foreach ($admin_users as $admin_user) {
	//    //    $admin_user_renderer = $admin_user->get_renderer();
	//    //    
	//    //    $tbody->append_tag_to_content($admin_user_renderer->get_admin_users_html_table_tr());
	//    //}
	//    //
	//    //$admin_users_html_table->append_tag_to_content($tbody);
	//    
	//    return $admin_users_html_div;
	//}
	
	public function
		get_admin_users_admin_actions()
	{
		$actions = array();
		
		/*
		 * The reset password action.
		 */
		$reset_password_action['th'] = new HTMLTags_TH('Reset Password');
		$reset_password_action['method'] = 'get_admin_users_reset_password_td';
		$actions[] = $reset_password_action;
		
		/*
		 * The change password action.
		 */
		$change_password_action['th'] = new HTMLTags_TH('Change Password');
		$change_password_action['method'] = 'get_admin_users_change_password_td';
		$actions[] = $change_password_action;
		
		/*
		 * The edit user action.
		 */
		$edit_action['th'] = new HTMLTags_TH('Edit');
		$edit_action['method'] = 'get_admin_users_edit_td';
		$actions[] = $edit_action;
		
		/*
		 * The delete user action.
		 */
		$delete_action['th'] = new HTMLTags_TH('Delete');
		$delete_action['method'] = 'get_admin_users_delete_td';
		$actions[] = $delete_action;
		
		return $actions;
	}
	
	public function
		get_add_new_user_form()
	{
		$add_new_user_form = new HTMLTags_SimpleOLForm('add_new_user');
		
	$redirect_script = Admin_AdminIncluderURLFactory
		::get_url(
		'haddock',
		'admin',
		'manage-users',
		'redirect-script'
		);
		
	$action_href = clone $redirect_script;
	
		$action_href->set_get_variable('add-new-user');
		
		$add_new_user_form->set_action($action_href);
		
		$add_new_user_form->set_legend_text('Add new user');
		
		/*
		 * The user's name
		 */
		$svm = Caching_SessionVarManager::get_instance();
		
		if ($svm->is_set('manage-users-form: name')) {
			$add_new_user_form->add_input_name_with_value(
				'name',
				$svm->get('manage-users-form: name')
			);
		} else {
			$add_new_user_form->add_input_name('name');
		}
		
		/*
		 * The user's password.
		 */
		$password_input = new HTMLTags_Input();
		$password_input->set_attribute_str('type', 'password');
		$password_input->set_attribute_str('id', 'password');
		$password_input->set_attribute_str('name', 'password');
		$add_new_user_form->add_input_tag('password', $password_input);
		
		$password_confirm_input = new HTMLTags_Input();
		$password_confirm_input->set_attribute_str('type', 'password');
		$password_confirm_input->set_attribute_str('id', 'confirm_password');
		$password_confirm_input->set_attribute_str('name', 'confirm_password');
		$add_new_user_form->add_input_tag('confirm_password', $password_confirm_input);
		
		/*
		 * The type of admin user.
		 */
		$login_manager = Admin_LoginManager::get_instance();
		$user_types = $login_manager->get_user_types();
		$user_types_select = HTMLTags_SelectFactory
			::make_select_for_str_array($user_types);
		
		$user_types_select->set_attribute_str('id', 'type');
		$user_types_select->set_attribute_str('name', 'type');
		
		if ($svm->is_set('manage-users-form: type')) {
			$user_types_select->set_value(
				$svm->get('manage-users-form: type')
			);
		}
		
		$add_new_user_form->add_input_tag('type', $user_types_select);
		
		/*
		 * The user's real name
		 */
		if ($svm->is_set('manage-users-form: real_name')) {
			$add_new_user_form->add_input_name_with_value(
				'real_name',
				$svm->get('manage-users-form: real_name')
			);
		} else {
			$add_new_user_form->add_input_name('real_name');
		}
		
		/*
		 * The user's email
		 */
		if ($svm->is_set('manage-users-form: email')) {
			$add_new_user_form->add_input_name_with_value(
				'email',
				$svm->get('manage-users-form: email')
			);
		} else {
			$add_new_user_form->add_input_name('email');
		}

		$add_new_user_form->set_submit_text('Add');
				
	$cancel_href = clone $redirect_script;
	
		$cancel_href->set_get_variable('cancel');
		
		$add_new_user_form->set_cancel_location($cancel_href);
		
		return $add_new_user_form;
	}
}
?>
