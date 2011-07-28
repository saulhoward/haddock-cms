<?php
/**
 * UserLogin_UserRowRenderer
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

class
    UserLogin_UserRowRenderer
extends
    Database_RowRenderer
{
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
