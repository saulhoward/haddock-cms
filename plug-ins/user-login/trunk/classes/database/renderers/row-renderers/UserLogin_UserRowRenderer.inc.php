<?php
/**
 * UserLogin_UserRowRenderer
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/renderers/'
    . 'Database_RowRenderer.inc.php';

class
	UserLogin_UserRowRenderer
extends
    Database_RowRenderer
{
    //public function
    //    get_admin_users_html_table_tr()
    //{
    //    $user_row = $this->get_element();
    //    
    //    $admin_users_html_table_tr = new HTMLTags_TR();
    //    
    //    $name_td = new HTMLTags_TD();
    //    $name_td->append_str_to_content($user_row->get_name());
    //    $admin_users_html_table_tr->append_tag_to_content($name_td);
    //    
    //    $email_td = new HTMLTags_TD();
    //    $email_td->append_str_to_content($user_row->get_email());
    //    $admin_users_html_table_tr->append_tag_to_content($email_td);
    //    
    //    $real_name_td = new HTMLTags_TD();
    //    $real_name_td->append_str_to_content($user_row->get_real_name());
    //    $admin_users_html_table_tr->append_tag_to_content($real_name_td);
    //
    //    $type_td = new HTMLTags_TD();
    //    $email_td->append_str_to_content($user_row->get_type());
    //    $admin_users_html_table_tr->append_tag_to_content($type_td);
    //    
    //    /*
    //     * The actions
    //     */
    //    $confirmation_url_base = new HTMLTags_URL();
    //    
    //    $confirmation_url_base->set_file('/');
    //    
    //    $confirmation_url_base->set_get_variable('section', 'haddock');
    //    $confirmation_url_base->set_get_variable('module', 'admin');
    //    $confirmation_url_base->set_get_variable('page', 'admin-includer');
    //    $confirmation_url_base->set_get_variable('type', 'html');
    //    $confirmation_url_base->set_get_variable('admin-section', 'haddock');
    //    $confirmation_url_base->set_get_variable('admin-module', 'admin');
    //    
    //    /*
    //     * Reset the password.
    //     */
    //    $reset_password_td = new HTMLTags_TD();
    //    
    //    $reset_password_confirm_url = clone $confirmation_url_base;
    //    $reset_password_confirm_url->set_get_variable('admin-page', 'reset-password');
    //    $reset_password_confirm_url->set_get_variable('user_id', $user_row->get_id());
    //    
    //    $reset_password_a = new HTMLTags_A('Reset password');
    //    $reset_password_a->set_href($reset_password_confirm_url);
    //    
    //    $reset_password_td->append_tag_to_content($reset_password_a);
    //    
    //    $admin_users_html_table_tr->append_tag_to_content($reset_password_td);
    //    
    //    /*
    //     * Edit the user's details.
    //     */
    //    $edit_td = new HTMLTags_TD();
    //    
    //    $edit_url = clone $confirmation_url_base;
    //    $edit_url->set_get_variable('admin-page', 'edit-user');
    //    $edit_url->set_get_variable('user_id', $user_row->get_id());
    //    
    //    $edit_a = new HTMLTags_A('Edit');
    //    $edit_a->set_href($edit_url);
    //    
    //    $edit_td->append_tag_to_content($edit_a);
    //    
    //    $admin_users_html_table_tr->append_tag_to_content($edit_td);
    //    
    //    /*
    //     * Delete the user.
    //     */
    //    $delete_td = new HTMLTags_TD();
    //    
    //    $delete_url = clone $confirmation_url_base;
    //    $delete_url->set_get_variable('admin-page', 'delete-user');
    //    $delete_url->set_get_variable('user_id', $user_row->get_id());
    //    
    //    $delete_a = new HTMLTags_A('Delete');
    //    $delete_a->set_href($delete_url);
    //    
    //    $delete_td->append_tag_to_content($delete_a);
    //    
    //    $admin_users_html_table_tr->append_tag_to_content($delete_td);
    //    
    //    
    //    return $admin_users_html_table_tr;
    //}
    
    /*
     * -------------------------------------------------------
     * Methods to do with the action TDs for the admin section
     * -------------------------------------------------------
     */
    
    private function
	get_admin_users_td(
	    $a_text,
	    $admin_page
	)
    {
	$user_row = $this->get_element();
	
	$td = new HTMLTags_TD();
        
        $confirm_url = Admin_AdminIncluderURLFactory
	    ::get_url(
		'haddock',
		'admin',
		$admin_page,
		'html'
	    );
	    
        $confirm_url->set_get_variable('user_id', $user_row->get_id());
        
        $a = new HTMLTags_A($a_text);
        $a->set_href($confirm_url);
        
	$a->set_attribute_str('class', 'cool_button');
	
        $td->append_tag_to_content($a);
        
        return $td;
    }
    
    public function
	get_admin_users_reset_password_td()
    {
	return $this->get_admin_users_td('Reset Password', 'reset-password');
    }
    
    public function
	get_admin_users_change_password_td()
    {
	return $this->get_admin_users_td('Change Password', 'change-password');
    }
    
    public function
	get_admin_users_edit_td()
    {
	return $this->get_admin_users_td('Edit', 'edit-user');
    }
    
    public function
	get_admin_users_delete_td()
    {
	return $this->get_admin_users_td('Delete', 'delete-user');
    }
    
    /**
     * @return
     *  HTMLTags_SimpleOLForm
     *  The form for editing the values of a user to be displayed in the
     *  admin section.
     */
    public function
        get_edit_user_form()
    {
        $user_row = $this->get_element();
        
        $edit_user_form = new HTMLTags_SimpleOLForm('edit_user');
        
	$redirect_script = Admin_AdminIncluderURLFactory
	    ::get_url(
		'haddock',
		'admin',
		'manage-users',
		'redirect-script'
	    );
	    
	$action_href = clone $redirect_script;
	
        $action_href->set_get_variable('edit-user');
        $action_href->set_get_variable('user_id', $user_row->get_id());
        
        $edit_user_form->set_action($action_href);
        
        $edit_user_form->set_legend_text('Update user');
        
        /*
         * The user's name
         */
        $svm = Caching_SessionVarManager::get_instance();
        
        if ($svm->is_set('manage-users-form: name')) {
            $edit_user_form->add_input_name_with_value(
                'name',
                $svm->get('manage-users-form: name')
            );
        } else {
            $edit_user_form->add_input_name_with_value(
                'name',
                $user_row->get_name()
            );
        }
        
        ///*
        // * The user's password.
        // */
        //$password_input = new HTMLTags_Input();
        //$password_input->set_attribute_str('type', 'password');
        //$password_input->set_attribute_str('id', 'password');
        //$password_input->set_attribute_str('name', 'password');
        //$edit_user_form->add_input_tag('password', $password_input);
        //
        //$password_confirm_input = new HTMLTags_Input();
        //$password_confirm_input->set_attribute_str('type', 'password');
        //$password_confirm_input->set_attribute_str('id', 'confirm_password');
        //$password_confirm_input->set_attribute_str('name', 'confirm_password');
        //$edit_user_form->add_input_tag('confirm_password', $password_confirm_input);
        
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
        } else {
            $user_types_select->set_value(
                $user_row->get_type()
            );
        }
        
        $edit_user_form->add_input_tag('type', $user_types_select);
        
        /*
         * The user's real name
         */
        if ($svm->is_set('manage-users-form: real_name')) {
            $edit_user_form->add_input_name_with_value(
                'real_name',
                $svm->get('manage-users-form: real_name')
            );
        } else {
            $edit_user_form->add_input_name_with_value(
                'real_name',
                $user_row->get_real_name()
            );
        }
        
        /*
         * The user's email
         */
        if ($svm->is_set('manage-users-form: email')) {
            $edit_user_form->add_input_name_with_value(
                'email',
                $svm->get('manage-users-form: email')
            );
        } else {
            $edit_user_form->add_input_name_with_value(
                'email',
                $user_row->get_email()
            );
        }

        $edit_user_form->set_submit_text('Update');
                
	$cancel_href = clone $redirect_script;
	
        $cancel_href->set_get_variable('cancel');
        
        $edit_user_form->set_cancel_location($cancel_href);
        
        return $edit_user_form;
    }
}
?>
