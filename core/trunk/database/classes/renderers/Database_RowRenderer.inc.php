<?php
/**
 * Database_RowRenderer
 *
 * @copyright Clear Line Web Design, 2006-09-17
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_Renderer.inc.php';
    
/**
 * Renders rows from a database.
 *
 * Uses the reflection API to match table fields
 * with Row subclass methods.
 */
class
    Database_RowRenderer
extends
    Database_Renderer
{       
    public function
        get_admin_database_tr()
    {
        $data_row =  new HTMLTags_TR();
        
        $row = $this->get_element();
        
        $table = $row->get_table();
        
        $fields = $table->get_fields();
        
        //echo 'count($fields): ' . "\n";
        //echo count($fields) . "\n";
        
        //foreach ($fields as $field) {
        for ($i = 0; $i < count($fields); $i++) {
            $field = $fields[$i];
            
            //echo 'count($fields): ' . "\n";
            //echo count($fields) . "\n";
            //
            //echo "\$i: $i\n";
            
            //if ($field->get_name() == 'id') {
            //    continue;
            //}
            //
            //if ($field->get_name() == 'file_type') {
            //    continue;
            //}

            //if ($field->get_name() == 'image') {
            //    continue;
            //}
            
            //echo '$field->get_name(): ';
            //echo $field->get_name() . "\n";
            
            #$field_td = new HTMLTags_TD($row->get($field->get_name()));
            $field_td = $this->get_data_html_table_td($field);
            
            //echo "Returned to Database_RowRenderer::get_admin_database_tr()\n";
            #exit;
            
            $data_row->append_tag_to_content($field_td);
            
            //echo "Returned to Database_RowRenderer::get_admin_database_tr()\n";
            #exit;
            
            //echo "\n";
        }
        
        //echo "Got past field loop\n";
        #exit;
        
        foreach ($this->get_admin_database_tr_action_tds() as $action_td) {
            $data_row->append_tag_to_content($action_td);
        }
        
        return $data_row;
    }
    
    public function
        get_admin_database_tr_action_tds()
    {
        $tds[] = $this->get_admin_database_tr_action_edit_td();
        $tds[] = $this->get_admin_database_tr_action_delete_td();
        
        return $tds;
    }
    
    public function
        get_admin_database_tr_action_edit_td()
    {
        $row = $this->get_element();
        
        $table = $row->get_table();
        
        $edit_td = new HTMLTags_TD();
        
        $edit_link = new HTMLTags_A('Edit');
        $edit_link->set_attribute_str('class', 'cool_button');
        
#        $edit_location = new HTMLTags_URL();
#        
#        $edit_location->set_file('/admin/index.php');
#        
#        $edit_location->set_get_variable('module', 'database');
#        $edit_location->set_get_variable('page', 'table');
	$edit_location = Admin_AdminIncluderURLFactory::get_url('haddock', 'database', 'table', 'html');
        $edit_location->set_get_variable('table', $table->get_name());
        
        $edit_location->set_get_variable('edit_id', $row->get_id());
        
        $edit_link->set_href($edit_location);
        
        $edit_td->append_tag_to_content($edit_link);
        
        return $edit_td;
    }
    
    public function
        get_admin_database_tr_action_delete_td()
    {
        $row = $this->get_element();
        
        $table = $row->get_table();
        
        $delete_td = new HTMLTags_TD();
        
        $delete_link = new HTMLTags_A('Delete');
        $delete_link->set_attribute_str('class', 'cool_button');
        
        #$delete_location = new HTMLTags_URL();
        
#        $delete_location->set_file('/admin/index.php');
#        
#        $delete_location->set_get_variable('module', 'database');
#        $delete_location->set_get_variable('page', 'table');
	$delete_location = Admin_AdminIncluderURLFactory::get_url('haddock', 'database', 'table', 'html');
        $delete_location->set_get_variable('table', $table->get_name());
        
        $delete_location->set_get_variable('delete_id', $row->get_id());
        
        $delete_link->set_href($delete_location);
        
        $delete_td->append_tag_to_content($delete_link);
        
        return $delete_td;
    }
    
    public function
        get_all_data_html_table()
    {
        $all_data_html_table = new HTMLTags_Table();
        
        $row = $this->get_element();
        
        $table = $row->get_table();
        
        $fields = $table->get_fields();
        
        $heading_row = new HTMLTags_TR();
        
        foreach ($fields as $field) {
            $heading_row->append_tag_to_content(new HTMLTags_TH($field->get_name()));
        }
        
        $all_data_html_table->append_tag_to_content($heading_row);
        
        $data_row = new HTMLTags_TR();
        
        foreach ($fields as $field) {
            #$field_td = new HTMLTags_TD($row->get($field->get_name()));
            $field_td = $this->get_data_html_table_td($field);
            
            $data_row->append_tag_to_content($field_td);
        }
        
        $all_data_html_table->append_tag_to_content($data_row);
        
        return $all_data_html_table;
    }
    
    public function
        get_input_tag_for_field(Database_Field $field)
    {
        $row = $this->get_element();
        
        $field_renderer = $field->get_renderer();
        
        $input_tag = $field_renderer->get_form_input();
        
        try {
            $input_tag->set_value(
                $row->get($field->get_name())
            );
        } catch (HTMLTags_ValueNotSetInSelectException $e) {
            /*
             * This happens when the current value is not
             * in the list of options for a select.
             *
             * e.g. time fields that have the default
             * options of '0000-00-00 00:00:00' and 'NOW()'
             * but not the value from the row.
             */
            if (is_a($input_tag, 'HTMLTags_Select')) {
                $current_option = new HTMLTags_Option(
                    $row->get($field->get_name())
                );
                
                $current_option->set_attribute_str(
                    'value',
                    $row->get($field->get_name())
                );
                
                $input_tag->add_option($current_option);
                
                $input_tag->set_value(
                    $row->get($field->get_name())
                );
            } else {
                $msg = <<<MSG
HTMLTags_ValueNotSetInSelectException
thrown by an object that is not a
HTMLTags_Select!
MSG;

                throw new Exception($msg);
            }
        }
        
        return $input_tag;
    }
    
    public function
        get_data_html_table_td(Database_Field $field)
    {
        //echo "Entered Database_RowRenderer::get_data_html_table_td(...)\n";
        #exit;
        
        $row = $this->get_element();
        
        $field_renderer = $field->get_renderer();
        
        //echo 'get_class($field_renderer): ' . "\n";
        //echo get_class($field_renderer) . "\n";
        
        #$data_html_table_td = new HTMLTags_TD($row->get($field->get_name()));
        $data_html_table_td
            = $field_renderer->get_data_html_table_td(
                $row->get($field->get_name())
            );
        
        //echo "Returned to Database_RowRenderer::get_data_html_table_td(...)\n";
        #exit;
        
        return $data_html_table_td;
    }

	public function
		get_data_html_table_td_str($field_name)
	{
		$row = $this->get_element();

		$table = $row->get_table();

		$field = $table->get_field($field_name);

		return $this->get_data_html_table_td($field);
	}

    public function
        get_all_fields_dl(
            $ignore_fields_str = 'id',
            $include_zero_length_fields = FALSE
        )
    {
        $all_fields_dl = new HTMLTags_DL();
        
        $row = $this->get_element();
        
        $table = $row->get_table();
        
        $fields = $table->get_fields();
        
        $ignore_fields_array = explode(' ', $ignore_fields_str);
        
        foreach ($fields as $field) {
            if (!in_array($field->get_name(), $ignore_fields_array)) {
                $value = $row->get($field->get_name());
                #$value = $this->get_display_str($field->get_name());
                #$cell = $row->get_cell($field->get_name());
                
                if ((strlen($value) > 0) || $include_zero_length_fields) {
                #if ($cell->is_value_set() || $include_zero_length_fields) {
                    $field_renderer = $field->get_renderer();
                    
                    #echo $field->get_name() . "\n";
                    #print_r($field_renderer);
                    
                    $field_dt = $field_renderer->get_html_tags_dt();
                    
                    $all_fields_dl->append_tag_to_content($field_dt);
                    
                    #$cell_renderer = $cell->get_renderer();
                    #
                    #$cell_dd
                    #    = $cell_renderer
                    #        ->get_html_tags_dd($value);
                    #
                    #$all_fields_dl->append_tag_to_content($cell_dd);
                    
                    $field_dd
                        = $field_renderer
                            ->get_html_tags_dd($value);
                    
                    #print_r($field_dd);
                    
                    $all_fields_dl->append_tag_to_content($field_dd);
                }
            }
        }
        
        return $all_fields_dl;
    }
    
    public function
        get_display_str($field_name)
    {
        $row = $this->get_element();
        
        $value = $row->get($field_name);
        
        $table = $row->get_table();
        
        $field = $table->get_field($field_name);
        
        $field_renderer = $field->get_renderer();
        
        return $field_renderer->get_display_str($value);
    }
    
    public function
        get_row_editing_form()
    {
        $row = $this->get_element();
        
        return new Database_EditRowOLForm($row);
    }
}
?>
