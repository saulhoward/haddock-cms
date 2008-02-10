<?php
/**
 * MailingList_PeopleTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-02-16
 */

class
    MailingList_PeopleTableRenderer
extends
    Database_TableRenderer
{
    /**
     * A table to display the web_videos in public, with pages
     */
    public function
        get_paged_public_all_people_div($page)
    {
        $people_table = $this->get_element();
        $all_people_div = new HTMLTags_Div();

            ####################################################################
            #
            # Display some of the data in the web_videos table.
            #
            ####################################################################
            
            if ($people_table->count_all_rows() >= 11) {
                /*
                 * DIV for limits and previous and nexts.
                 */
                $limit_previous_next_div = new HTMLTags_Div();
                $limit_previous_next_div->set_attribute_str('class', 'table_pages_div');
                
                /*
                 * To allow the user to set the number of extras to show at a time.
                 */
                $limit_action = new HTMLTags_URL();
                $limit_action->set_file('/');
                
                $limit_form = new Database_LimitForm($limit_action, LIMIT, '10 20 50');
                
                $limit_form->add_hidden_input('page', $page);
                
                $limit_form->add_hidden_input('order_by', ORDER_BY);
                $limit_form->add_hidden_input('direction', DIRECTION);
                $limit_form->add_hidden_input('offset', OFFSET);
                
                $limit_previous_next_div->append_tag_to_content($limit_form);
                
                /*
                 * Go the previous or next list of extras.
                 */
                $previous_next_url = new HTMLTags_URL();
                $previous_next_url->set_file('/');
                
                $previous_next_url->set_get_variable('page', $page);
                
                $previous_next_url->set_get_variable('order_by', ORDER_BY);
                $previous_next_url->set_get_variable('direction', DIRECTION);
                
                #print_r($previous_next_url);

                $row_count = $people_table->count_people();
                
                #echo "\$row_count: $row_count\n";
                
                $previous_next_ul = new Database_PreviousNextUL(
                    $previous_next_url,
                    OFFSET,
                    LIMIT,
                    $row_count
                );
                
                $limit_previous_next_div->append_tag_to_content($previous_next_ul);
                
                $all_people_div->append_tag_to_content($limit_previous_next_div);
            }
            # ------------------------------------------------------------------
            
            /**
             * The table.
             */
            $rows_html_table = new HTMLTags_Table();
            $rows_html_table->set_attribute_str('class', 'table_pages');

            $conditions['status'] = 'accepted';
            $rows = $people_table->get_rows_where($conditions, ORDER_BY, DIRECTION, OFFSET, LIMIT);
            
            #$rows = $people_table->get_all_rows(ORDER_BY, DIRECTION, OFFSET, LIMIT);
            
            foreach ($rows as $row) {
                $row_renderer = $row->get_renderer();

                $data_tr = $row_renderer->get_public_people_tr();
                
                $rows_html_table->append_tag_to_content($data_tr);
            }
            
            # ------------------------------------------------------------------
            
            $all_people_div->append_tag_to_content($rows_html_table);
            
            if ($people_table->count_all_rows() >= 11) {            
                $all_people_div->append_tag_to_content($limit_previous_next_div);
            }
        
        return $all_people_div;
    }
    
    /**
     * A table to display the people in public, with pages
     */
    public function
        get_public_short_people_div($page)
    {
        $people_table = $this->get_element();
        $short_people_div = new HTMLTags_Div();

            # ------------------------------------------------------------------
            
            /**
             * The table.
             */
            $rows_html_table = new HTMLTags_Table();
            $rows_html_table->set_attribute_str('class', 'table_short');
            
            $conditions['status'] = 'accepted';
            $rows = $people_table->get_rows_where($conditions, ORDER_BY, DIRECTION, OFFSET, LIMIT);
            #$rows = $people_table->get_all_rows(ORDER_BY, DIRECTION, OFFSET, LIMIT);
            
            foreach ($rows as $row) {
                $row_renderer = $row->get_renderer();
                
                #$data_tr = $row_renderer->get_admin_database_tr();
                $data_tr = $row_renderer->get_public_people_tr();
                
                $rows_html_table->append_tag_to_content($data_tr);
            }
            
            # ------------------------------------------------------------------
            
            $short_people_div->append_tag_to_content($rows_html_table);
        
        return $short_people_div;
    }
    
   public function
        get_person_adding_form(
		HTMLTags_URL $redirect_script_url,
		HTMLTags_URL $cancel_location
	)
    {
#        $mysql_user_factory = Database_MySQLUserFactory::get_instance();
#        $mysql_user = $mysql_user_factory->get_for_this_project(); 
#        $database = $mysql_user->get_database();
#        
#        $people_table = $database->get_table('hpi_mailing_list_people');
	    $people_table = $this->get_element();
            
#        $redirect_script_url = new HTMLTags_URL();
#        $redirect_script_url->set_file('/admin/redirect-script.php');
#        $redirect_script_url->set_get_variable('type', 'redirect-script');        
#        $redirect_script_url->set_get_variable('module', 'mailing-list');
#        $redirect_script_url->set_get_variable('page', 'mailing-list');
#
#        $cancel_location = new HTMLTags_URL();
#        $cancel_location->set_file('/admin/mailing-list/mailing-list.html');
        
        $person_adding_form = new HTMLTags_SimpleOLForm('person_adding');
        
        $person_adding_action = clone $redirect_script_url;
        
        $person_adding_action->set_get_variable('add_person');
    
        $person_adding_form->set_action($person_adding_action);
        
        $person_adding_form->set_legend_text('Add a new Person');
        
        #Added 	Name 	email

        /*
         * The name
         */
        $name_field = $people_table->get_field('name');
            
        $name_field_renderer = $name_field->get_renderer();
            
        $input_tag = $name_field_renderer->get_form_input();
        
        $input_tag->set_attribute_str('id', 'name');
        
        $person_adding_form->add_input_tag(
            'name',
            $input_tag
        );        
        /*
         * The email
         */
        $email_field = $people_table->get_field('email');
            
        $email_field_renderer = $email_field->get_renderer();
            
        $input_tag = $email_field_renderer->get_form_input();
        
        $input_tag->set_attribute_str('id', 'email');
        
        $person_adding_form->add_input_tag(
            'email',
            $input_tag
        );
        /*
         * The status
         */
        $status_field = $people_table->get_field('status');
            
        $status_field_renderer = $status_field->get_renderer();
            
        $input_tag = $status_field_renderer->get_form_input();
        
        $input_tag->set_attribute_str('id', 'status');
        
        $person_adding_form->add_input_tag(
            'status',
            $input_tag
        );
        /*
         * The update button.
         */
        $person_adding_form->set_submit_text('Add');
        
        $person_adding_form->set_cancel_location($cancel_location);
        
        return $person_adding_form;
    }

    public function
        get_csv_adding_form()
    {
        $people_table = $this->get_element();
        
        $csv_adding_form = new HTMLTags_SimpleOLForm('csv_adding');
        
        $csv_adding_form->set_attribute_str('enctype', 'multipart/form-data');
                
        $legend_text = 'Add a CSV file';
        
        $csv_adding_form->set_legend_text($legend_text);
        
        /*
         * THE FILE
         */
        $file_input_tag = new HTMLTags_Input();
        
        $file_input_tag_name = 'user_file[]';
        
        $file_input_tag->set_attribute_str('type', 'file');
        $file_input_tag->set_attribute_str('id', $file_input_tag_name);
        $file_input_tag->set_attribute_str('name', $file_input_tag_name);
        
        $csv_adding_form->add_input_tag(
            $file_input_tag_name,
            $file_input_tag,
            'File'
        );
        
        $csv_adding_form->add_hidden_input('MAX_FILE_SIZE', '1000000');
        
        $csv_adding_form->set_submit_text('Add');
        
        return $csv_adding_form;
    }
}
?>
