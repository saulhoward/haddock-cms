<?php
/**
 * Database_SelectionHTMLDiv
 *
 * @copyright Clear Line Web Design, 2007-09-20
 */

class
	Database_SelectionHTMLDiv
extends
    HTMLTags_Div
{
    public function
        __construct(
            HTMLTags_URL $url,
            Database_Table $table,
            $order_by,
            $direction,
            $offset,
            $limit,
            $limit_str,
            $rows_html_table_caption,
            $lpnd_class,
            $data_table_class,
            $fields,
            $actions
        )
    {
        parent::__construct();
        
        $table_renderer = $table->get_renderer();
        
        /*
         * ----------------------------------------
         * Check the inputs.
         * ----------------------------------------
         */
        
        /*
         * ----------------------------------------
         * Create the content.
         * ----------------------------------------
         */
        $limit_previous_next_div = new HTMLTags_Div();
        $limit_previous_next_div->set_attribute_str('class', $lpnd_class);
        
        /*
         * To allow the user to set the number of extras to show at a time.
         */
                
        $limit_action = clone $url;
        
        $limit_action->delete_all_get_variables();
        
        $limit_form = new Database_LimitForm($limit_action, $limit, $limit_str);
        
        $get_vars = $url->get_get_variables();
        
        foreach (array_keys($get_vars) as $key) {
            $limit_form->add_hidden_input($key, $get_vars[$key]);
        }

        $limit_form->add_hidden_input('order_by', $order_by);
        $limit_form->add_hidden_input('direction', $direction);
        $limit_form->add_hidden_input('offset', $offset);

        $limit_previous_next_div->append_tag_to_content($limit_form);

        $previous_next_url = clone $url;

        $previous_next_url->set_get_variable('order_by', $order_by);
        $previous_next_url->set_get_variable('direction', $direction);

        $row_count = $table->count_all_rows();

        $previous_next_ul = new Database_PreviousNextUL(
            $previous_next_url,
            $offset,
            $limit,
            $row_count
        );

        $limit_previous_next_div->append_tag_to_content($previous_next_ul);

        $this->append_tag_to_content($limit_previous_next_div);

        # ------------------------------------------------------------------
        
        /*
         * The table.
         */
        $rows_html_table = new HTMLTags_Table();
        $rows_html_table->set_attribute_str('class', $data_table_class);

        /*
         * The caption.
         */
        $caption = new HTMLTags_Caption($rows_html_table_caption);
        $rows_html_table->append_tag_to_content($caption);

        /*
         * The Heading Row.
         */

        $sort_href = clone $url;

        $sort_href->set_get_variable('limit', $limit);

        $heading_row = new Database_SortableHeadingTR($sort_href, $direction);
        
        //if (isset($fields_str)) {
        //    $fields = array();
        //    
        //    foreach (explode(' ', $fields_str) as $field_name) {
        //        $fields[] = $table->get_field($field_name);
        //    }
        //} else {
        //    $fields = $table->get_fields();
        //}
        
        foreach (
            $fields
            as
            $field
        ) {
            if ($field['sortable']) {
                $heading_row->append_sortable_field_name($field['name']);
            } else {
                $heading_row->append_nonsortable_field_name($field['name']);
            }
        }
        
        foreach (
            $actions
            as
            $action
        ) {
            $heading_row->append_tag_to_content($action['th']);
        }

        $rows_html_table->append_tag_to_content($heading_row);

        # ------------------------------------------------------------------

        /*
         * Display the contents of the table.
         */
        $rows = $table->get_all_rows($order_by, $direction, $offset, $limit);
        
        foreach ($rows as $row) {
            $row_renderer = $row->get_renderer();
            
            $data_tr =  new HTMLTags_TR();
            
            foreach (
                $fields
                as
                $field
            ) {
                $field_td
                    = self::get_html_table_cell_for_field(
                        $field,
                        $row_renderer
                    );
                
                $data_tr->append_tag_to_content($field_td);
            }
            
            //foreach (
            //    $row_renderer->get_action_tds(
            //        $actions_str,
            //        $url
            //    )
            //    as
            //    $action_td
            //) {
            //    $data_tr->append_tag_to_content($action_td);
            //}
            foreach ($actions as $action) {
                $action_td
                    = self::get_html_table_cell_for_field(
                        $action,
                        $row_renderer
                    );
                
                $data_tr->append_tag_to_content($action_td);
            }
            
            $rows_html_table->append_tag_to_content($data_tr);
        }

        # ------------------------------------------------------------------

        $this->append_tag_to_content($rows_html_table);
        
        $this->append_tag_to_content($limit_previous_next_div);
    }
    
    private static function
        get_html_table_cell_for_field(
            $spec_hash,
            $renderer
        )
    {
        //echo 'print_r($spec_hash): ' . "\n";
        //print_r($spec_hash);
        
        $renderer_reflection_object
            = new ReflectionObject($renderer);
        
        if (
            $renderer_reflection_object->hasMethod($spec_hash['method'])
        ) {
            $reflection_method
                = $renderer_reflection_object
                    ->getMethod($spec_hash['method']);
            
            if (is_array($spec_hash['method_args'])) {
                return $reflection_method->invokeArgs(
                    $renderer,
                    $spec_hash['method_args']
                );
            } else {
                return $reflection_method->invoke($renderer);
            }
        } else {
            throw new Exception(
                sprintf(
                    'No method called "%s" in class "%s"!',
                    $spec_hash['method'],
                    $renderer_reflection_object->getName()
                )
            );
        }
    }
}
?>
