<?php
/**
 * Database_TimeFieldRenderer
 *
 * @copyright Clear Line Web Design, 2006-09-21
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/renderers/'
    . 'Database_FieldRenderer.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Select.inc.php';
    
/**
 * A class to provide methods for rendering
 * short text fields.
 */
class
    Database_TimeFieldRenderer
extends
    Database_FieldRenderer
{
    public function render_admin_row_adding_form_td()
    {
        $field = $this->get_element();
        
        echo "<td>\n";
        
        echo '<select name="' . $field->get_name() . "\">\n";
        
        echo "<option value=\"0000-00-00 00:00:00\" selected>0000-00-00 00:00:00</option>\n";
        echo "<option value=\"NOW()\">NOW()</option>\n";
        
        echo "</select>\n";
        echo "</td>\n";
    }
    
    public function
        get_form_input()
    {
        $field = $this->get_element();
        
        $row_adding_form_input = new HTMLTags_Select();
        
        $row_adding_form_input->set_attribute_str(
            'name',
            $field->get_name()
        );
        $row_adding_form_input->set_attribute_str(
            'id',
            $field->get_name()
        );
        
        $zero_option = new HTMLTags_Option('0000-00-00 00:00:00');
        $zero_option->set_attribute_str(
            'value',
            '0000-00-00 00:00:00'
        );
        $zero_option->set_attribute_str('selected');
        
        $row_adding_form_input->add_option($zero_option);
        
        $now_option = new HTMLTags_Option('NOW()');
        $now_option->set_attribute_str('value', 'NOW()');
        
        $row_adding_form_input->add_option($now_option);
        
        #echo '$field->get_default(): ' . $field->get_default() . "\n";
        
        #$row_adding_form_input->set_value(
        #    $field->get_default()
        #    #'0000-00-00 00:00:00'
        #);
        
        return $row_adding_form_input;
    }
    
    public function render_admin_row_update_form_td($id)
    {
        $field = $this->get_element();
        
        $table = $field->get_table();
        
        $row = $table->get_row_by_id($id);
        
        echo "<td>\n";
        
        echo '<select name="' . $field->get_name() . "\">\n";
        
        echo "<option value=\"" . $row->get($field->get_name()) . "\" selected>" . $row->get($field->get_name()) . "</option>\n";
        echo "<option value=\"0000-00-00 00:00:00\">0000-00-00 00:00:00</option>\n";
        echo "<option value=\"NOW()\">NOW()</option>\n";
        
        echo "</select>\n";
        echo "</td>\n";
    }
}
?>
