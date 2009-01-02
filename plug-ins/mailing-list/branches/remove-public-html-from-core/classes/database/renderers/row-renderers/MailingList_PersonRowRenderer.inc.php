<?php
/**
 * MailingList_PersonRowRenderer
 *
 * @copyright Clear Line Web Design, 2007-02-16
 */

class
    MailingList_PersonRowRenderer
extends
    Database_RowRenderer
{
    /**
     * The paragraph tag for a web_video.
     *
     * This method is called in the public pages
     * to display a web_video.
     */
    public function
        get_html_p()
    {
        $person = $this->get_element();
        
        $html_p = new HTMLTags_P();
        
        $html_p->append_str_to_content('&quot;');
        
        $html_p->append_str_to_content($person->get_name());
        
        $html_p->append_str_to_content('&quot;');
        
        $html_p->append_str_to_content(' &#150; ');
        
        $html_p->append_str_to_content($person->get_email());
        
        return $html_p;
    }
    
    /**
     * Provides a link to the page of the person who
     * gave the web_video.
     */
    public function
        get_html_a()
    {
        $person = $this->get_element();
        
        if ($personer->has_url()) {
            if ($personer->has_homepage_title()) {
                $html_a = new HTMLTags_A($personer->get_homepage_title());
            } else {
                $html_a = new HTMLTags_A($personer->get_url());
            }
            
            $url = new HTMLTags_URL($personer->get_url());
            
            $html_a->set_href($url);
            
            $html_a->set_attribute_str('target', '_blank');
            
            return $html_a;
        } else {
            throw new Exception(
                'The web_video with id '
                . $person->get_id()
                . ' does not have a URL!'
            );
        }
    }
    
    /**
     * An HTML table that has all the data
     * (except the sort order and id) of a row
     * in the web_videos table.
     *
     * Used in the admin page to list all the
     * web_videos.
     */
    public function
        get_all_data_vertical_html_table()
    {
        $table = new HTMLTags_Table();
        
        $person = $this->get_element();
        $personer = $person->get_web_videoer();
        /*
         * ---------------------------------------------------------------------
         */
        
        /*
         * The name.
         */
        $name_tr = new HTMLTags_TR();
        
        $name_tr->append_tag_to_content(new HTMLTags_TD('Name:'));
        
        $name_tr->append_tag_to_content(
            new HTMLTags_TD($personer->get_name())
        );
        
        $table->append_tag_to_content($name_tr);
        
        /*
         * The URL.
         */
        $url_tr = new HTMLTags_TR();
        
        $url_tr->append_tag_to_content(new HTMLTags_TD('URL:'));
        
        $url_tr->append_tag_to_content(
            new HTMLTags_TD($personer->get_url())
        );
        
        $table->append_tag_to_content($url_tr);
        
        /*
         * The Homepage Title.
         */
        $homepage_title_tr = new HTMLTags_TR();
        
        $homepage_title_tr->append_tag_to_content(
            new HTMLTags_TD('Homepage Title:')
        );
        
        $homepage_title_tr->append_tag_to_content(
            new HTMLTags_TD($personer->get_homepage_title())
        );
        
        $table->append_tag_to_content($homepage_title_tr);
        
        /*
         * The Link to their webpage.
         */
        if ($personer->has_url()) {
            $link_tr = new HTMLTags_TR();
            
            $link_tr->append_tag_to_content(
                new HTMLTags_TD('Link:')
            );
            
            $link_td = new HTMLTags_TD();
            
            $link_td->append_tag_to_content($this->get_html_a());
            
            $link_tr->append_tag_to_content($link_td);
            
            $table->append_tag_to_content($link_tr);
        }
        
        /*
         * The web_video.
         */
        $person_tr = new HTMLTags_TR();
        
        $person_tr->append_tag_to_content(new HTMLTags_TD('web_video:'));
        
        $person_tr->append_tag_to_content(
            new HTMLTags_TD($person->get_web_video())
        );
        
        $table->append_tag_to_content($person_tr);
        
        /*
         * The date added.
         */
        $added_tr = new HTMLTags_TR();
        
        $added_tr->append_tag_to_content(new HTMLTags_TD('Added:'));
        
        $added_tr->append_tag_to_content(
            new HTMLTags_TD($person->get_added())
        );
        
        /*
         * ---------------------------------------------------------------------
         */
        
        $table->append_tag_to_content($added_tr);
        
        return $table;
    }
    
    public function get_public_web_videos_html_table_tr()    
    {
        $person = $this->get_element();

        $person_row = new HTMLTags_TR();
        /*
         * The added.
         */
        $added_td = new HTMLTags_TD($person->get_added());
        
        $person_row->append_tag_to_content($added_td);
        /*
         * The name.
         */
        $name_td = new HTMLTags_TD($person->get_name());
        
        $person_row->append_tag_to_content($name_td);
         
        /*
         * The status.
         */
        $status_td = new HTMLTags_TD($person->get_status());
        
        $person_row->append_tag_to_content($status_td);
        /*
         * The video_host.
         */
        $video_host_td = new HTMLTags_TD($person->get_video_host());
        
        $person_row->append_tag_to_content($video_host_td);
        /*
         * The video_url.
         */
        $video_url_td = new HTMLTags_TD($person->get_video_url());
        
        $person_row->append_tag_to_content($video_url_td);
         
        
        return $person_row;
    }
    
    public function get_public_people_tr()    
    {
    $person = $this->get_element();
    
    $person_tr = new HTMLTags_TR();
    
    /* The title */
    $person_title_h = new HTMLTags_Heading(3, $person->get_name());
    $person_tr->append_tag_to_content($person_title_h);
    
    /* The Video */
    $trailer_video_location = $person->get_video_url();
    
     $trailer_object = new HTMLTags_Object();
            $trailer_object->set_attribute_str('type', 'application/x-shockwave-flash');
            $trailer_object->set_attribute_str('data', $trailer_video_location);
            
            #youtube needs width="425" height="350"
                if ($person->get_video_host() == 'YouTube')
                    {
                            $trailer_object->set_attribute_str('width', '425');
                            $trailer_object->set_attribute_str('height', '350');
                    }
                else
                    {
                            $trailer_object->set_attribute_str('width', '400');
                            $trailer_object->set_attribute_str('height', '326');               
                    }
            $trailer_object->set_attribute_str('id', 'VideoPlayback');

            $param1 = new HTMLTags_Param();
                $param1->set_attribute_str('name', 'movie');
                $param1->set_attribute_str('value', $trailer_video_location);
            $trailer_object->append_tag_to_content($param1);

                if ($person->get_video_host() == 'YouTube')
                    {
                    $param8 = new HTMLTags_Param();
                        $param8->set_attribute_str('name', 'wmode');
                        $param8->set_attribute_str('value', 'transparent');
                    $trailer_object->append_tag_to_content($param8);
                    
                    $trailer_embed = new HTMLTags_Embed();
                        $trailer_embed->set_attribute_str('width', '425');
                        $trailer_embed->set_attribute_str('height', '350');
                        $trailer_embed->set_attribute_str('wmode', 'transparent');
                        $trailer_embed->set_attribute_str('type', 'application/x-shockwave-flash');
                        $trailer_embed->set_attribute_str('src', $trailer_video_location);
                    $trailer_object->append_tag_to_content($trailer_embed);
                    }
                    else
                    { 
                    $param2 = new HTMLTags_Param();
                        $param2->set_attribute_str('name', 'allowScriptAccess');
                        $param2->set_attribute_str('value', 'sameDomain');
                    $trailer_object->append_tag_to_content($param2);
                        
                    $param3 = new HTMLTags_Param();
                        $param3->set_attribute_str('name', 'quality');
                        $param3->set_attribute_str('value', 'best');
                    $trailer_object->append_tag_to_content($param3);
                        
                    $param4 = new HTMLTags_Param();
                        $param4->set_attribute_str('name', 'bgcolor');
                        $param4->set_attribute_str('value', '#000000');
                    $trailer_object->append_tag_to_content($param4);
                        
                    $param5 = new HTMLTags_Param();
                        $param5->set_attribute_str('name', 'scale');
                        $param5->set_attribute_str('value', 'noScale');
                    $trailer_object->append_tag_to_content($param5);
                        
                    $param6 = new HTMLTags_Param();
                        $param6->set_attribute_str('name', 'salign');
                        $param6->set_attribute_str('value', 'TL');
                    $trailer_object->append_tag_to_content($param6);
                        
                    $param7 = new HTMLTags_Param();
                        $param7->set_attribute_str('name', 'FlashVars');
                        $param7->set_attribute_str('value', 'playerMode=embedded');
                    $trailer_object->append_tag_to_content($param7);
                    }
        $person_tr->append_tag_to_content($trailer_object);
        return $person_tr;
    }
    
    public function get_admin_people_html_table()
    {
            $person_row = $this->get_element();
            /**
             * The table.
             */
            $rows_html_table = new HTMLTags_Table();
            
            /**
             * The caption.
             */
            $caption = new HTMLTags_Caption(
                'Person to be deleted'
            );
            $rows_html_table->append_tag_to_content($caption);
            
            /**
             * The Heading Row.
             */
            $heading_tr = new HTMLTags_TR();
            
            $heading_tr->append_tag_to_content(new HTMLTags_TH('Added'));
            $heading_tr->append_tag_to_content(new HTMLTags_TH('Name'));
            $heading_tr->append_tag_to_content(new HTMLTags_TH('Email'));
            $heading_tr->append_tag_to_content(new HTMLTags_TH('Status'));
            
            $rows_html_table->append_tag_to_content($heading_tr);

            /**
             * Display the contents of the table.
             */
                $data_tr = $this->get_admin_people_html_table_tr_without_actions();
                
                $rows_html_table->append_tag_to_content($data_tr);
            
            return $rows_html_table;
        
        
        return $person_table;
    }

	public function
		get_admin_people_html_table_tr(
			HTMLTags_URL $edit_location,
			HTMLTags_URL $delete_location
		) 
	{ 
		$person = $this->get_element();
        
       $html_row =  new HTMLTags_TR();
        
        $row = $this->get_element();
        
        $table = $row->get_table();
        $database = $row->get_database();

        /*
         * The data.
         */ 

        $added_field = $table->get_field('added');
        
        $added_td = $this->get_data_html_table_td($added_field);
                    
        $html_row->append_tag_to_content($added_td);

        $name_field = $table->get_field('name');
        
        $name_td = $this->get_data_html_table_td($name_field);
                    
        $html_row->append_tag_to_content($name_td);
        
        $email_field = $table->get_field('email');
        
        $email_td = $this->get_data_html_table_td($email_field);
                    
        $html_row->append_tag_to_content($email_td);

        $status_field = $table->get_field('status');
        
        $status_td = $this->get_data_html_table_td($status_field);
                    
        $html_row->append_tag_to_content($status_td);

            /*
             * The edit td.
             */
            $edit_td = new HTMLTags_TD();
            
            $edit_link = new HTMLTags_A('Edit');
            $edit_link->set_attribute_str('class', 'cool_button');
            $edit_link->set_attribute_str('id', 'edit_table_button');
            
#            $edit_location = new HTMLTags_URL();
#            
#            $edit_location->set_file('/admin/');
#            
#            $edit_location->set_get_variable('module', 'mailing-list');            
#            $edit_location->set_get_variable('page', 'mailing-list');
            
            $edit_location->set_get_variable('edit_id', $row->get_id());
            
            $edit_link->set_href($edit_location);
            
            $edit_td->append_tag_to_content($edit_link);
            
            $html_row->append_tag_to_content($edit_td);
            
            /*
             * The delete td.
             */
            $delete_td = new HTMLTags_TD();
    
            $delete_link = new HTMLTags_A('Delete');
            $delete_link->set_attribute_str('class', 'cool_button');
            $delete_link->set_attribute_str('id', 'delete_table_button');
    
#            $delete_location = new HTMLTags_URL();
#    
#            $delete_location->set_file('/admin/');
#            
#            $delete_location->set_get_variable('module', 'mailing-list');     
#            $delete_location->set_get_variable('page', 'mailing-list');
    
            $delete_location->set_get_variable('delete_id', $row->get_id());
    
            $delete_link->set_href($delete_location);
    
            $delete_td->append_tag_to_content($delete_link);
    
            $html_row->append_tag_to_content($delete_td);
                
        return $html_row;
    }
    
    public function get_admin_people_html_table_tr_without_actions()
    {
        
        $person = $this->get_element();
        
       $html_row =  new HTMLTags_TR();
        
        $row = $this->get_element();
        
        $table = $row->get_table();
        $database = $row->get_database();

        /*
         * The data.
         */ 

        $added_field = $table->get_field('added');
        
        $added_td = $this->get_data_html_table_td($added_field);
                    
        $html_row->append_tag_to_content($added_td);

        $name_field = $table->get_field('name');
        
        $name_td = $this->get_data_html_table_td($name_field);
                    
        $html_row->append_tag_to_content($name_td);

        $email_field = $table->get_field('email');
        
        $email_td = $this->get_data_html_table_td($email_field);
                    
        $html_row->append_tag_to_content($email_td);
    
        $status_field = $table->get_field('status');
        
        $status_td = $this->get_data_html_table_td($status_field);
                    
        $html_row->append_tag_to_content($status_td);
        
        return $html_row;
    }
    
	public function
		get_person_editing_form(
			HTMLTags_URL $redirect_script_url,
			HTMLTags_URL $cancel_location
		)
	{ 
		$person_row = $this->get_element();

		$people_table = $person_row->get_table();
		    
#		$redirect_script_url = new HTMLTags_URL();
#		$redirect_script_url->set_file('/admin/redirect-script.php');
#		$redirect_script_url->set_get_variable('type', 'redirect-script');        
#		$redirect_script_url->set_get_variable('module', 'mailing-list');
#		$redirect_script_url->set_get_variable('page', 'mailing-list');
#
#		$cancel_location = new HTMLTags_URL();
#		$cancel_location->set_file('/admin/mailing-list/mailing-list.html');
#
		$person_editing_form = new HTMLTags_SimpleOLForm('person_editing');

		$person_editing_action = clone $redirect_script_url;

		$person_editing_action->set_get_variable('edit_id', $person_row->get_id());

		$person_editing_form->set_action($person_editing_action);

		$person_editing_form->set_legend_text('Edit this Person');

#Added 	Name 	Email

		/*
		 * The name
		 */
		$name_field = $people_table->get_field('name');
		    
		$name_field_renderer = $name_field->get_renderer();
		    
		$input_tag = $name_field_renderer->get_form_input();

		$input_tag->set_value($person_row->get_name());

		$input_tag->set_attribute_str('id', 'name');

		$person_editing_form->add_input_tag(
		    'name',
		    $input_tag
		);        

		/*
		 * The email
		 */
		$email_field = $people_table->get_field('email');
		    
		$email_field_renderer = $email_field->get_renderer();
		    
		$input_tag = $email_field_renderer->get_form_input();

		$input_tag->set_value($person_row->get_email());

		$input_tag->set_attribute_str('id', 'email');

		$person_editing_form->add_input_tag(
		    'email',
		    $input_tag
		);        

		/*
		 * The status
		 */
		$status_field = $people_table->get_field('status');
		    
		$status_field_renderer = $status_field->get_renderer();
		    
		$input_tag = $status_field_renderer->get_form_input();

		$input_tag->set_value($person_row->get_status());

		$input_tag->set_attribute_str('id', 'status');

		$person_editing_form->add_input_tag(
		    'status',
		    $input_tag
		);      

		/*
		 * The update button.
		 */
		$person_editing_form->set_submit_text('Update');

		$person_editing_form->set_cancel_location($cancel_location);

		return $person_editing_form;
	}
}
?>
