<?php
/**
 * Database_ChoiceFieldRenderer
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

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Option.inc.php';

/**
 * A class to provide methods for rendering
 * short text fields.
 */
class
    Database_ChoiceFieldRenderer
extends
    Database_FieldRenderer
{
    public function render_admin_row_adding_form_td()
    {
        $field = $this->get_element();
        
        echo "<td>\n";
        
        echo '<select name="' . $field->get_name() . "\">\n";
        
        $options = $field->get_options();
        
        foreach ($options as $option) {
            echo "<option value=\"$option\"";
            
            if ($field->get_default() == $option) {
                echo ' selected';
            }
            
            echo ">$option</option>\n";
        }
        
        echo "</select>\n";
        echo "</td>\n";
    }
    
    public function render_row_adding_form_input()
    {
        $field = $this->get_element();
        
        echo '<select name="' . $field->get_name() . "\">\n";
        
        $options = $field->get_options();
        
        foreach ($options as $option) {
            echo "<option value=\"$option\"";
            
            if ($field->get_default() == $option) {
                echo ' selected';
            }
            
            echo ">$option</option>\n";
        }
        
        echo "</select>\n";
    }
    
    public function
        get_form_input()
    {
        $field = $this->get_element();
        
        $row_adding_form_input = new HTMLTags_Select();
        
        $row_adding_form_input->set_attribute_str('name', $field->get_name());
        $row_adding_form_input->set_attribute_str('id', $field->get_name());
        
        $options = $field->get_options();
        
        foreach ($options as $option) {
            $row_adding_form_option = new HTMLTags_Option($option);
            $row_adding_form_option->set_attribute_str('value', $option);
            
            if ($field->get_default() == $option) {
                $row_adding_form_option->set_attribute_str('selected');
            }
            
            $row_adding_form_input->add_option($row_adding_form_option);
        }
        
        return $row_adding_form_input;
    }
    
    public function render_admin_row_update_form_td($id)
    {
        $field = $this->get_element();
        
        $table = $field->get_table();
        
        $row = $table->get_row_by_id($id);
        
        echo "<td>\n";
        
        echo '<select name="' . $field->get_name() . "\">\n";
        
        $options = $field->get_options();
        
        foreach ($options as $option) {
            echo "<option value=\"$option\"";
            
            if ($row->get($field->get_name()) == $option) {
                echo ' selected';
            }
            
            echo ">$option</option>\n";
        }
        
        echo "</select>\n";
        echo "</td>\n";
    }
}
?>
