<?php
/**
 * The content of the orders page.
 *
 * From here, the user can
 * 
 * @copyright Clear Line Web Design, 2007-02-16
 */

/*
 * Define the necessary classes.
 */
#require_once PROJECT_ROOT
#. '/haddock/database/classes/'
#. 'Database_MySQLUserFactory.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_Div.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_TR.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_TH.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_TD.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_P.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/extensions/'
#	. 'HTMLTags_SimpleOLForm.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/html-tags/'
#	. 'Database_EditRowOLForm.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/html-tags/'
#	. 'Database_LimitForm.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/html-tags/'
#	. 'Database_PreviousNextUL.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/html-tags/'
#	. 'Database_SortableHeadingTR.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_Caption.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/extensions/'
#	. 'HTMLTags_LastActionBoxDiv.inc.php';

/*
 * Get the database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();
$orders_table = $database->get_table('hpi_shop_orders');
$table_renderer = $orders_table->get_renderer();

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
if (isset($_GET['edit_id'])) {
	/**
	 * Row editing.
	 */
	$row_editing_url = clone $redirect_script_url;
	$row_editing_url->set_get_variable('edit_id', $_GET['edit_id']);
	$order_row = $orders_table->get_row_by_id($_GET['edit_id']);
	$order_row_renderer = $order_row->get_renderer();
	$row_editing_form  = $order_row_renderer
		->get_order_editing_form_div($row_editing_url, $cancel_href);

	$content_div->append_tag_to_content($row_editing_form);

} else {
	//            
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
			$message = 'Deleted order id: ' . $_GET['last_deleted_id'];
		}
		elseif (isset($_GET['last_edited_id'])) {
			$message = 'Set status of order id: ' . $_GET['last_edited_id'];
		}
		elseif (isset($_GET['last_added_id'])) {
			$message = 'Added order id: ' . $_GET['last_added_id'];
		}
		elseif (isset($_GET['deleted_all'])) {

			if ($_GET['deleted_all'] == 'successful')
			{
				$message = 'Succesfully deleted 
					all of your orders! 
					(Not really - feature disabled)';
			}
			else
			{
				$message = 'Failed to delete all of your orders.';
			}
		}
		$last_error_box_div
			= new HTMLTags_LastActionBoxDiv(
				$message, 
				'/admin/shop/orders.html',
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
	 * Link to the refresh page.
	 */
	$refresh_page_li = new HTMLTags_LI();
	$refresh_page_a = new HTMLTags_A('Check for new orders');
	$refresh_page_a->set_href($current_page_url);
	$refresh_page_li->append_tag_to_content($refresh_page_a);
	$other_pages_ul->append_tag_to_content($refresh_page_li);


	$page_options_div->append_tag_to_content($other_pages_ul);
	$content_div->append_tag_to_content($page_options_div);


	/*
	 * -------------------------------------------------------------------------
	 * The order status selecting form.
	 * -------------------------------------------------------------------------
	 */

	$order_status_selecting_form = new HTMLTags_Form();

	$order_status_selecting_form->set_attribute_str('name', 'order_status_selecting');
	$order_status_selecting_form->set_attribute_str('method', 'GET');
	$order_status_selecting_form->set_attribute_str('class', 'table-select-form');

	$order_status_selecting_action = clone $current_page_url;
//        $order_status_selecting_action->set_get_variable('status');

	$order_status_selecting_form->set_action(new HTMLTags_URL('/'));

	$inputs_ol = new HTMLTags_OL();

	/*
	 * Select the status.
	 */
	$status_li = new HTMLTags_LI();

	$status_label = new HTMLTags_Label('Order Status');
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

	$status_field = $orders_table->get_field('status');
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
			if ($possible_status == 'paid') {
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

	$order_status_selecting_action_get_vars = $order_status_selecting_action->get_get_variables();

	foreach (array_keys($order_status_selecting_action_get_vars) as $key)
	{
		$form_hidden_input = new HTMLTags_Input();
		$form_hidden_input->set_attribute_str('type', 'hidden');
		$form_hidden_input->set_attribute_str('name', $key);
		$form_hidden_input->set_attribute_str('value', $order_status_selecting_action_get_vars[$key]);

		$order_status_selecting_form->append_tag_to_content($form_hidden_input);
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

	$order_status_selecting_form->append_tag_to_content($inputs_ol);

	$content_div->append_tag_to_content($order_status_selecting_form);



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
	$limit_action = new HTMLTags_URL();
	$limit_action->set_file('/haddock/public-html/public-html/index.php');

	$limit_form = new Database_LimitForm($limit_action, LIMIT, '10 20 50');

	$limit_form->add_hidden_input('section', 'haddock');
	$limit_form->add_hidden_input('module', 'admin');
	$limit_form->add_hidden_input('page', 'admin-includer');
	$limit_form->add_hidden_input('type', 'html');
	
	$limit_form->add_hidden_input('admin-section', 'plug-ins');
	$limit_form->add_hidden_input('admin-module', 'shop');
	$limit_form->add_hidden_input('admin-page', 'orders');
	
	if (isset($_GET['status'])) {
		$limit_form->add_hidden_input('status', $_GET['status']);
	}
	
	$limit_form->add_hidden_input('order_by', ORDER_BY);
	$limit_form->add_hidden_input('direction', DIRECTION);
	$limit_form->add_hidden_input('offset', OFFSET);

	$limit_previous_next_div->append_tag_to_content($limit_form);

	/*
	 * Go the previous or next list of extras.
	 */
	$previous_next_url = new HTMLTags_URL();
	$previous_next_url->set_file('/haddock/public-html/public-html/index.php');
	
	$previous_next_url->set_get_variable('section', 'haddock');
	$previous_next_url->set_get_variable('module', 'admin');
	$previous_next_url->set_get_variable('page', 'admin-includer');
	$previous_next_url->set_get_variable('type', 'html');
	
	$previous_next_url->set_get_variable('admin-section', 'plug-ins');
	$previous_next_url->set_get_variable('admin-module', 'shop');
	$previous_next_url->set_get_variable('admin-page', 'orders');

	$previous_next_url->set_get_variable('order_by', ORDER_BY);
	$previous_next_url->set_get_variable('direction', DIRECTION);
	
	if (isset($_GET['status'])) {
		$previous_next_url->set_get_variable('status', $_GET['status']);
	}
	
	#print_r($previous_next_url);

	$row_count = $orders_table->count_all_rows();

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
		if ($_GET['status'] == 'all')
		{
			$caption = new HTMLTags_Caption(
				'All Orders'
			);
			$caption->append_str_to_content(
				'&nbsp;(' . $orders_table->count_orders() . ')'
			);
		}
		else
		{
			$caption = new HTMLTags_Caption(
				'Orders&nbsp;' . ucfirst($_GET['status'])
			);
			$caption->append_str_to_content(
				'&nbsp;(' . $orders_table->count_orders_for_status($_GET['status']) . ')'
			);
		}
	}
	else
	{
		$caption = new HTMLTags_Caption(
			'Orders Paid'
		);

		$caption->append_str_to_content(
			'&nbsp;(' . $orders_table->count_orders_for_status('paid') . ')'
		);
	}
	$rows_html_table->append_tag_to_content($caption);

	/**
	 * The Heading Row.
	 */
	$sort_href = new HTMLTags_URL();

	$sort_href->set_file('/haddock/public-html/public-html/index.php');
	
	$sort_href->set_get_variable('section', 'haddock');
	$sort_href->set_get_variable('module', 'admin');
	$sort_href->set_get_variable('page', 'admin-includer');
	$sort_href->set_get_variable('type', 'html');
	
	$sort_href->set_get_variable('admin-section', 'plug-ins');
	$sort_href->set_get_variable('admin-module', 'shop');
	$sort_href->set_get_variable('admin-page', 'orders');

	if (isset($_GET['status'])) {
		$sort_href->set_get_variable('status', $_GET['status']);
	}
	
	$sort_href->set_get_variable('limit', LIMIT);
	
	$heading_row = new Database_SortableHeadingTR($sort_href, DIRECTION);

	#$fields = $orders_table->get_fields();
	#
	#foreach ($fields as $field) {
	#    $heading_row->append_sortable_field_name($field->get_name());
	#}

	$heading_row->append_sortable_field_name('added');
	
	/*
	 * RFI 2008-01-18
	 */
	#$photograph_header = new HTMLTags_TH('Product'); 
	#$heading_row->append_tag_to_content($photograph_header);
	#
	#$supplier_header = new HTMLTags_TH('Supplier'); 
	#$heading_row->append_tag_to_content($supplier_header);
	#
	#$heading_row->append_sortable_field_name('quantity');
	
	$heading_row->append_sortable_field_name('txn_id');
	
	$customer_header = new HTMLTags_TH('Customer'); 
	$heading_row->append_tag_to_content($customer_header);

	$heading_row->append_sortable_field_name('status');

	$edit_header = new HTMLTags_TH('Edit'); 
	$heading_row->append_tag_to_content($edit_header);


	//            foreach (
	//                $table_renderer->get_admin_database_action_ths()
	//                as
	//                $action_th
	//            ) {
	//                $heading_row->append_tag_to_content($action_th);
	//            }

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
			$rows = $orders_table->get_all_rows(ORDER_BY, DIRECTION, OFFSET, LIMIT);
		}
		else
		{
			$conditions = array();
			$conditions['status'] = $_GET['status'];
			$rows = $orders_table->get_rows_where($conditions, ORDER_BY, DIRECTION, OFFSET, LIMIT);
		}
	}
	else
	{
		$conditions = array();
		$conditions['status'] = 'paid';
		$rows = $orders_table->get_rows_where($conditions, ORDER_BY, DIRECTION, OFFSET, LIMIT);
	}

	foreach ($rows as $row) {
		$row_renderer = $row->get_renderer();

		#$data_tr = $row_renderer->get_admin_database_tr();
		$data_tr = $row_renderer->get_admin_order_html_table_tr($current_page_url);

		$rows_html_table->append_tag_to_content($data_tr);
	}

	# ------------------------------------------------------------------

	$content_div->append_tag_to_content($rows_html_table);

	$content_div->append_tag_to_content($limit_previous_next_div);
}

echo $content_div->get_as_string();

?>