<?php
/**
 * Database_TableRenderer
 *
 * @copyright Clear Line Web Design, 2006-09-17
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_Renderer.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/database/classes/html-tags/'
    . 'Database_AddRowOLForm.inc.php';
/**
 * A class to help rendering a database table.
 */
class
    Database_TableRenderer
extends
    Database_Renderer
{   
    ##################################################
    # Rendering the HTML tables in the admin section #
    ##################################################
    
    public function
        render_all_data_table_header($ordered_by = 'id', $current_sort_direction = 'ASC')
    {
        $table = $this->get_element();
        
        echo "<tr>\n";
        
        $fields = $table->get_fields();
        #print_r($fields);
        
        foreach ($fields as $field) {
            $field_renderer = $field->get_renderer();
            $field_renderer->render_all_data_table_th($ordered_by, $current_sort_direction);
        }
        
        echo "<th colspan=\"2\">Actions</th>\n";
        
        echo "</tr>\n";
    }
    
    public function render_all_data_table($order_by = 'id', $direction = 'ASC')
    {
        $table = $this->get_element();
        
        echo "<table>\n";
        
        # Print of the Field Names.
        $this->render_all_data_table_header($order_by, $direction);
        
        # Print the contents
        $rows = $table->get_all_rows($order_by, $direction);
        #print_r($rows);
        
        #counter for render_table_row odd/even   
        $counter = 0;
        foreach ($rows as $row) {
            #print_r($row);
            
            $row_renderer = $row->get_renderer();
            
            #print_r($row_renderer);
            
            $row_renderer->render_table_row(($counter % 2) == 0);
                $counter++;
        }
        
        
        echo "</table>\n";
    }
    
    /**
     * The form used to add a new row to the table.
     *
     * Think of ways to share more functionality
     * with RowRenderer::render_table_row.
     */
    public function render_row_adding_form()
    {
        $table = $this->get_element();
        
        $fields = $table->get_fields();
        
        echo "<table>\n";
        
        # The header row
        echo "<tr>\n";
        
        foreach ($fields as $field) {
            if ($field->get_name() != 'id') {
                $field_renderer = $field->get_renderer();
                $field_renderer->render_th();
            }
        }
        
        echo "<th colspan=\"2\">Actions</th>\n";
        echo "</tr>\n";
?>
<form
    name="row_adding"
    <?php echo 'action="/admin/index.php?module=database&page=table&table=' . $table->get_name() . "&add_new_row=1\"\n"; ?>
    method="POST"
>
    <tr>
<?php    
        foreach ($fields as $field) {
            if ($field->get_name() != 'id') {
                #print_r($field);
                
                $field_renderer = $field->get_renderer();
                $field_renderer->render_admin_row_adding_form_td();
            }
        }
        
        # The add button
?>
        <td>
            <input type="submit" class="submit" value="Add" />
        </td>

        <td>
            <input
                type="button"
                class="submit"
                value="Cancel"
                onclick="document.location.href='/admin/index.php?module=database&page=table&table=<?php echo $table->get_name(); ?>'"
            />
        </td>
    </tr>
</form>
<?php
        echo "</table>\n";
    }
    
    public function
        get_row_adding_form(
            HTMLTags_URL $row_adding_action,
            HTMLTags_URL $cancel_href
        )
    {
        $table = $this->get_element();
        
        $row_adding_form = new Database_AddRowOLForm($table->get_name());
        
        $row_adding_form->set_action($row_adding_action);
        
        $row_adding_form->set_legend_text('Add a row.');
        
        $row_adding_form->set_submit_text('Add');
        
        $row_adding_form->set_cancel_location($cancel_href);
        
        return $row_adding_form;
    }
    
    public function
        get_admin_database_selection_html_table(
            $order_by,
            $direction,
            $offset,
            $limit,
            $url = NULL,
            $sortable_fields_str = NULL,
            $caption = NULL,
            $actions_method_name = NULL,
            $actions_methods_args = NULL
        )
    {
        if (!isset($url)) {
            $url = $this->get_admin_page_url();
        }
        
        $table = $this->get_element();
        
        $field_objs = array();
        
        if (isset($sortable_fields_str)) {
            foreach (explode(' ', $sortable_fields_str) as $field_str) {
                $field_objs[] = $table->get_field($field_str);
            }
        } else {
            $field_objs = $table->get_fields();
        }
        
        $fields = array();
        foreach ($field_objs as $field_obj) {
            $field['sortable'] = TRUE;
            
            $field['name'] = $field_obj->get_name();
            
            $field['method'] = 'get_data_html_table_td';
            
            $method_args = array();
            $method_args[] = $field_obj;
            $field['method_args'] = $method_args;
            
            $fields[] = $field;
        }
        
        if (isset($actions_method_name)) {
            $renderer_reflection_object = new ReflectionObject($this);
            
            if (
                $renderer_reflection_object->hasMethod($actions_method_name)
            ) {
                $actions_reflection_method
                    = $renderer_reflection_object
                        ->getMethod($actions_method_name);
                if (isset($actions_methods_args)) {
                    $actions = $actions_reflection_method->invokeArgs($this, $actions_methods_args);
                } else {
                    $actions = $actions_reflection_method->invoke($this);
                }
            } else {
                throw new Exception(
                    sprintf(
                        'No method called "%s" in class "%s"!',
                        $actions_method_name,
                        $renderer_reflection_object->getName()
                    )
                );
            }
        } else {
            $actions = array();
    
            $edit_action['th'] = new HTMLTags_TH('Edit');
            $edit_action['method'] = 'get_admin_database_tr_action_edit_td';
    
            $actions[] = $edit_action;
    
            $delete_action['th'] = new HTMLTags_TH('Delete');
            $delete_action['method'] = 'get_admin_database_tr_action_delete_td';
    
            $actions[] = $delete_action;
        }
        #print_r($actions);
        
        if (!isset($caption)) {
            $caption = 'Data in the ' . $table->get_name() . ' table';
        }
        
        return new Database_SelectionHTMLDiv(
            $url,
            $table,
            $order_by,
            $direction,
            $offset,
            $limit,
            $limit_str = '10 20 50',
            $caption,
            'table_pages_div',
            'table_pages',
            $fields,
            $actions
        );
    }
    
    /*
     * ----------------------------------------
     * Methods to do with action THs for data HTML tables.
     * ----------------------------------------
     */
    
    public function
        get_admin_database_action_ths()
    {
        //$ths = array();
        //
        //$ths[] = new HTMLTags_TH('Edit');
        //$ths[] = new HTMLTags_TH('Delete');
        //
        //return $ths;
        return $this->get_action_ths('edit delete');
    }
    
    public function
        get_action_ths($actions_str)
    {
        $ths = array();
        
        foreach (explode(' ', $actions_str) as $action_str) {
            $ths[]
                = $this->get_action_th($action_str);
        }
        
        return $ths;
    }
    
    public static function
        get_action_th($action_str)
    {
        $title_low
                = Formatting_ListOfWords
                    ::get_list_of_words_for_string($action_str);
            
        return new HTMLTags_TH(
            $title_low->get_words_as_capitalised_string()
        );
    }
    
    /*
     * ----------------------------------------
     * Functions to do with admin section URLs
     * ----------------------------------------
     */
    
    protected function
        get_admin_url()
    {
        $admin_url = new HTMLTags_URL();
        
        $admin_url->set_file('/');
        
        $admin_url->set_get_variable('section', 'haddock');
        $admin_url->set_get_variable('module', 'admin');
        $admin_url->set_get_variable('page', 'admin-includer');
        
        $admin_url->set_get_variable('admin-section', 'haddock');
        $admin_url->set_get_variable('admin-module', 'database');
        $admin_url->set_get_variable('admin-page', 'table');
        
        $table = $this->get_element();
        
        $admin_url->set_get_variable('table', $table->get_name());
        
        return $admin_url;
    }
    
    public function
        get_admin_page_url()
    {
        $admin_page_url = $this->get_admin_url();
        
        $admin_page_url->set_get_variable('type', 'html');
        
        return $admin_page_url;
    }
    
    public function
        get_admin_redirect_script_url()
    {
        $admin_redirect_script_url = $this->get_admin_url();
        
        $admin_redirect_script_url->set_get_variable('type', 'redirect-script');
        
        return $admin_redirect_script_url;
    }
    
    public function
        get_admin_add_row_form_url()
    {
        $admin_add_row_form_url = $this->get_admin_page_url();
        
        $admin_add_row_form_url->set_get_variable('add_row');
        
        return $admin_add_row_form_url;
    }
    
    public function
        get_admin_add_row_redirect_script_url()
    {
        $admin_add_row_form_url = $this->get_admin_redirect_script_url();
        
        $admin_add_row_form_url->set_get_variable('add_row');
        
        return $admin_add_row_form_url;
    }
    
    public function
        get_admin_delete_all_confimation_page_url()
    {
        $admin_delete_all_confimation_page_url = $this->get_admin_page_url();
        
        $admin_delete_all_confimation_page_url->set_get_variable('delete_all');
        
        return $admin_delete_all_confimation_page_url;
    }

    public function
        get_admin_delete_all_redirect_script_url()
    {
        $admin_delete_all_redirect_script_url
            = $this->get_admin_redirect_script_url();
        
        $admin_delete_all_redirect_script_url->set_get_variable('delete_all');
        
        return $admin_delete_all_redirect_script_url;
    }
}

?>
