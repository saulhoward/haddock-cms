<?php
/**
 * DEPRECATED!
 *
 * USE THE Shop_AdminProductsPage class instead.
 *
 * The content of the products page.
 *
 * From here, the user can
 *
 *  - add a new product
 *  - delete a product
 *  - Rearrange the sort order of products
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

$products_table = $database->get_table('hpi_shop_products');

$table_renderer = $products_table->get_renderer();

$page_manager = PublicHTML_PageManager::get_instance();
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

	$question_delete_all_p = new HTMLTags_P('Are you sure that you want to delete all of the products?');
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
	$row = $products_table->get_row_by_id($_GET['delete_id']);

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
	$row_editing_url = clone $redirect_script_url;
	$row_editing_url->set_get_variable('edit_id', $_GET['edit_id']);
	$product_row = $products_table->get_row_by_id($_GET['edit_id']);
	$product_row_renderer = $product_row->get_renderer();
	$row_editing_form  = $product_row_renderer
		->get_product_editing_form($row_editing_url, $cancel_href);

	$content_div->append_tag_to_content($row_editing_form);

	$explanation_div = new HTMLTags_Div();

	$explanation_text = <<<TXT
Some other links to edit forms:
TXT;
	$explanation_div->append_tag_to_content(new HTMLTags_P($explanation_text));

	$explanation_links_ul = new HTMLTags_UL();

	$explanation_link_li_1 = new HTMLTags_LI();
	$explanation_link_a = new HTMLTags_A('Add a new photograph...');
	$explanation_link_href = clone $current_page_url;
	$explanation_link_href->set_get_variable('admin-page', 'photographs');
	$explanation_link_href->set_get_variable('add_row', '1');
	$explanation_link_a->set_href($explanation_link_href);

	$explanation_link_li_1->append_tag_to_content($explanation_link_a);
	$explanation_links_ul->append_tag_to_content($explanation_link_li_1);

	$explanation_link_li_2 = new HTMLTags_LI();
	$explanation_link_a = new HTMLTags_A('Edit all the tags for this product...');
	$explanation_link_href = clone $current_page_url;
	$explanation_link_href->set_get_variable('edit_tags', '1');
	$explanation_link_href->set_get_variable('product_id', $_GET['edit_id']);
	$explanation_link_a->set_href($explanation_link_href);

	$explanation_link_li_2->append_tag_to_content($explanation_link_a);
	$explanation_links_ul->append_tag_to_content($explanation_link_li_2);


	$explanation_div->append_tag_to_content($explanation_links_ul);

	$content_div->append_tag_to_content($explanation_div);

} elseif (isset($_GET['add_row'])) {
	/**
	 * Row Adding.
	 */

	$row_adding_url = clone $redirect_script_url;
	$row_adding_url->set_get_variable('add_row');

	$row_adding_form = $table_renderer->get_product_adding_form($row_adding_url, $cancel_href);

	$content_div->append_tag_to_content($row_adding_form);

	$explanation_div = new HTMLTags_Div();

	$explanation_text = <<<TXT
Some other links to forms:
TXT;
	$explanation_div->append_tag_to_content(new HTMLTags_P($explanation_text));

	$explanation_links_ul = new HTMLTags_UL();

	$explanation_link_li_1 = new HTMLTags_LI();
	$explanation_link_a = new HTMLTags_A('Add a new photograph...');
	$explanation_link_href = clone $current_page_url;
	$explanation_link_href->set_get_variable('admin-page', 'photographs');
	$explanation_link_href->set_get_variable('add_row', '1');
	$explanation_link_a->set_href($explanation_link_href);

	$explanation_link_li_1->append_tag_to_content($explanation_link_a);
	$explanation_links_ul->append_tag_to_content($explanation_link_li_1);
	$explanation_div->append_tag_to_content($explanation_links_ul);

	$content_div->append_tag_to_content($explanation_div);



} 
elseif (
	isset($_GET['edit_tags'])
	&&
	isset($_GET['product_id'])
)
{
	/**
	 * Row editing.
	 */
	$product_row = $products_table->get_row_by_id($_GET['product_id']);
	$product_row_renderer = $product_row->get_renderer();
	$row_editing_form  = $product_row_renderer
		->get_product_tag_editing_form($redirect_script_url, $cancel_href);

	$content_div->append_tag_to_content($row_editing_form);
} 
elseif (
	isset($_GET['set_principal_tags'])
	&&
	isset($_GET['product_id'])
)
{
	/**
	 * Row editing.
	 */
	$product_row = $products_table->get_row_by_id($_GET['product_id']);
	$product_row_renderer = $product_row->get_renderer();
	$row_editing_form  = $product_row_renderer
		->get_product_principal_tag_editing_form($redirect_script_url, $cancel_href);

	$content_div->append_tag_to_content($row_editing_form);
}
elseif (
	isset($_GET['set_price'])
	&&
	isset($_GET['product_id'])
) {
	/**
	 * Set Prices
	 */

	$set_price_url = clone $redirect_script_url;
	$set_price_url->set_get_variable('set_price');
	$set_price_url->set_get_variable('product_id', $_GET['product_id']);

	$product_currency_prices_table = $database->get_table('hpi_shop_product_currency_prices');
	$product_currency_prices_table_renderer = $product_currency_prices_table->get_renderer();
	$price_setting_form = 
		$product_currency_prices_table_renderer->get_product_currency_price_editing_form(
			$_GET['product_id'],
			$set_price_url,
			$cancel_href
		);

	$content_div->append_tag_to_content($price_setting_form);
} 
elseif (
	isset($_GET['set_stock_level'])
	&&
	isset($_GET['product_id'])
) {
	/**
	 * Set Stock Level
	 */

	$product_row = $products_table->get_row_by_id($_GET['product_id']);
	$product_row_renderer = $product_row->get_renderer();
	$row_editing_form  = $product_row_renderer
		->get_stock_level_editing_form($redirect_script_url, $cancel_href);

	$content_div->append_tag_to_content($row_editing_form);
} elseif (
	isset($_GET['set_main_photograph'])
	&&
	isset($_GET['product_id'])
) {
	$product = $products_table->get_row_by_id($_GET['product_id']);
	
	$instruction_p = new HTMLTags_P(
		'Set main photograph for ' . $product->get_name()
	);
	
	$content_div->append_tag_to_content($instruction_p);
	
	$photographs_table = $database->get_table('hpi_shop_photographs');
	
	$photograhps_ul = new HTMLTags_UL();
	
	$photographs = $photographs_table->get_all_rows();
	
	$set_main_photograph_url = clone $redirect_script_url;
	
	$set_main_photograph_url->set_get_variable('product_id', $product->get_id());
	$set_main_photograph_url->set_get_variable('set_main_photograph');
	
	foreach ($photographs as $photograph) {
		$li = new HTMLTags_LI();
		
		$pr = $photograph->get_renderer();
		
		$set_main_photograph_to_this_photograph_url
			= clone $set_main_photograph_url;
		
		$set_main_photograph_to_this_photograph_url
			->set_get_variable('photograph_id', $photograph->get_id());
			
		$tnia = $pr->get_thumbnail_image_a();
		
		$tnia->set_href($set_main_photograph_to_this_photograph_url);
		
		$li->append_tag_to_content($tnia);
		
		$photograhps_ul->add_li($li);
	}
	
	$content_div->append_tag_to_content($photograhps_ul);
} elseif (
	isset($_GET['set_design_photograph'])
	&&
	isset($_GET['product_id'])
) {
	$product = $products_table->get_row_by_id($_GET['product_id']);
	
	$instruction_p = new HTMLTags_P(
		'Set design photograph for ' . $product->get_name()
	);
	
	$content_div->append_tag_to_content($instruction_p);
	
	$photographs_table = $database->get_table('hpi_shop_photographs');
	
	$photograhps_ul = new HTMLTags_UL();
	
	$photographs = $photographs_table->get_all_rows();
	
	$set_design_photograph_url = clone $redirect_script_url;
	
	$set_design_photograph_url->set_get_variable('product_id', $product->get_id());
	$set_design_photograph_url->set_get_variable('set_design_photograph');
	
	foreach ($photographs as $photograph) {
		$li = new HTMLTags_LI();
		
		$pr = $photograph->get_renderer();
		
		$set_design_photograph_to_this_photograph_url
			= clone $set_design_photograph_url;
		
		$set_design_photograph_to_this_photograph_url
			->set_get_variable('photograph_id', $photograph->get_id());
			
		$tnia = $pr->get_thumbnail_image_a();
		
		$tnia->set_href($set_design_photograph_to_this_photograph_url);
		
		$li->append_tag_to_content($tnia);
		
		$photograhps_ul->add_li($li);
	}
	
	$content_div->append_tag_to_content($photograhps_ul);
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
			$message = 'Deleted product id: ' . $_GET['last_deleted_id'];
		}
		elseif (isset($_GET['last_edited_id'])) {
			$product = $products_table->get_row_by_id($_GET['last_edited_id']);
			$message = 'Edited ' . $product->get_name();
		}
		elseif (isset($_GET['last_added_id'])) {
			$product = $products_table->get_row_by_id($_GET['last_added_id']);
			$message = 'Added ' . $product->get_name();
		}
		elseif (isset($_GET['deleted_all'])) {

			if ($_GET['deleted_all'] == 'successful')
			{
				$message = 'Succesfully deleted 
					all of your products! 
					(Not really - feature disabled)';
			}
			else
			{
				$message = 'Failed to delete all of your products.';
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
	#$add_row_li = new HTMLTags_LI();
	#
	#$add_row_a = new HTMLTags_A('Add New Product');
	#
	#$add_row_href = clone $current_page_url;
	#$add_row_href->set_get_variable('add_row');
	#
	#$add_row_a->set_href($add_row_href);
	#
	#$add_row_li->append_tag_to_content($add_row_a);
	#
	#$other_pages_ul->append_tag_to_content($add_row_li);

	/**
	 * Link to the delete all confirmation page.
	 */
	$delete_all_li = new HTMLTags_LI();

	$delete_all_a = new HTMLTags_A('Delete All Products');

	$delete_all_href = clone $current_page_url;
	$delete_all_href->set_get_variable('delete_all');

	$delete_all_a->set_href($delete_all_href);

	$delete_all_li->append_tag_to_content($delete_all_a);

	$other_pages_ul->append_tag_to_content($delete_all_li);
	$page_options_div->append_tag_to_content($other_pages_ul);

	$content_div->append_tag_to_content($page_options_div);

	/*
	 * -------------------------------------------------------------------------
	 * The product category selecting form.
	 * -------------------------------------------------------------------------
	 */
	$product_category_selecting_form = new HTMLTags_Form();

	$product_category_selecting_form->set_attribute_str('name', 'product_category_selecting');
	$product_category_selecting_form->set_attribute_str('method', 'GET');
	$product_category_selecting_form->set_attribute_str('class', 'table-select-form');
	$product_category_selecting_action = clone $current_page_url;
	//        $product_category_selecting_action->set_get_variable('product_category_id');
	$product_category_selecting_form->set_action(new HTMLTags_URL('/'));

	$inputs_ol = new HTMLTags_OL();
	/*
	 * Select the product_category_id.
	 */
	$product_category_li = new HTMLTags_LI();
	$product_category_label = new HTMLTags_Label('Product Category');
	$product_category_label->set_attribute_str('for', 'product_category_id');
	$product_category_li->append_tag_to_content($product_category_label);
	if (isset($_GET['product_category_id']))
	{
		$product_category_form_select = 
			$table_renderer->get_product_category_form_select($_GET['product_category_id']);
	}
	else
	{
		$product_category_form_select = $table_renderer->get_product_category_form_select();
	}

	$all_product_categories_option = new HTMLTags_Option('all');
	$all_product_categories_option->set_attribute_str('value', 'all');

	if ($_GET['product_category_id'] == 'all' || !isset($_GET['product_category_id']))
	{
		$all_product_categories_option->set_attribute_str('selected');
	}

	$product_category_form_select->add_option($all_product_categories_option);
	$product_category_li->append_tag_to_content($product_category_form_select);
	$inputs_ol->add_li($product_category_li);


	/*
	 * The hidden inputs.
	 */

	$product_category_selecting_action_get_vars = $product_category_selecting_action->get_get_variables();

	foreach (array_keys($product_category_selecting_action_get_vars) as $key)
	{
		$form_hidden_input = new HTMLTags_Input();
		$form_hidden_input->set_attribute_str('type', 'hidden');
		$form_hidden_input->set_attribute_str('name', $key);
		$form_hidden_input->set_attribute_str('value', $product_category_selecting_action_get_vars[$key]);

		$product_category_selecting_form->append_tag_to_content($form_hidden_input);
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

	$product_category_selecting_form->append_tag_to_content($inputs_ol);
	$content_div->append_tag_to_content($product_category_selecting_form);

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
	//                $limit_form->add_hidden_input('page', 'products');

	$limit_form->add_hidden_input('section', 'haddock');
	$limit_form->add_hidden_input('module', 'admin');
	$limit_form->add_hidden_input('page', 'admin-includer');
	$limit_form->add_hidden_input('type', 'html');

	$limit_form->add_hidden_input('admin-section', 'plug-ins');
	$limit_form->add_hidden_input('admin-module', 'shop');
	$limit_form->add_hidden_input('admin-page', 'products');

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

	$row_count = $products_table->count_all_rows();

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
//        $caption = new HTMLTags_Caption(
//                'Products'
//        );
//        $rows_html_table->append_tag_to_content($caption);
	if (isset($_GET['product_category_id']))
	{

		if ($_GET['product_category_id'] == 'all')
		{
			$caption = new HTMLTags_Caption(
				'All Products'  
			);

			$caption->append_str_to_content(' (' . $products_table->count_products() . ')');
		}
		else
		{

			$product_categories_table = $database->get_table('hpi_shop_product_categories');
			$product_category = $product_categories_table->get_row_by_id($_GET['product_category_id']);
			$caption = new HTMLTags_Caption(
				'Products in Category&nbsp;' . $product_category->get_name()
			);

			$caption->append_str_to_content(' (' . $product_category->count_products() . ')');
		}
	}
	else
	{
		$caption = new HTMLTags_Caption(
			'All Products'  
		);

		$caption->append_str_to_content(' (' . $products_table->count_products() . ')');
	}
	$rows_html_table->append_tag_to_content($caption);


	/**
	 * The Heading Row.
	 */
	$sort_href = clone $current_page_url;
	$sort_href->set_get_variable('limit', LIMIT);

	$heading_row = new Database_SortableHeadingTR($sort_href, DIRECTION);

	#$fields = $products_table->get_fields();
	#
	#foreach ($fields as $field) {
	#    $heading_row->append_sortable_field_name($field->get_name());
	#}

	$field_names = explode(' ', 'added name');

	foreach ($field_names as $field_name) {
		$heading_row->append_sortable_field_name($field_name);
	}
	$photograph_header = new HTMLTags_TH('Photograph'); 
	$heading_row->append_tag_to_content($photograph_header);

	$brand_header = new HTMLTags_TH('Brand'); 
	$heading_row->append_tag_to_content($brand_header);

	$product_category_id_header = new HTMLTags_TH('Product Category'); 
	$heading_row->append_tag_to_content($product_category_id_header);

	$price_header = new HTMLTags_TH('Price'); 
	$heading_row->append_tag_to_content($price_header);

	$supplier_header = new HTMLTags_TH('Supplier'); 
	$heading_row->append_tag_to_content($supplier_header);

	$comments_header = new HTMLTags_TH('Comments'); 
	$heading_row->append_tag_to_content($comments_header);

	$heading_row->append_tag_to_content(new HTMLTags_TH('Tags'));
	//                $heading_row->append_sortable_field_name('use_stock_level');
	//                $heading_row->append_sortable_field_name('stock_level');
	//                $heading_row->append_sortable_field_name('stock_buffer_level');
	$heading_row->append_tag_to_content(new HTMLTags_TH('Stock (Buffer)'));
	$heading_row->append_sortable_field_name('sort_order');

	//                $heading_row->append_tag_to_content(new HTMLTags_TH('Principal Tags'));
	//                $heading_row->append_tag_to_content(new HTMLTags_TH('Tags'));
	//                $heading_row->append_tag_to_content(new HTMLTags_TH('Price'));
	$heading_row->append_sortable_field_name('status');
	$heading_row->append_tag_to_content(new HTMLTags_TH('Stock Level'));

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
	if (isset($_GET['product_category_id']))
	{
		if ($_GET['product_category_id'] == 'all')
		{
			$rows = $products_table->get_all_rows(ORDER_BY, DIRECTION, OFFSET, LIMIT);
		}

		else
		{
			$conditions = array();
			$conditions['product_category_id'] = $_GET['product_category_id'];
			$rows = $products_table->get_rows_where($conditions, ORDER_BY, DIRECTION, OFFSET, LIMIT);
		}
	}
	else
	{
		$rows = $products_table->get_all_rows(ORDER_BY, DIRECTION, OFFSET, LIMIT);
	}

	foreach ($rows as $row) {
		$row_renderer = $row->get_renderer();

		#$data_tr = $row_renderer->get_admin_database_tr();
		$data_tr = 
			$row_renderer->get_admin_products_html_table_tr(
				$current_page_url,
				$redirect_script_url
			);

		$rows_html_table->append_tag_to_content($data_tr);
	}

	# ------------------------------------------------------------------

	$content_div->append_tag_to_content($rows_html_table);

	$content_div->append_tag_to_content($limit_previous_next_div);
}

echo $content_div->get_as_string();

?>