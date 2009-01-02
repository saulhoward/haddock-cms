<?php
/**
 * Database_FilesTableRenderer
 *
 * @copyright Clear Line Web Design, 2006-09-23
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/renderers/'
#    . 'Database_TableRenderer.inc.php';

/**
 * A class to render Images Tables
 */
class
    Database_FilesTableRenderer
extends
    Database_TableRenderer
{
    public function
        get_row_adding_form(
            HTMLTags_URL $row_adding_action,
            HTMLTags_URL $cancel_href
        )
    {
        $table = $this->get_element();
        
        $row_adding_form = new HTMLTags_SimpleOLForm('files_adding');
        
        $row_adding_form->set_attribute_str('enctype', 'multipart/form-data');
        $row_adding_form->set_attribute_str('class', 'basic-form');
        
        $file_input_tag = new HTMLTags_Input();
        
        $file_input_tag_name = 'user_file[]';
        
        $file_input_tag->set_attribute_str('type', 'file');
        $file_input_tag->set_attribute_str('id', $file_input_tag_name);
        $file_input_tag->set_attribute_str('name', $file_input_tag_name);
        
        $row_adding_form->add_input_tag(
            $file_input_tag_name,
            $file_input_tag,
            'File'
        );
        
        $row_adding_form->add_hidden_input('MAX_FILE_SIZE', '1000000');
        
        $row_adding_form->set_action($row_adding_action);
        
        $row_adding_form->set_legend_text('Add file.');
        
        $row_adding_form->set_submit_text('Add');
        
        $row_adding_form->set_cancel_location($cancel_href);
        
        return $row_adding_form;
    }
    
    public function
        get_admin_database_action_ths()
    {
        $ths = array();
        
        $ths[] = new HTMLTags_TH('Delete');
        
        return $ths;
    }
}

?>
