<?php
/**
 * The content of the product_tags page.
 *
 * From here, the user can
 *
 *  - add a new product
 *  - delete a product
 *  - Rearrange the sort order of product_tags
 *  - Edit a product
 * 
 * @copyright Clear Line Web Design, 2007-02-16
 */
/*
 * Get the database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();

$mysql_user = $mysql_user_factory->get_for_this_project();

$database = $mysql_user->get_database();

$product_tags_table = $database->get_table('hpi_shop_product_tags');

$table_renderer = $product_tags_table->get_renderer();

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

	$question_delete_all_p = new HTMLTags_P('Are you sure that you want to delete all of the product_tags?');
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

} 
elseif (isset($_GET['add_row'])) {
	/**
	 * Row Adding.
	 */

	$row_adding_url = clone $redirect_script_url;
	$row_adding_url->set_get_variable('add_row');

	$row_adding_form = $table_renderer->get_product_tag_adding_form($row_adding_url, $cancel_href);

	$content_div->append_tag_to_content($row_adding_form);

} 
else {

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
			$message = 'Deleted product id: ' . $_GET['last_deleted_id'];
		}
		elseif (isset($_GET['last_edited_id'])) {
			$product_tag = $product_tags_table->get_row_by_id($_GET['last_edited_id']);
			$message = 'Edited tag: ' . $product_tag->get_tag();
		}
		elseif (isset($_GET['last_added_id'])) {
			$message = 'Added product id: ' . $_GET['last_added_id'];
		}
		elseif (isset($_GET['deleted_all'])) {

			if ($_GET['deleted_all'] == 'successful')
			{
				$message = 'Succesfully deleted 
					all of your product_tags! 
					(Not really - feature disabled)';
			}
			else
			{
				$message = 'Failed to delete all of your product_tags.';
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

		$add_row_a = new HTMLTags_A('Add New Product Tag');

		$add_row_href = clone $current_page_url;
		$add_row_href->set_get_variable('add_row');

		$add_row_a->set_href($add_row_href);

		$add_row_li->append_tag_to_content($add_row_a);

		$other_pages_ul->append_tag_to_content($add_row_li);

	$page_options_div->append_tag_to_content($other_pages_ul);

	$content_div->append_tag_to_content($page_options_div);


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
	 * To allow the user to set the number of extras to show at a time.
	 */
	$limit_action = clone $current_page_url;

	#		echo 'LIMIT: ' . LIMIT . "\n";
	#		exit;

	$limit_form = new Database_LimitForm($limit_action, LIMIT, '10 20 50');

	//                $limit_form->add_hidden_input('module', 'shop');
	//                $limit_form->add_hidden_input('page', 'product_tags');

	$limit_form->add_hidden_input('order_by', ORDER_BY);
	$limit_form->add_hidden_input('direction', DIRECTION);
	$limit_form->add_hidden_input('offset', OFFSET);

	$limit_previous_next_div->append_tag_to_content($limit_form);

	/*
	 * Go the previous or next list of extras.
	 */
	$previous_next_url = clone $current_page_url;
	$previous_next_url->set_get_variable('order_by', ORDER_BY);
	$previous_next_url->set_get_variable('direction', DIRECTION);

	#print_r($previous_next_url);

	$row_count = $product_tags_table->count_all_rows();

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
		'Product Tags'
	);
	$rows_html_table->append_tag_to_content($caption);

	/**
	 * The Heading Row.
	 */
	$sort_href = clone $current_page_url;
	$sort_href->set_get_variable('limit', LIMIT);

	$heading_row = new Database_SortableHeadingTR($sort_href, DIRECTION);

	#$fields = $product_tags_table->get_fields();
	#
	#foreach ($fields as $field) {
	#    $heading_row->append_sortable_field_name($field->get_name());
	#}

	$field_names = explode(' ', 'tag principal');

	foreach ($field_names as $field_name) {
		$heading_row->append_sortable_field_name($field_name);
	}
	$heading_row->append_tag_to_content(new HTMLTags_TH('No. of Products'));
	$heading_row->append_tag_to_content(new HTMLTags_TH('Toggle Principal Tag Status'));

	//                foreach (
	//                        $table_renderer->get_admin_database_action_ths()
	//                        as
	//                        $action_th
	//                ) {
	//                        $heading_row->append_tag_to_content($action_th);
	//                }

	$rows_html_table->append_tag_to_content($heading_row);

	# ------------------------------------------------------------------

	/**
	 * Display the contents of the table.
	 */
	#$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'id';
	#$direction = isset($_GET['direction']) ? $_GET['direction'] : 'ASC';
	#$table_renderer->render_all_data_table($order_by, $direction);
	$rows = $product_tags_table->get_all_rows(ORDER_BY, DIRECTION, OFFSET, LIMIT);
	#print_r($rows);
	foreach ($rows as $row) {
		$row_renderer = $row->get_renderer();

		#$data_tr = $row_renderer->get_admin_database_tr();
		$data_tr = $row_renderer->get_admin_product_tags_html_table_tr($redirect_script_url);

		$rows_html_table->append_tag_to_content($data_tr);
	}

	# ------------------------------------------------------------------

	$content_div->append_tag_to_content($rows_html_table);

	$content_div->append_tag_to_content($limit_previous_next_div);
}

echo $content_div->get_as_string();

?>
