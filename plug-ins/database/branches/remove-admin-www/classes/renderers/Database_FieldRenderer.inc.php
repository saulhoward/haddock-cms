<?php
/**
 * Database_FieldRenderer
 *
 * @copyright Clear Line Web Design, 2006-11-18
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/'
#    . 'Database_Renderer.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_Input.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_TD.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_DT.inc.php';
#    
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_DD.inc.php';
    
/**
 * A class to provide methods for rendering
 * fields from a database.
 */
class
    Database_FieldRenderer
extends
    Database_Renderer
{
    public function render_th()
    {
        $field = $this->get_element();
        echo '<th>' . $field->get_name() . "</th>\n";
    }
    
    public function render_all_data_table_th($ordered_by, $current_sort_direction)
    {
        $field = $this->get_element();
        $table = $field->get_table();
        
        echo '<th';
        if ($field->get_name() == $ordered_by) {
            echo ' id="ordered-by"';
        }
        echo ">\n";
        
        $next_sort_direction = $current_sort_direction == 'ASC' ? 'DESC' : 'ASC';
        
        echo '<a href="'
                . '/admin/index.php?'
                    . 'module=database'
                    . '&page=table'
                    . '&table=' . $table->get_name()
                    . '&order_by=' . $field->get_name()
                    . "&direction=$next_sort_direction"
            . '">';
        echo $field->get_name();
        echo "</a>\n";
        
        echo "</th>\n";
    }
    
    public function render_row_adding_form_input()
    {
        $field = $this->get_element();
        
        echo '<input ';
        
        echo ' type="text" ';
        echo ' name="' . $field->get_name() . '" ';
        
        if ($field->has_default()) {
            echo ' value="' . $field->get_default() . '" ';
        }
        
        echo " />\n";
    }
    
    public function get_form_input()
    {
        $field = $this->get_element();
        
        $row_adding_form_input = new HTMLTags_Input();
        
        $row_adding_form_input->set_attribute_str('type', 'text');
        $row_adding_form_input->set_attribute_str('name', $field->get_name());
        $row_adding_form_input->set_attribute_str('id', $field->get_name());
        
        if ($field->has_default()) {
            $row_adding_form_input->set_attribute_str('value', $field->get_default());
        }
        
        return $row_adding_form_input;
    }
    
    public function render_admin_row_adding_form_td()
    {
        $field = $this->get_element();
        
        echo "<td>\n";
        
        echo '<input ';
        
        echo ' type="text" ';
        echo ' name="' . $field->get_name() . '" ';
        
        if ($field->has_default()) {
            echo ' value="' . $field->get_default() . '" ';
        }
        
        echo " />\n";
        
        echo "</td>\n";
    }
    
    public function render_admin_row_update_form_td($id)
    {
        $field = $this->get_element();
        
        $table = $field->get_table();
        
        $row = $table->get_row_by_id($id);
        
        echo "<td>\n";
        
        echo '<input ';
        
        echo ' type="text" ';
        echo ' name="' . $field->get_name() . '" ';

        echo ' value="' . $row->get($field->get_name()) . '" ';
        
        echo " />\n";
        
        echo "</td>\n";
    }
    
    /**
     * The default doesn't do much,
     * the methods that override this in the subclasses
     * will do the work.
     */
    public function
        get_data_html_table_td($value)
    {
        #echo "Entered Database_FieldRenderer::get_data_html_table_td('$value')\n";
        //echo "Entered Database_FieldRenderer::get_data_html_table_td(...)\n";
        #exit;
        
        return new HTMLTags_TD($value);
    }
    
    public function
        get_html_tags_dt()
    {
        $dt = new HTMLTags_DT();
        
        $field = $this->get_element();
        
        $field_name_l_o_w = Formatting_ListOfWords
            ::get_list_of_words_for_string($field->get_name(), '_');
        
        $dt->append_str_to_content(
            $field_name_l_o_w->get_words_as_capitalised_string()
        );
        
        return $dt;
    }
    
    public function
        get_html_tags_dd($value)
    {
        #echo "\$value: $value\n";
        
        $dd = new HTMLTags_DD(
            $this->get_display_str($value)
        );
        
        #print_r($dd);
        
        return $dd;
    }
    
    public function
        get_display_str($value)
    {
        return $value;
    }
}

?>
