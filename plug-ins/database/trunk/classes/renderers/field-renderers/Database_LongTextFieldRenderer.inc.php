<?php
/**
 * Database_LongTextFieldRenderer
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
    . 'HTMLTags_TextArea.inc.php';

/**
 * A class to provide methods for rendering
 * long text fields.
 */
class
    Database_LongTextFieldRenderer
extends
    Database_FieldRenderer
{
    public function
        render_row_adding_form_input()
    {
        $field = $this->get_element();
?>
<textarea
    cols="20"
    rows="3"
    name="<?php echo $field->get_name(); ?>"
></textarea>
<?php
    }
    
    public function get_form_input()
    {
        $field = $this->get_element();
        
        $row_adding_form_input = new HTMLTags_TextArea();
        
        $row_adding_form_input->set_attribute_str('cols', 50);
        $row_adding_form_input->set_attribute_str('rows', 7);
        $row_adding_form_input->set_attribute_str('name', $field->get_name());
        $row_adding_form_input->set_attribute_str('id', $field->get_name());
        
        return $row_adding_form_input;
    }
    
    public function render_admin_row_adding_form_td()
    {
        $field = $this->get_element();
        
        echo "<td>\n";
?>
<textarea
    cols="20"
    rows="3"
    name="<?php echo $field->get_name(); ?>"
></textarea>
<?php
        echo "</td>\n";
    }
    
    public function render_admin_row_update_form_td($id)
    {
        $field = $this->get_element();
        
        $table = $field->get_table();
        
        $row = $table->get_row_by_id($id);
        
        echo "<td>\n";
?>
<textarea
    cols="20"
    rows="3"
    name="<?php echo $field->get_name(); ?>"
><?php echo $row->get($field->get_name()); ?></textarea>
<?php
        echo "</td>\n";
    }
}
?>
