<?php
/**
 * Logging_ServerLogsTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-04-01
 */

/*
 * Define the necessary classes.
 */
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/renderers/'
#    . 'Database_TableRenderer.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/extensions/'
#    . 'HTMLTags_SimpleOLForm.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_Input.inc.php';
    
class
    Logging_ServerLogsTableRenderer
extends
    Database_TableRenderer
{
    public function
        get_log_file_adding_form()
    {
        $log_file_adding_form = new HTMLTags_SimpleOLForm('csv_adding');
        
        $log_file_adding_form->set_attribute_str('enctype', 'multipart/form-data');
                
        $legend_text = 'Add a log file';
        
        $log_file_adding_form->set_legend_text($legend_text);
        
        /*
         * THE FILE
         */
        $file_input_tag = new HTMLTags_Input();
        
        $file_input_tag_name = 'user_file[]';
        
        $file_input_tag->set_attribute_str('type', 'file');
        $file_input_tag->set_attribute_str('id', $file_input_tag_name);
        $file_input_tag->set_attribute_str('name', $file_input_tag_name);
        
        $log_file_adding_form->add_input_tag(
            $file_input_tag_name,
            $file_input_tag,
            'File'
        );
        
        $log_file_adding_form->add_hidden_input('MAX_FILE_SIZE', '1000000');
        
        $log_file_adding_form->set_submit_text('Add');
        
        return $log_file_adding_form;
    }
}
?>
