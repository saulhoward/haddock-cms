<?php
/**
 * Database_EditRowOLForm
 *
 * @copyright Clear Line Web Design, 2006-12-02
 */

#require_once PROJECT_ROOT
#    . '/haddock/database/classes/html-tags/'
#    . 'Database_RowOLForm.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/elements/'
#    . 'Database_Row.inc.php';

class
    Database_EditRowOLForm
extends
    Database_RowOLForm
{
    private $row;
    
    public function
        __construct(
            Database_Row $row
        )
    {
        $this->row = $row;
        
        $table = $row->get_table();
        
        $form_name = $table->get_name() . '_editing';
        
        parent::__construct($table, $form_name);
        
        $this->add_hidden_input('id', $this->row->get_id());
    }
    
    public function
        add_hidden_fields_str($hidden_fields_str)
    {
        foreach (explode(' ', $hidden_fields_str) as $hidden_field) {
            $this->add_hidden_input(
                $hidden_field,
                $this->row->get($hidden_field)
            );
        }
    }
    
    public function
        get_input_lis()
    {
        $input_lis = array();
        
        $visible_fields = $this->get_visible_fields();
        
        $row_renderer = $this->row->get_renderer();
        
        foreach ($visible_fields as $visible_field) {
            $input_li = new HTMLTags_LI();
            
            $l_t_l_o_ws
                = Formatting_ListOfWordsHelper
                    ::get_list_of_words_for_string(
                        $visible_field->get_name(),
                        '_'
                    );
                
            $label_text = $l_t_l_o_ws->get_words_as_capitalised_string();
            
            $input_label = new HTMLTags_Label($label_text);
            $input_label->set_attribute_str(
                'for',
                $visible_field->get_name()
            );
            
            #$input_label->set_attribute_str('id', $name);
            
            $input_li->append_tag_to_content($input_label);
            
            #$field_renderer = $visible_field->get_renderer();
            #
            #$input_tag = $field_renderer->get_form_input();
            #
            #echo '$visible_field->get_name(): ' . $visible_field->get_name() . "\n";
            #
            #$input_tag->set_value(
            #    $this->row->get($visible_field->get_name())
            #);
            
            $input_tag = $row_renderer->get_input_tag_for_field($visible_field);
            
            $input_li->append_tag_to_content($input_tag);
            
            $input_lis[] = $input_li;
        }
        
        return $input_lis;
    }
}
?>