<?php
/**
 * The content of the product_categories page.
 *
 * From here, the user can
 *
 *  - add a new product_category
 *  - delete a product_category
 *  - Rearrange the sort order of product_categories
 *  - Edit a product_category
 * 
 * @copyright Clear Line Web Design, 2007-02-16
 */

/*
 * Get the database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();

$mysql_user = $mysql_user_factory->get_for_this_project();

$database = $mysql_user->get_database();

$product_categories_table = $database->get_table('hpi_shop_product_categories');

$table_renderer = $product_categories_table->get_renderer();

$gvm = Caching_GlobalVarManager::get_instance();

/*
 * Assemble the HTML
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Cloned repeatedly throughout.
 */
$current_page_url = $gvm->get('current_page_admin_url');
$redirect_script_url = $gvm->get('redirect_script_admin_url');
$cancel_href = $current_page_url;

########################################################################
#
# Forms for changing the contents of the database.
#
########################################################################

if (isset($_GET['delete_all'])) {
	/**
	 * Confirm deleting all the rows in the table.
	 */
	$action_div = new HTMLTags_Div();
	$action_div->set_attribute_str('id', 'action-div');

	$question_delete_all_p 
		= new HTMLTags_P('Are you sure that you want to delete all of the product categories?');
	$action_div->append_tag_to_content($question_delete_all_p);

	$confirm_delete_all_p = new HTMLTags_P();

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
	$action_div->append_tag_to_content($confirm_delete_all_p);
	$content_div->append_tag_to_content($action_div);

} elseif (isset($_GET['delete_id'])) {
	/**
	 * Confirm deleting a row.
	 */
	$row = $product_categories_table->get_row_by_id($_GET['delete_id']);

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
	$row = $product_categories_table->get_row_by_id($_GET['edit_id']);

	$row_editing_form = new Database_EditRowOLForm($row);

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
	#$row_adding_action = new HTMLTags_URL();
	#
	#$row_adding_action->set_file('/admin/redirect-script.php');

	#$row_adding_action->set_get_variable('module', 'shop');
	#$row_adding_action->set_get_variable('page', 'product_categories');
	#$row_adding_action->set_get_variable('table', $product_categories_table->get_name());
	#$row_adding_action->set_get_variable('add_row');
	$row_adding_url = clone $redirect_script_url;
	$row_adding_url->set_get_variable('add_row');

	$row_adding_form = $table_renderer->get_product_category_adding_form($row_adding_url, $cancel_href);

	$content_div->append_tag_to_content($row_adding_form);

	$explanation_div = new HTMLTags_Div();

	$explanation_text = <<<TXT
Each product category has a different shipping price associated with it.
TXT;
	$explanation_div->append_tag_to_content(new HTMLTags_P($explanation_text));

	$content_div->append_tag_to_content($explanation_div);
} else {

	/**
	 * LAST ACTION BOX DIV
	 *
	 */
	if (isset($_GET['last_deleted_id']) 
		|| isset($_GET['last_edited_id']) 
			|| isset($_GET['last_added_id']) 
				|| isset($_GET['deleted_all'])) 
	{

		if (isset($_GET['last_deleted_id'])) {
			$message = 'Deleted product_category id: ' . $_GET['last_deleted_id'];
		}
		elseif (isset($_GET['last_edited_id'])) {
			$message = 'Edited product_category id: ' . $_GET['last_edited_id'];
		}
		elseif (isset($_GET['last_added_id'])) {
			$message = 'Added product_category id: ' . $_GET['last_added_id'];
		}
		elseif (isset($_GET['deleted_all'])) {

			if ($_GET['deleted_all'] == 'successful')
			{
				$message = 'Succesfully deleted 
					all of your product categories! 
					(Not really - feature disabled)';
			}
			else
			{
				$message = 'Failed to delete all of your product categories.';
			}
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

	$add_row_a = new HTMLTags_A('Add New Product Category');

	$add_row_href = clone $current_page_url;
	$add_row_href->set_get_variable('add_row');

	$add_row_a->set_href($add_row_href);

	$add_row_li->append_tag_to_content($add_row_a);

	$other_pages_ul->append_tag_to_content($add_row_li);

	/**
	 * Link to the delete all confirmation page.
	 */
	$delete_all_li = new HTMLTags_LI();

	$delete_all_a = new HTMLTags_A('Delete All Product Categories');

	$delete_all_href = clone $current_page_url;
	$delete_all_href->set_get_variable('delete_all');

	$delete_all_a->set_href($delete_all_href);

	$delete_all_li->append_tag_to_content($delete_all_a);

	$other_pages_ul->append_tag_to_content($delete_all_li);
	$page_options_div->append_tag_to_content($other_pages_ul);

	$content_div->append_tag_to_content($page_options_div);


	####################################################################
	#
	# Display some of the data in the table.
	#
	####################################################################

//	/*
//	 * DIV for limits and previous and nexts.
//	 */
//	$limit_previous_next_div = new HTMLTags_Div();
//	$limit_previous_next_div->set_attribute_str('class', 'table_pages_div');
//
//	/*
//	 * To allow the user to set the number of extras to show at a time.
//	 */
//	$limit_action = clone $current_page_url;
//
//	$limit_form = new Database_LimitForm($limit_action, LIMIT, '10 20 50');
//
////        $limit_form->add_hidden_input('module', 'shop');
////        $limit_form->add_hidden_input('page', 'product-categories');
//
//	$limit_form->add_hidden_input('order_by', ORDER_BY);
//	$limit_form->add_hidden_input('direction', DIRECTION);
//	$limit_form->add_hidden_input('offset', OFFSET);
//
//	$limit_previous_next_div->append_tag_to_content($limit_form);
//
//	/*
//	 * Go the previous or next list of extras.
//	 */
//	$previous_next_url = clone $current_page_url;
//	$previous_next_url->set_get_variable('order_by', ORDER_BY);
//	$previous_next_url->set_get_variable('direction', DIRECTION);
//
//	#print_r($previous_next_url);
//
//	$row_count = $product_categories_table->count_all_rows();
//
//	#echo "\$row_count: $row_count\n";
//
//	$previous_next_ul = new Database_PreviousNextUL(
//		$previous_next_url,
//		OFFSET,
//		LIMIT,
//		$row_count
//	);
//
//	$limit_previous_next_div->append_tag_to_content($previous_next_ul);
//
//	$content_div->append_tag_to_content($limit_previous_next_div);
//
//	# ------------------------------------------------------------------
//
//	/**
//	 * The table.
//	 */
//	$rows_html_table = new HTMLTags_Table();
//	$rows_html_table->set_attribute_str('class', 'table_pages');
//
//	/**
//	 * The caption.
//	 */
//	$caption = new HTMLTags_Caption(
//		'Product Categories'
//	);
//	$rows_html_table->append_tag_to_content($caption);
//
//	/**
//	 * The Heading Row.
//	 */
//	$sort_href = clone $current_page_url;
//	$sort_href->set_get_variable('limit', LIMIT);
//
//	$heading_row = new Database_SortableHeadingTR($sort_href, DIRECTION);
//
//	#$fields = $product_categories_table->get_fields();
//	#
//	#foreach ($fields as $field) {
//	#    $heading_row->append_sortable_field_name($field->get_name());
//	#}
//
//	$field_names = explode(' ', 'name description sort_order');
//
//	foreach ($field_names as $field_name) {
//		$heading_row->append_sortable_field_name($field_name);
//	}
//
//	foreach (
//		$table_renderer->get_admin_database_action_ths()
//		as
//		$action_th
//	) {
//		$heading_row->append_tag_to_content($action_th);
//	}
//
//	$rows_html_table->append_tag_to_content($heading_row);
//
//	# ------------------------------------------------------------------
//
//	/**
//	 * Display the contents of the table.
//	 */
//	#$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'id';
//	#$direction = isset($_GET['direction']) ? $_GET['direction'] : 'ASC';
//	#$table_renderer->render_all_data_table($order_by, $direction);
//	$rows = $product_categories_table->get_all_rows(ORDER_BY, DIRECTION, OFFSET, LIMIT);
//
//	foreach ($rows as $row) {
//		$row_renderer = $row->get_renderer();
//
//		#$data_tr = $row_renderer->get_admin_database_tr();
//		$data_tr = $row_renderer->get_admin_product_categories_html_table_tr($current_page_url);
//
//		$rows_html_table->append_tag_to_content($data_tr);
//	}
//
//	# ------------------------------------------------------------------
//
//	$content_div->append_tag_to_content($rows_html_table);
//
//	$content_div->append_tag_to_content($limit_previous_next_div);
        
	$actions_method_args[] = $current_page_url;
	
        $selection_div
            = $table_renderer->get_admin_database_selection_html_table(
                ORDER_BY,
                DIRECTION,
                OFFSET,
                LIMIT,
                $current_page_url,
                'name description sort_order',
                'Product Categories',
		'get_shop_plug_in_admin_actions',
		$actions_method_args
            );
        
//        $selection_div
//            = $table_renderer
//		->get_admin_product_categories_selection_html_table(
//			DIRECTION,
//			ORDER_BY,
//			LIMIT,
//			OFFSET
//		    );
            
        $content_div->append_tag_to_content($selection_div);
}

echo $content_div->get_as_string();

?>
