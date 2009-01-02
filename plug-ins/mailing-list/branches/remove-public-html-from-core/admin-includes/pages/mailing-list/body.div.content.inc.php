<?php
/**
 * The content of the mailing list admin page for
 * the mailing list plug-in.
 *
 * @copyright Clear Line Web Design, 2007-03-05
 */

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Get the database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$people_table = $database->get_table('hpi_mailing_list_people');
$people_table_renderer = $people_table->get_renderer();

/*
 * Cloned repeatedly throughout.
 */
$current_page_url
	= Admin_AdminIncluderURLFactory
		::get_url('plug-ins', 'mailing-list', 'mailing-list', 'html');

#$redirect_script_url = new HTMLTags_URL();
#$redirect_script_url->set_file('/admin/');
#$redirect_script_url->set_get_variable('type', 'redirect-script');
#$redirect_script_url->set_get_variable('module', 'mailing-list');
#$redirect_script_url->set_get_variable('page', 'mailing-list');

$redirect_script_url 
	= Admin_AdminIncluderURLFactory
		::get_url('plug-ins', 'mailing-list', 'mailing-list', 'redirect-script');

$redirect_script_url->set_get_variable('return_to', urlencode($current_page_url->get_as_string()));

#$cancel_href = new HTMLTags_URL();
#$cancel_href->set_file('/admin/mailing-list/mailing-list.html');

$cancel_href = clone $redirect_script_url;
$cancel_href->set_get_variable('cancel');
$cancel_href->set_get_variable('return_to', urlencode($current_page_url->get_as_string()));

if (isset($_GET['delete_id'])) {
    /**
     * Confirm deleting a row.
     */
    $row = $people_table->get_row_by_id($_GET['delete_id']);
    
    $question_p = new HTMLTags_P();
    
    $question_p->set_attribute_str('class', 'question');
    
    $question_p->append_str_to_content(
        'Are you sure that you want to delete this person?'
    );
    
    $content_div->append_tag_to_content($question_p);
    
    /**
     * Show the user the data in the row.
     */
    $row_renderer = $row->get_renderer();
    
    $content_div->append_tag_to_content($row_renderer->get_admin_people_html_table());
    
    # ------------------------------------------------------------------
    
    $answer_p = new HTMLTags_P();
    
    $answer_p->set_attribute_str('class', 'answer');
    
    $delete_link = new HTMLTags_A('DELETE');
    
#    $delete_href = new HTMLTags_URL();
#    
#    $delete_href->set_file('/admin/redirect-script.php');
#    
#    $delete_href->set_get_variable('module', 'mailing-list');
#    $delete_href->set_get_variable('type', 'redirect-script');
#    $delete_href->set_get_variable('page', 'mailing-list');

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
	/*
	 * Row editing.
	 */
	$person_row = $people_table->get_row_by_id($_GET['edit_id']);
	$person_row_renderer = $person_row->get_renderer();

	$row_editing_form = $person_row_renderer->get_person_editing_form(
		$redirect_script_url,
		$cancel_href
	);
	
	$content_div->append_tag_to_content($row_editing_form); 
} elseif (isset($_GET['add_row'])) {
	/*
	 * Row Adding.
	 */
	$row_adding_form = $people_table_renderer->get_person_adding_form(
		$redirect_script_url,
		$cancel_href
	);

	$content_div->append_tag_to_content($row_adding_form);
} else {

    /**
     * LAST ACTION BOX DIV
     *
     */
        if (isset($_GET['last_deleted_id']) || isset($_GET['last_edited_id']) || isset($_GET['last_added_id'])) {
           
           if (isset($_GET['last_deleted_id'])) {
                $message = 'Deleted person id: ' . $_GET['last_deleted_id'];
           }
           elseif (isset($_GET['last_edited_id'])) {
                $message = 'Edited person id: ' . $_GET['last_edited_id'];
           }
           elseif (isset($_GET['last_added_id'])) {
                $message = 'Added person id: ' . $_GET['last_added_id'];
           }
           $last_error_box_div
               = new HTMLTags_LastActionBoxDiv(
                   $message, 
                   #'/admin/mailing-list/mailing-list.html',
		   '#',
                   'message'
               ); 
           $content_div->append_tag_to_content($last_error_box_div);
        }
     
     /**
     * Links to other pages in the admin section.
     */
    
    $page_options_div = new HTMLTags_Div();
    $page_options_div->set_attribute_str('id', 'page-options');
    
    $other_pages_ul = new HTMLTags_UL();

    
    /**
     * Link to the add row form.
     */
    $add_row_li = new HTMLTags_LI();
    
    $add_row_a = new HTMLTags_A('Add new Person');
    
#    $add_row_href = new HTMLTags_URL();
#    
#    $add_row_href->set_file('/admin/');
#    
#    $add_row_href->set_get_variable('module', 'mailing-list');
#    $add_row_href->set_get_variable('page', 'mailing-list');

	$add_row_href = clone $current_page_url;

    $add_row_href->set_get_variable('add_row');
    
    $add_row_a->set_href($add_row_href);
    
    $add_row_li->append_tag_to_content($add_row_a);
    
    $other_pages_ul->append_tag_to_content($add_row_li);
    
    /**
     * Link to the delete all confirmation page.
     */
        #$delete_all_li = new HTMLTags_LI();
        #
        #$delete_all_a = new HTMLTags_A('Delete All persons');
        #
        #$delete_all_href = new HTMLTags_URL();
        #
        #$delete_all_href->set_file('/admin/index.php');
        #
        #$delete_all_href->set_get_variable('module', 'photo-gallery');
        #$delete_all_href->set_get_variable('page', 'persons');
        #$delete_all_href->set_get_variable('delete_all');
        #
        #$delete_all_a->set_href($delete_all_href);
        #
        #$delete_all_li->append_tag_to_content($delete_all_a);
        #
        #$other_pages_ul->append_tag_to_content($delete_all_li);
        
    $page_options_div->append_tag_to_content($other_pages_ul);
    
    $content_div->append_tag_to_content($page_options_div);
    
    
    ############################################################################
    #
    # Display some of the data in the table.
    #
    ############################################################################
    
    /*
     * DIV for limits and previous and nexts.
     */
    $limit_previous_next_div = new HTMLTags_Div();
    $limit_previous_next_div->set_attribute_str('class', 'table_pages_div');
    
    /*
     * To allow the user to set the number of extras to show at a time.
     */
    $limit_action = new HTMLTags_URL();
    #$limit_action->set_file('/admin/');
    $limit_action->set_file('/');
    
    $limit_form = new Database_LimitForm($limit_action, LIMIT, '10 20 50');
    
    $limit_form->add_hidden_input('section', 'haddock');
    $limit_form->add_hidden_input('module', 'admin');
    $limit_form->add_hidden_input('page', 'admin-includer');
    $limit_form->add_hidden_input('type', 'html');
    
    $limit_form->add_hidden_input('admin-section', 'plug-ins');
    $limit_form->add_hidden_input('admin-module', 'mailing-list');
    $limit_form->add_hidden_input('admin-page', 'mailing-list');
    
    $limit_form->add_hidden_input('order_by', ORDER_BY);
    $limit_form->add_hidden_input('direction', DIRECTION);
    $limit_form->add_hidden_input('offset', OFFSET);
    
    $limit_previous_next_div->append_tag_to_content($limit_form);
    
    /*
     * Go the previous or next list of extras.
     */
#    $previous_next_url = new HTMLTags_URL();
#    $previous_next_url->set_file('/admin/');
#    
#    $previous_next_url->set_get_variable('module', 'mailing-list');
#    $previous_next_url->set_get_variable('page', 'mailing-list');
	$previous_next_url = clone $current_page_url;
	    
    $previous_next_url->set_get_variable('order_by', ORDER_BY);
    $previous_next_url->set_get_variable('direction', DIRECTION);
    
    #print_r($previous_next_url);
    
    $row_count = $people_table->count_all_rows();
    
    #echo "\$row_count: $row_count\n";
    
    $previous_next_ul = new Database_PreviousNextUL(
        $previous_next_url,
        OFFSET,
        LIMIT,
        $row_count
    );
    
    $limit_previous_next_div->append_tag_to_content($previous_next_ul);
    
    $content_div->append_tag_to_content($limit_previous_next_div);
    
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
        'The People'
    );
    $rows_html_table->append_tag_to_content($caption);
    
    /**
     * The Heading Row.
     */
#    $sort_href = new HTMLTags_URL();
#    $sort_href->set_file('/admin/');
#    
#    $sort_href->set_get_variable('module', 'mailing-list');
#    $sort_href->set_get_variable('page', 'mailing-list');
	$sort_href = clone $current_page_url;
	    
    $sort_href->set_get_variable('limit', LIMIT);
    
    $heading_row = new Database_SortableHeadingTR($sort_href, DIRECTION);
    
    $field_names = explode(' ', 'added name email status');

    foreach ($field_names as $field_name) {
        $heading_row->append_sortable_field_name($field_name);
    }
    
    foreach (
        $people_table_renderer->get_admin_database_action_ths()
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
    $rows = $people_table->get_all_rows(ORDER_BY, DIRECTION, OFFSET, LIMIT);	
	 
    foreach ($rows as $row) {
	    $edit_location = clone $current_page_url;
	    $delete_location = clone $current_page_url;

        $row_renderer = $row->get_renderer();
        
        #$data_tr = $row_renderer->get_admin_database_tr();
        $data_tr = $row_renderer->get_admin_people_html_table_tr(
		$edit_location,	
		$delete_location
	);
        
        $rows_html_table->append_tag_to_content($data_tr);
    }
    
    # ------------------------------------------------------------------
    
    $content_div->append_tag_to_content($rows_html_table);
    
    $content_div->append_tag_to_content($limit_previous_next_div);
}

echo $content_div->get_as_string();    
?>
