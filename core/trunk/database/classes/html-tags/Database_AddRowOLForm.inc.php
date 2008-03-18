<?php
/**
 * Database_AddRowOLForm
 *
 * @copyright Clear Line Web Design, 2006-12-02
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/html-tags/'
    . 'Database_RowOLForm.inc.php';

class
    Database_AddRowOLForm
extends
    Database_RowOLForm
{
    public function
        __construct($table_name)
    {
        $mysql_user_factory
            = Database_MySQLUserFactory::get_instance();
        $mysql_user = $mysql_user_factory->get_for_this_project();
        $database = $mysql_user->get_database();
        
        $table = $database->get_table($table_name);
        
        $form_name = $table_name . '_adding';
        
        parent::__construct($table, $form_name);
    }
    
    public function
        add_hidden_fields_str($hidden_fields_str)
    {
        $table = $this->get_table();
        
        foreach (explode(' ', $hidden_fields_str) as $hidden_field) {
            $field = $table->get_field($hidden_field);
            $this->add_hidden_input($hidden_field, $field->get_default());
        }
    }
    
    public function
        get_input_lis()
    {
        $input_lis = array();
        
        $visible_fields = $this->get_visible_fields();
        
        foreach ($visible_fields as $visible_field) {
            if ($visible_field->get_name() != 'id') {
                $input_li = new HTMLTags_LI();
                
                $l_t_l_o_ws
                    = Formatting_ListOfWordsHelper
                        ::get_list_of_words_for_string($visible_field->get_name(), '_');
                
                $label_text = $l_t_l_o_ws->get_words_as_capitalised_string();
                
                $input_label = new HTMLTags_Label($label_text);
                $input_label->set_attribute_str('for', $visible_field->get_name());
                #$input_label->set_attribute_str('id', $visible_field->get_name());
                
                $input_li->append_tag_to_content($input_label);
                
                $field_renderer = $visible_field->get_renderer();
                
                $input_tag = $field_renderer->get_form_input();
                
                #print_r($visible_field);
                
                if ($visible_field->has_default()) {
                    $input_tag->set_value(
                        $visible_field->get_default()
                    );
                }
                
                $input_li->append_tag_to_content($input_tag);
                
                $input_lis[] = $input_li;
            }
        }
        
        return $input_lis;
    }
}
?>
