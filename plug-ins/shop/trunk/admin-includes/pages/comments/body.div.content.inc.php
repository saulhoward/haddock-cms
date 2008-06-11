<?php
/**
 * The content of the comments admin page for
 * the shop plug-in.
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

$gvm = Caching_GlobalVarManager::get_instance();

$comments_table = $database->get_table('hpi_shop_comments');
$comments_table_renderer = $comments_table->get_renderer();

/*
 * Cloned repeatedly throughout.
 */
$current_page_url = $gvm->get('current_page_admin_url');
$redirect_script_url = $gvm->get('redirect_script_admin_url');
$cancel_href = $current_page_url;

if (isset($_GET['delete_id'])) {
	/**
	 * Confirm deleting a row.
	 */
	$row = $comments_table->get_row_by_id($_GET['delete_id']);

	$question_p = new HTMLTags_P();

	$question_p->set_attribute_str('class', 'question');

	$question_p->append_str_to_content(
		'Are you sure that you want to delete this comment?'
	);

	$content_div->append_tag_to_content($question_p);

	/**
	 * Show the user the data in the row.
	 */
	$row_renderer = $row->get_renderer();

	$content_div->append_tag_to_content($row_renderer->get_admin_comments_html_table());

	# ------------------------------------------------------------------

	$answer_p = new HTMLTags_P();

	$answer_p->set_attribute_str('class', 'answer');

	$delete_link = new HTMLTags_A('DELETE');

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
	$comment_row = $comments_table->get_row_by_id($_GET['edit_id']);
	$comment_row_renderer = $comment_row->get_renderer();

	$row_editing_url = clone $redirect_script_url;

	$row_editing_form  = $comment_row_renderer->get_comment_editing_form($row_editing_url, $cancel_href);

	$content_div->append_tag_to_content($row_editing_form);

} elseif (isset($_GET['add_row'])) {
	/**
	 * Row Adding.
	 */

	$row_adding_url = clone $redirect_script_url;
	$row_adding_url->set_get_variable('add_comment');

	$row_adding_form  = $comments_table_renderer->get_admin_comment_adding_form($row_adding_url, $cancel_href);

	$content_div->append_tag_to_content($row_adding_form);
} else {

	/**
	 * LAST ACTION BOX DIV
	 *
	 */
	if (isset($_GET['last_deleted_id']) || isset($_GET['last_edited_id']) || isset($_GET['last_added_id'])) {

		if (isset($_GET['last_deleted_id'])) {
			$message = 'Deleted comment id: ' . $_GET['last_deleted_id'];
		}
		elseif (isset($_GET['last_edited_id'])) {
			$comment = $comments_table->get_row_by_id($_GET['last_edited_id']);
			$message = 'Edited ' . $comment->get_commenters_name_with_possessive() . ' comment.';
		}
		elseif (isset($_GET['last_added_id'])) {
			$message = 'Added comment id: ' . $_GET['last_added_id'];
		}
		$last_error_box_div
			= new HTMLTags_LastActionBoxDiv(
				$message, 
				$current_page_url->get_as_string(),
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

	$add_row_a = new HTMLTags_A('Add a comment');

	$add_row_href = clone $current_page_url;
	$add_row_href->set_get_variable('add_row');

	$add_row_a->set_href($add_row_href);

	$add_row_li->append_tag_to_content($add_row_a);

	$other_pages_ul->append_tag_to_content($add_row_li);

	/**
	 * Link to the refresh page.
	 */
	$refresh_page_li = new HTMLTags_LI();
	$refresh_page_a = new HTMLTags_A('Check for new comments');
	$refresh_page_a->set_href($current_page_url);
	$refresh_page_li->append_tag_to_content($refresh_page_a);
	$other_pages_ul->append_tag_to_content($refresh_page_li);


	/**
	 * Link to the delete all confirmation page.
	 */
	#$delete_all_li = new HTMLTags_LI();
	#
	#$delete_all_a = new HTMLTags_A('Delete All comments');
	#
	#$delete_all_href = new HTMLTags_URL();
	#
	#$delete_all_href->set_file('/admin/index.php');
	#
	#$delete_all_href->set_get_variable('module', 'photo-gallery');
	#$delete_all_href->set_get_variable('page', 'comments');
	#$delete_all_href->set_get_variable('delete_all');
	#
	#$delete_all_a->set_href($delete_all_href);
	#
	#$delete_all_li->append_tag_to_content($delete_all_a);
	#
	#$other_pages_ul->append_tag_to_content($delete_all_li);

	$page_options_div->append_tag_to_content($other_pages_ul);

	$content_div->append_tag_to_content($page_options_div);

	/*
	 * -------------------------------------------------------------------------
	 * The comment status selecting form.
	 * -------------------------------------------------------------------------
	 */

	$comment_status_selecting_form = new HTMLTags_Form();

	$comment_status_selecting_form->set_attribute_str('name', 'comment_status_selecting');
	$comment_status_selecting_form->set_attribute_str('method', 'GET');
	$comment_status_selecting_form->set_attribute_str('class', 'table-select-form');

	$comment_status_selecting_action = clone $current_page_url;
//        $comment_status_selecting_action->set_get_variable('status');

	$comment_status_selecting_form->set_action(new HTMLTags_URL('/'));

	$inputs_ol = new HTMLTags_OL();

	/*
	 * Select the status.
	 */
	$status_li = new HTMLTags_LI();

	$status_label = new HTMLTags_Label('Comment Status');
	$status_label->set_attribute_str('for', 'status');

	$status_li->append_tag_to_content($status_label);

	$status_select = new HTMLTags_Select();

	$status_select->set_attribute_str('id', 'status');
	$status_select->set_attribute_str('name', 'status');

//        $possible_status = $status_table->get_all_rows('firm_name', 'ASC');


	$all_statuses_option = new HTMLTags_Option('all');
	$all_statuses_option->set_attribute_str('value', 'all');
	if (isset($_GET['status']))
	{
		if ($_GET['status'] == 'all')
		{
			$all_statuses_option->set_attribute_str('selected');
		}
	}
	$status_select->add_option($all_statuses_option);

	$status_field = $comments_table->get_field('status');
	$possible_statuses = $status_field->get_options();

	foreach ($possible_statuses as $possible_status) {
		$possible_status_option
			= new HTMLTags_Option(
				$possible_status
			);

		$possible_status_option->set_attribute_str(
			'value',
			$possible_status
		);

		if (isset($_GET['status'])) {
			if ($possible_status == $_GET['status']) {
				$possible_status_option->set_attribute_str('selected');
			}
		}
		elseif (!isset($_GET['status']))
		{
			if ($possible_status == 'new') {
				$possible_status_option->set_attribute_str('selected');
			}
		}

		$status_select->add_option($possible_status_option);
	}

	$status_li->append_tag_to_content($status_select);

	$inputs_ol->add_li($status_li);

	/*
	 * The hidden inputs.
	 */

	$comment_status_selecting_action_get_vars = $comment_status_selecting_action->get_get_variables();

	foreach (array_keys($comment_status_selecting_action_get_vars) as $key)
	{
		$form_hidden_input = new HTMLTags_Input();
		$form_hidden_input->set_attribute_str('type', 'hidden');
		$form_hidden_input->set_attribute_str('name', $key);
		$form_hidden_input->set_attribute_str('value', $comment_status_selecting_action_get_vars[$key]);

		$comment_status_selecting_form->append_tag_to_content($form_hidden_input);
	}
	
	/*
	 * The submit button.
	 */
	$go_button_li = new HTMLTags_LI();

	$go_button = new HTMLTags_Input();

	$go_button->set_attribute_str('type', 'submit');
	$go_button->set_attribute_str('value', 'Go');
	$go_button->set_attribute_str('class', 'submit');

	$go_button_li->append_tag_to_content($go_button);

	$inputs_ol->add_li($go_button_li);

	$comment_status_selecting_form->append_tag_to_content($inputs_ol);

	$content_div->append_tag_to_content($comment_status_selecting_form);



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
	$limit_action = clone $current_page_url;

	$limit_form = new Database_LimitForm($limit_action, LIMIT, '10 20 50');

	$limit_form->add_hidden_input('order_by', ORDER_BY);
	$limit_form->add_hidden_input('direction', DIRECTION);
	$limit_form->add_hidden_input('offset', OFFSET);
	if (isset($_GET['status']))
	{
		$limit_form->add_hidden_input('status', $_GET['status']);
	}
	$limit_previous_next_div->append_tag_to_content($limit_form);

	/*
	 * Go the previous or next list of extras.
	 */
	$previous_next_url = clone $current_page_url;
	$previous_next_url->set_get_variable('order_by', ORDER_BY);
	$previous_next_url->set_get_variable('direction', DIRECTION);
	if (isset($_GET['status']))
	{
		$previous_next_url->set_get_variable('status', $_GET['status']);
	}
	#print_r($previous_next_url);

	$row_count = $comments_table->count_all_rows();

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
	
	if (isset($_GET['status']))
	{

		if ($_GET['status'] == 'moderation')
		{
			$caption = new HTMLTags_Caption('Comments in Moderation');
		}
		else
		{
			$caption = new HTMLTags_Caption(
				ucfirst($_GET['status']) . ' Comments'
			);
		}

		if ($_GET['status'] == 'all')
		{
			$caption->append_str_to_content(
				' (' . $comments_table->count_comments() . ')'
			);
		}
		else
		{

			$caption->append_str_to_content(
				' (' . $comments_table->count_comments_for_status($_GET['status']) . ')'
			);
		}
	}
	else
	{
		$caption = new HTMLTags_Caption(
			'New Comments'
		);

		$caption->append_str_to_content(
			' (' . $comments_table->count_comments_for_status('new') . ')'
		);
	}
	$rows_html_table->append_tag_to_content($caption);

	/**
	 * The Heading Row.
	 */
	$sort_href = clone $current_page_url;
	$sort_href->set_get_variable('limit', LIMIT);

	$heading_row = new Database_SortableHeadingTR($sort_href, DIRECTION);

	$field_names = explode(' ', 'added modified status front_page');

	foreach ($field_names as $field_name) {
		$heading_row->append_sortable_field_name($field_name);
	}

	$product_header = new HTMLTags_TH('Product');
	$heading_row->append_tag_to_content($product_header);

	$name_header = new HTMLTags_TH('Name');
	$heading_row->append_tag_to_content($name_header);

	$comment_header = new HTMLTags_TH('Comment');
	$heading_row->append_tag_to_content($comment_header);

	$actions_header = new HTMLTags_TH('Actions');
	$actions_header->set_attribute_str('colspan', '4');
	$heading_row->append_tag_to_content($actions_header);


//        foreach (
//                $comments_table_renderer->get_admin_database_action_ths()
//                as
//                $action_th
//        ) {
//                $heading_row->append_tag_to_content($action_th);
//        }

	$rows_html_table->append_tag_to_content($heading_row);

	# ------------------------------------------------------------------

	/**
	 * Display the contents of the table.
	 */
	#$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'id';
	#$direction = isset($_GET['direction']) ? $_GET['direction'] : 'ASC';
	#$table_renderer->render_all_data_table($order_by, $direction);
	if (isset($_GET['status']))
	{
		if ($_GET['status'] == 'all')
		{
			$rows = $comments_table->get_all_rows(ORDER_BY, DIRECTION, OFFSET, LIMIT);
		}
		else
		{
			$conditions = array();
			$conditions['status'] = $_GET['status'];
			$rows = $comments_table->get_rows_where($conditions, ORDER_BY, DIRECTION, OFFSET, LIMIT);
		}
	}
	else
	{
		$conditions = array();
		$conditions['status'] = 'new';
		$rows = $comments_table->get_rows_where($conditions, ORDER_BY, DIRECTION, OFFSET, LIMIT);
	}

	foreach ($rows as $row) {
		$row_renderer = $row->get_renderer();

		#$data_tr = $row_renderer->get_admin_database_tr();
		$redirect_script_url_with_status = clone $redirect_script_url;
		if (isset($_GET['status']))
		{
			$redirect_script_url_with_status->set_get_variable('status', $_GET['status']);
		}
		$data_tr = $row_renderer->get_admin_comments_html_table_tr(
			$current_page_url, $redirect_script_url_with_status
		);

		$rows_html_table->append_tag_to_content($data_tr);
	}

	# ------------------------------------------------------------------

	$content_div->append_tag_to_content($rows_html_table);

	$content_div->append_tag_to_content($limit_previous_next_div);
}

echo $content_div->get_as_string();    
?>
