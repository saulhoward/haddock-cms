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
 * Fetch the XML file manager.
 */
$xml_db_page_manager = $gvm->get('xml_db_page_manager');

/*
 * Fetch the database objects.
 */
$table = $xml_db_page_manager->get_table();
$table_renderer = $table->get_renderer();

/*
 * Create the HTML tags objects.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Creating the URL objects.
 */
$current_page_url = new HTMLTags_URL();
$current_page_url->set_file('/');

foreach (array_keys($_GET) as $get_key) {
	if (!in_array($get_key, explode(' ', 'error all_rows_deleted last_added_id last_deleted_id last_edited_id'))) {
		$current_page_url->set_get_variable($get_key, $_GET[$get_key]);
	}
}

$redirect_script_url = clone $current_page_url;

$redirect_script_url->set_get_variable('type', 'redirect-script');

$cancel_href = clone $redirect_script_url;
$cancel_href->set_get_variable('cancel');

/*
 * Show last action messages or errors.
 */

$last_action_box_div = NULL;

if (isset($_GET['last_added_id'])) {
	$last_action_box_div = new HTMLTags_LastActionBoxDiv(
		$xml_db_page_manager->get_last_added_message($table, $_GET['last_added_id'])
	);
}

if (isset($_GET['last_edited_id'])) {
	$last_action_box_div = new HTMLTags_LastActionBoxDiv(
		$xml_db_page_manager->get_last_edited_message(
			$table,
			$_GET['last_edited_id']
		)
	);
}

if (isset($_GET['last_deleted_id'])) {
	$last_action_box_div = new HTMLTags_LastActionBoxDiv(
		$xml_db_page_manager->get_last_deleted_message($table, $_GET['last_deleted_id'])
	);
}

if (isset($_GET['all_rows_deleted'])) {
	$last_action_box_div = new HTMLTags_LastActionBoxDiv(
		$xml_db_page_manager->get_all_rows_deleted_message($table)
	);
}

if (isset($_GET['error'])) {
	$last_action_box_div = new HTMLTags_LastActionBoxDiv(
		urldecode($_GET['error'])
	);
}

if (isset($last_action_box_div)) {
	$content_div->append_tag_to_content($last_action_box_div);
}

########################################################################
#
# Forms for changing the contents of the database.
#
########################################################################
    
if (isset($_GET['delete_all'])) {
	/*
	 * Confirm deleting all the rows in the table.
	 */
	$question_delete_all_p 
		= new HTMLTags_P($xml_db_page_manager->get_delete_all_rows_question());
	
	$content_div->append_tag_to_content($question_delete_all_p);

	$confirm_delete_all_p = new HTMLTags_P();
	$confirm_delete_all_p->set_attribute_str('class', 'center');

	$delete_all_href = clone $redirect_script_url;        
	$delete_all_href->set_get_variable('delete_all');

	$delete_all_a = new HTMLTags_A($xml_db_page_manager->get_delete_all_rows_link_text());

	$delete_all_a->set_attribute_str('class', 'cool_button');
	$delete_all_a->set_attribute_str('id', 'inline');

	$delete_all_a->set_href($delete_all_href);

	$confirm_delete_all_p->append_tag_to_content($delete_all_a);

	$confirm_delete_all_p->append_str_to_content('&nbsp;');

	$cancel_a = new HTMLTags_A($xml_db_page_manager->get_cancel_link_text());

	$cancel_a->set_attribute_str('class', 'cool_button');
	$cancel_a->set_attribute_str('id', 'inline');

	$cancel_a->set_href($cancel_href);

	$confirm_delete_all_p->append_tag_to_content($cancel_a);

	$content_div->append_tag_to_content($confirm_delete_all_p);
} elseif (isset($_GET['delete_id'])) {
	/*
	 * Confirm deleting a row.
	 */
	$row = $table->get_row_by_id($_GET['delete_id']);

	$question_p = new HTMLTags_P();

	$question_p->set_attribute_str('class', 'question');

	$question_p->append_str_to_content($xml_db_page_manager->get_delete_row_question());

	$content_div->append_tag_to_content($question_p);

	/*
	 * Show the user the data in the row.
	 */
	$content_div->append_tag_to_content(
		$xml_db_page_manager->get_delete_row_render_div($row)
	);
# Move to xml_db_page_manager->get_delete_row_render_div()
#	$row_renderer = $row->get_renderer();
#
#	$row_renderer_reflection_object = new ReflectionObject($row_renderer);
#	$render_method 
#		= $row_renderer_reflection_object
#			->getMethod(
#				$xml_db_page_manager->get_delete_row_render_method_name()
#			);
#	$content_div->append_tag_to_content(
#		$render_method->invoke($row_renderer)
#	);	

	# ------------------------------------------------------------------

	$answer_p = new HTMLTags_P();

	$answer_p->set_attribute_str('class', 'answer');

	$delete_link = new HTMLTags_A($xml_db_page_manager->get_delete_row_link_text());

	$delete_href = clone $redirect_script_url;
	$delete_href->set_get_variable('delete_id', $row->get_id());

	$delete_link->set_href($delete_href);

	$delete_link->set_attribute_str('class', 'cool_button');
	$delete_link->set_attribute_str('id', 'inline');

	$answer_p->append_tag_to_content($delete_link);

	$cancel_link = new HTMLTags_A($xml_db_page_manager->get_cancel_link_text());

	$cancel_link->set_href($cancel_href);

	$cancel_link->set_attribute_str('class', 'cool_button');
	$cancel_link->set_attribute_str('id', 'inline');

	$answer_p->append_tag_to_content($cancel_link);

	$content_div->append_tag_to_content($answer_p);
} elseif (isset($_GET['edit_id'])) {
	/*
	 * Row editing.
	 */
	$row = $table->get_row_by_id($_GET['edit_id']);

	$row_editing_action = clone $redirect_script_url;
	$row_editing_action->set_get_variable('edit_id', $row->get_id());

	$row_editing_form = 
		$xml_db_page_manager
			->get_row_editing_form(
				$row,
				$row_editing_action,
				$cancel_href
			);
# Move to xml_db_page_manager->get_row_editing_form
#	$row_editing_form->set_action($row_editing_action);
#
#	$row_editing_form->set_legend_text($xml_db_page_manager->get_edit_form_legend_text(), $row);
#
#	$row_editing_form->set_submit_text($xml_db_page_manager->get_edit_form_submit_text());
#
#	$row_editing_form->set_cancel_location($cancel_href);
#	
#	$row_editing_form->set_cancel_text($xml_db_page_manager->get_cancel_button_text());

	$content_div->append_tag_to_content($row_editing_form);
} elseif (isset($_GET['add_row'])) {
	/*
	 * Row Adding.
	 */
	$row_adding_action = clone $redirect_script_url;
	$row_adding_action->set_get_variable('add_row');

	$row_adding_form
		= $xml_db_page_manager->get_row_adding_form(
			$table,
			$row_adding_action,
			$cancel_href
		);

	$content_div->append_tag_to_content($row_adding_form);
} else {
	/*
	 * Links to other pages in the admin section.
	 */
	if ($xml_db_page_manager->has_pre_list_items()) {
		$other_pages_ul = new HTMLTags_UL();
		
		/*
		 * Link to the add row form.
		 */
		if ($xml_db_page_manager->has_add_row_pre_list_link()) {
			$add_row_li = new HTMLTags_LI();

			$add_row_a 
				= new HTMLTags_A(
					$xml_db_page_manager->get_add_a_row_link_text()
				);

			$add_row_href = clone $current_page_url;
			$add_row_href->set_get_variable('add_row');

			$add_row_a->set_href($add_row_href);

			$add_row_li->append_tag_to_content($add_row_a);

			$other_pages_ul->append_tag_to_content($add_row_li);
		}

		/*
		 * Link to the delete all confirmation page.
		 */
		if ($xml_db_page_manager->has_delete_all_rows_pre_list_link()) {
			$delete_all_li = new HTMLTags_LI();

			$delete_all_a = new HTMLTags_A(
				$xml_db_page_manager->get_delete_all_rows_link_text()
			);
			
			$delete_all_href = clone $current_page_url;
			$delete_all_href->set_get_variable('delete_all');

			$delete_all_a->set_href($delete_all_href);

			$delete_all_li->append_tag_to_content($delete_all_a);

			$other_pages_ul->append_tag_to_content($delete_all_li);
		}

		$content_div->append_tag_to_content($other_pages_ul);
	}
	
	####################################################################
	#
	# Display some of the data in the table.
	#
	####################################################################

	/*
	 * DIV for limits and previous and nexts.
	 */
	$limit_previous_next_div = new HTMLTags_Div();
	$limit_previous_next_div->set_attribute_str('class', 'table_pages_div');

	/*
	 * To allow the user to set the number of rows to show at a time.
	 */
	$limit_action = new HTMLTags_URL();
	$limit_action->set_file('/');

	$limit_form = new Database_LimitForm(
		$limit_action, 
		$xml_db_page_manager->get_current_limit(), 
		$xml_db_page_manager->get_available_limits()
	);

	$limit_form->add_hidden_input('section', 'haddock');
	$limit_form->add_hidden_input('module', 'admin');
	$limit_form->add_hidden_input('page', 'admin-includer');
	$limit_form->add_hidden_input('html', 'html');

	$limit_form->add_hidden_input('admin-section', 'haddock');
	$limit_form->add_hidden_input('admin-module', 'database');
	$limit_form->add_hidden_input('admin-page', 'table-xml');
	
	$limit_form->add_hidden_input(
		'db-section', 
		$xml_db_page_manager->get_db_section()
	);
	
	if ($xml_db_page_manager->has_db_module()) {
		$limit_form->add_hidden_input(
			'db-module', 
			$xml_db_page_manager->get_db_module()
		);
	}

	$limit_form->add_hidden_input(
		'db-xml-file', 
		$xml_db_page_manager->get_xml_file_name_stem()
	);

	$limit_form->add_hidden_input(
		'order_by',
		$xml_db_page_manager->get_current_order_by()	
	);

	$limit_form->add_hidden_input(
		'direction', 
		$xml_db_page_manager->get_current_direction()
	);
	
	$limit_form->add_hidden_input(
		'offset', 
		$xml_db_page_manager->get_current_offset()	
	);

	$limit_previous_next_div->append_tag_to_content($limit_form);

	/*
	 * Go the previous or next list of extras.
	 */
	$previous_next_url = clone $current_page_url;

	$previous_next_url->set_get_variable(
		'order_by', 
		$xml_db_page_manager->get_current_order_by()
	);

	$previous_next_url->set_get_variable(
		'direction', 
		$xml_db_page_manager->get_current_direction()
	);

	$row_count = $xml_db_page_manager->get_total_row_count($table);

	$previous_next_ul = new Database_PreviousNextUL(
		$previous_next_url,
		$xml_db_page_manager->get_current_offset(),
		$xml_db_page_manager->get_current_limit(),
		$row_count
	);

	$limit_previous_next_div->append_tag_to_content($previous_next_ul);

	$content_div->append_tag_to_content($limit_previous_next_div);

	# ------------------------------------------------------------------

	/*
	 * The table.
	 */
	$rows_html_table = new HTMLTags_Table();
	$rows_html_table->set_attribute_str('class', 'table_pages');

	/*
	 * The caption.
	 */
	$caption = new HTMLTags_Caption($xml_db_page_manager->get_rows_table_caption($table));
	$rows_html_table->append_tag_to_content($caption);

	/*
	 * The Heading Row.
	 */
	$sort_href = clone $current_page_url;

	$sort_href->set_get_variable('limit', $xml_db_page_manager->get_current_limit());

	$heading_row 
		= new Database_SortableHeadingTR(
			$sort_href,
			$xml_db_page_manager->get_current_direction()
		);

	$heading_row = $xml_db_page_manager->append_column_headings_to_shtr($heading_row);
	
	$heading_row = $xml_db_page_manager->append_actions_to_shtr($heading_row);

	$rows_html_table->append_tag_to_content($heading_row);

	# ------------------------------------------------------------------

	/*
	 * Display the contents of the table.
	 */
	$rows = $xml_db_page_manager->get_rows(
		$table,
		$xml_db_page_manager->get_current_order_by(),
		$xml_db_page_manager->get_current_direction(),
		$xml_db_page_manager->get_current_offset(),
		$xml_db_page_manager->get_current_limit()
	);

	foreach ($rows as $row) {
		$data_tr = new HTMLTags_TR();

		$data_tr = $xml_db_page_manager->append_row_data_tds_to_tr($row, $data_tr);

		$data_tr = $xml_db_page_manager->append_row_action_tds_to_tr($row, $data_tr);

		$rows_html_table->append_tag_to_content($data_tr);
	}

	# ------------------------------------------------------------------

	$content_div->append_tag_to_content($rows_html_table);

	$content_div->append_tag_to_content($limit_previous_next_div);
}

echo $content_div->get_as_string();
?>
