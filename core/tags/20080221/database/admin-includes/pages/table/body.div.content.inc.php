<?php
/**
 * The page for managing tables.
 *
 * @copyright Clear Line Web Design, 2006-09-17
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();

/*
 * Fetch the database objects.
 */
$table = $gvm->get('table');  
$table_renderer = $table->get_renderer();

/*
 * Create the HTML tags objects.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Creating the URL objects.
 */
$redirect_script_url = Admin_AdminIncluderURLFactory::get_url('haddock', 'database', 'table', 'redirect-script');
$redirect_script_url->set_get_variable('table', $table->get_name());

$cancel_href = Admin_AdminIncluderURLFactory::get_url('haddock', 'database', 'table', 'redirect-script');
$cancel_href->set_get_variable('table', $table->get_name());
$cancel_href->set_get_variable('cancel');
 
    ########################################################################
    #
    # Forms for changing the contents of the database.
    #
    ########################################################################
    
    if (isset($_GET['delete_all'])) {
        /**
         * Confirm deleting all the rows in the table.
         */
        $question_delete_all_p = new HTMLTags_P('Are you sure that you want to delete all the rows in this table?');
        $content_div->append_tag_to_content($question_delete_all_p);
        
        $confirm_delete_all_p = new HTMLTags_P();
        $confirm_delete_all_p->set_attribute_str('class', 'center');
        
#        $delete_all_href = new HTMLTags_URL();
#        
#        $delete_all_href->set_file('/admin/redirect-script.php');
#        
#        $delete_all_href->set_get_variable('module', 'database');
#        $delete_all_href->set_get_variable('page', 'table');
#        $delete_all_href->set_get_variable('table', $_GET['table']);
	$delete_all_href = clone $redirect_script_url;        
        $delete_all_href->set_get_variable('delete_all');
        
        $delete_all_a = new HTMLTags_A('DELETE ALL');
        
        $delete_all_a->set_attribute_str('class', 'cool_button');
        $delete_all_a->set_attribute_str('id', 'inline');
        
        $delete_all_a->set_href($delete_all_href);
        
        $confirm_delete_all_p->append_tag_to_content($delete_all_a);
        
        $confirm_delete_all_p->append_str_to_content('&nbsp;');
        
        $cancel_a = new HTMLTags_A('Cancel');
        
        $cancel_a->set_attribute_str('class', 'cool_button');
        $cancel_a->set_attribute_str('id', 'inline');
        
        $cancel_a->set_href($cancel_href);
        
        $confirm_delete_all_p->append_tag_to_content($cancel_a);
        
        $content_div->append_tag_to_content($confirm_delete_all_p);
    } elseif (isset($_GET['delete_id'])) {
        /**
         * Confirm deleting a row.
         */
        $row = $table->get_row_by_id($_GET['delete_id']);
        
        $question_p = new HTMLTags_P();
        
        $question_p->set_attribute_str('class', 'question');
        
        $question_p->append_str_to_content('Are you sure that you want to delete this row?');
        
        $content_div->append_tag_to_content($question_p);
        
        /**
         * Show the user the data in the row.
         */
        $row_renderer = $row->get_renderer();
        
        $content_div->append_tag_to_content($row_renderer->get_all_data_html_table());
        
        # ------------------------------------------------------------------
        
        $answer_p = new HTMLTags_P();
        
        $answer_p->set_attribute_str('class', 'answer');
        
        $delete_link = new HTMLTags_A('DELETE');
        
#        $delete_href = new HTMLTags_URL();
#        
#        $delete_href->set_file('/admin/redirect-script.php');
#        
#        $delete_href->set_get_variable('module', 'database');
#        $delete_href->set_get_variable('page', 'table');
#        $delete_href->set_get_variable('table', $table->get_name());
	$delete_href = clone $redirect_script_url;
        $delete_href->set_get_variable('delete_id', $row->get_id());
        
        $delete_link->set_href($delete_href);
        
        $delete_link->set_attribute_str('class', 'cool_button');
        $delete_link->set_attribute_str('id', 'inline');
        
        $answer_p->append_tag_to_content($delete_link);
        
        $cancel_link = new HTMLTags_A('Cancel');
        
        $cancel_link->set_href($cancel_href);
        
        $cancel_link->set_attribute_str('class', 'cool_button');
        $cancel_link->set_attribute_str('id', 'inline');
        
        $answer_p->append_tag_to_content($cancel_link);
        
        $content_div->append_tag_to_content($answer_p);
    } elseif (isset($_GET['edit_id'])) {
        /**
         * Row editing.
         */
        $row = $table->get_row_by_id($_GET['edit_id']);
        
        $row_editing_form = new Database_EditRowOLForm($row);
        
#        $row_editing_action = new HTMLTags_URL();
#        
#        $row_editing_action->set_file('/admin/redirect-script.php');
#        
#        $row_editing_action->set_get_variable('module', 'database');
#        $row_editing_action->set_get_variable('page', 'table');
#        $row_editing_action->set_get_variable('table', $table->get_name());
	$row_editing_action = clone $redirect_script_url;
        $row_editing_action->set_get_variable('edit_id', $row->get_id());
    
        $row_editing_form->set_action($row_editing_action);
        
        $row_editing_form->set_legend_text('Edit row ' . $row->get_id());
        
        $row_editing_form->set_submit_text('Update');
        
        $row_editing_form->set_cancel_location($cancel_href);
        
        $content_div->append_tag_to_content($row_editing_form);
    } elseif (isset($_GET['add_row'])) {
        /**
         * Row Adding.
         */
#        $row_adding_action = new HTMLTags_URL();
        
#        $row_adding_action->set_file('/admin/redirect-script.php');
#        
#        $row_adding_action->set_get_variable('module', 'database');
#        $row_adding_action->set_get_variable('page', 'table');
#        $row_adding_action->set_get_variable('table', $table->get_name());
	$row_adding_action = clone $redirect_script_url;
        $row_adding_action->set_get_variable('add_row');
        
        $row_adding_form
            = $table_renderer->get_row_adding_form(
                $row_adding_action,
                $cancel_href
            );
        
        $content_div->append_tag_to_content($row_adding_form);
    } else {
        //echo "Listing some of the rows of the table.\n";
        #exit;
        
        /*
         * Links to other pages in the admin section.
         */
        
        $other_pages_ul = new HTMLTags_UL();
        
        /**
         * Link back to the table list.
         */
        $tables_list_li = new HTMLTags_LI();
        
        $tables_list_a = new HTMLTags_A('Tables List');
        
        $tables_list_href = new HTMLTags_URL();
        $tables_list_href->set_file('/admin/hc/database/tables-list.html');
        
        $tables_list_a->set_href($tables_list_href);
        
        $tables_list_li->append_tag_to_content($tables_list_a);
        
        $other_pages_ul->append_tag_to_content($tables_list_li);
        
        /**
         * Link to the add row form.
         */
        $add_row_li = new HTMLTags_LI();
        
        $add_row_a = new HTMLTags_A('Add Row');
        
#        $add_row_href = new HTMLTags_URL();
#        
#        $add_row_href->set_file('/admin/index.php');
#        
#        $add_row_href->set_get_variable('module', 'database');
#        $add_row_href->set_get_variable('page', 'table');

	$add_row_href = Admin_AdminIncluderURLFactory::get_url('haddock', 'database', 'table', 'html');
        $add_row_href->set_get_variable('table', $table->get_name());
        $add_row_href->set_get_variable('add_row');
        
        $add_row_a->set_href($add_row_href);
        
        $add_row_li->append_tag_to_content($add_row_a);
        
        $other_pages_ul->append_tag_to_content($add_row_li);
        
        /**
         * Link to the delete all confirmation page.
         */
        $delete_all_li = new HTMLTags_LI();
        
        $delete_all_a = new HTMLTags_A('Delete All');
        
#        $delete_all_href = new HTMLTags_URL();
#        
#        $delete_all_href->set_file('/admin/index.php');
#        
#        $delete_all_href->set_get_variable('module', 'database');
#        $delete_all_href->set_get_variable('page', 'table');
	$delete_all_href = Admin_AdminIncluderURLFactory::get_url('haddock', 'database', 'table', 'html');
        $delete_all_href->set_get_variable('table', $table->get_name());
        $delete_all_href->set_get_variable('delete_all');
        
        $delete_all_a->set_href($delete_all_href);
        
        $delete_all_li->append_tag_to_content($delete_all_a);
        
        $other_pages_ul->append_tag_to_content($delete_all_li);
        
        $content_div->append_tag_to_content($other_pages_ul);
        
        ####################################################################
        #
        # Display some of the data in the table.
        #
        ####################################################################
        
        //echo $content_div->get_as_string();
        //exit;
        //
        //echo "About to show the data.\n";
        
        /*
         * DIV for limits and previous and nexts.
         */
        $limit_previous_next_div = new HTMLTags_Div();
        $limit_previous_next_div->set_attribute_str('class', 'table_pages_div');
        
        /*
         * To allow the user to set the number of extras to show at a time.
         */
        $limit_action = new HTMLTags_URL();
#        $limit_action->set_file('/admin/index.php');
        $limit_action->set_file('/');

        $limit_form = new Database_LimitForm($limit_action, LIMIT, '10 20 50');
        
        $limit_form->add_hidden_input('section', 'haddock');
        $limit_form->add_hidden_input('module', 'admin');
        $limit_form->add_hidden_input('page', 'admin-includer');
        $limit_form->add_hidden_input('html', 'html');

        $limit_form->add_hidden_input('admin-section', 'haddock');
        $limit_form->add_hidden_input('admin-module', 'database');
        $limit_form->add_hidden_input('admin-page', 'table');

        $limit_form->add_hidden_input('table', $_GET['table']);
        
        $limit_form->add_hidden_input('order_by', ORDER_BY);
        $limit_form->add_hidden_input('direction', DIRECTION);
        $limit_form->add_hidden_input('offset', OFFSET);
        
        $limit_previous_next_div->append_tag_to_content($limit_form);
        
        /*
         * Go the previous or next list of extras.
         */
#        $previous_next_url = new HTMLTags_URL();
#        $previous_next_url->set_file('/admin/index.php');
#        
#        $previous_next_url->set_get_variable('module', 'database');
#        $previous_next_url->set_get_variable('page', 'table');
	$previous_next_url = Admin_AdminIncluderURLFactory::get_url('haddock', 'database', 'table', 'html');
	$previous_next_url->set_get_variable('table', $_GET['table']);
        
        $previous_next_url->set_get_variable('order_by', ORDER_BY);
        $previous_next_url->set_get_variable('direction', DIRECTION);
        
        #print_r($previous_next_url);
        
        $row_count = $table->count_all_rows();
        
        #echo "\$row_count: $row_count\n";
        
        $previous_next_ul = new Database_PreviousNextUL(
            $previous_next_url,
            OFFSET,
            LIMIT,
            $row_count
        );
        
        $limit_previous_next_div->append_tag_to_content($previous_next_ul);
        
        $content_div->append_tag_to_content($limit_previous_next_div);
        
        //echo $content_div->get_as_string();
        //exit;
        //
        //echo "About to show the data.\n";
        
        # ------------------------------------------------------------------
        
        /**
         * The table.
         */
        $rows_html_table = new HTMLTags_Table();
        $rows_html_table->set_attribute_str('class', 'table_pages');
        
        /**
         * The caption.
         */
        $caption = new HTMLTags_Caption(
            'Data in the ' . $table->get_name() . ' table'
        );
        $rows_html_table->append_tag_to_content($caption);
        
        /**
         * The Heading Row.
         */
	$sort_href = Admin_AdminIncluderURLFactory::get_url('haddock', 'database', 'table', 'html');
        $sort_href->set_get_variable('table', $table->get_name());
        
        $sort_href->set_get_variable('limit', LIMIT);
        
        $heading_row = new Database_SortableHeadingTR($sort_href, DIRECTION);
        
        $fields = $table->get_fields();
        
        foreach ($fields as $field) {
            $heading_row->append_sortable_field_name($field->get_name());
        }
        
        foreach (
            $table_renderer->get_admin_database_action_ths()
            as
            $action_th
        ) {
            $heading_row->append_tag_to_content($action_th);
        }
        
        $rows_html_table->append_tag_to_content($heading_row);
        
        # ------------------------------------------------------------------
        
        /**
         * Display the contents of the table.
         */
        #$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'id';
        #$direction = isset($_GET['direction']) ? $_GET['direction'] : 'ASC';
        #$table_renderer->render_all_data_table($order_by, $direction);
        $rows = $table->get_all_rows(ORDER_BY, DIRECTION, OFFSET, LIMIT);
        
        foreach ($rows as $row) {
            $row_renderer = $row->get_renderer();
            
            $data_tr = $row_renderer->get_admin_database_tr();
            
            $rows_html_table->append_tag_to_content($data_tr);
        }
        
        # ------------------------------------------------------------------
        
        $content_div->append_tag_to_content($rows_html_table);
        
        $content_div->append_tag_to_content($limit_previous_next_div);
    }

echo $content_div->get_as_string();
?>
