<?php
/**
 * The content of the supplier_shipping_prices page.
 *
 * From here, the user can
 *
 *  - add a new supplier_shipping_price
 *  - delete a supplier_shipping_price
 *  - Edit a supplier_shipping_price
 * 
 * @copyright Clear Line Web Design, 2007-02-16
 */

/*
 * Get the database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();

$mysql_user = $mysql_user_factory->get_for_this_project();

$database = $mysql_user->get_database();

$supplier_shipping_prices_table = $database->get_table('hpi_shop_supplier_shipping_prices');
$suppliers_table = $database->get_table('hpi_shop_suppliers');
$product_categories_table = $database->get_table('hpi_shop_product_categories');
$customer_regions_table = $database->get_table('hpi_shop_customer_regions');

$table_renderer = $supplier_shipping_prices_table->get_renderer();

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

//if (isset($_GET['delete_all'])) {
//        /**
//         * Confirm deleting all the rows in the table.
//         */
//        $action_div = new HTMLTags_Div();
//        $action_div->set_attribute_str('id', 'action-div');

//        $question_delete_all_p =
//                new HTMLTags_P('Are you sure that you want to delete all of the supplier shipping prices?');
//        $action_div->append_tag_to_content($question_delete_all_p);

//        $confirm_delete_all_p = new HTMLTags_P();

//        $delete_all_href = new HTMLTags_URL();

//        $delete_all_href->set_file('/admin/redirect-script.php');

//        $delete_all_href->set_get_variable('module', 'shop');
//        $delete_all_href->set_get_variable('page', 'supplier-shipping-prices');

//        $delete_all_href->set_get_variable('delete_all');

//        $delete_all_a = new HTMLTags_A('DELETE ALL');

//        $delete_all_a->set_attribute_str('class', 'cool_button');
//        $delete_all_a->set_attribute_str('id', 'inline');

//        $delete_all_a->set_href($delete_all_href);

//        $confirm_delete_all_p->append_tag_to_content($delete_all_a);

//        $confirm_delete_all_p->append_str_to_content('&nbsp;');

//        $cancel_a = new HTMLTags_A('Cancel');

//        $cancel_a->set_attribute_str('class', 'cool_button');
//        $cancel_a->set_attribute_str('id', 'inline');

//        $cancel_a->set_href($cancel_href);

//        $confirm_delete_all_p->append_tag_to_content($cancel_a);
//        $action_div->append_tag_to_content($confirm_delete_all_p);
//        $content_div->append_tag_to_content($action_div);

//} elseif (isset($_GET['delete_id'])) {
//        /**
//         * Confirm deleting a row.
//         */
//        $row = $supplier_shipping_prices_table->get_row_by_id($_GET['delete_id']);

//        $question_p = new HTMLTags_P();

//        $question_p->set_attribute_str('class', 'question');

//        $question_p->append_str_to_content('Are you sure that you want to delete this supplier_shipping_price?');

//        $content_div->append_tag_to_content($question_p);

//        /**
//         * Show the user the data in the row.
//         */
//        $row_renderer = $row->get_renderer();

//        $content_div->append_tag_to_content($row_renderer->get_all_data_html_table());

//        # ------------------------------------------------------------------

//        $answer_p = new HTMLTags_P();

//        $answer_p->set_attribute_str('class', 'answer');

//        $delete_link = new HTMLTags_A('DELETE');

//        $delete_href = new HTMLTags_URL();

//        $delete_href->set_file('/admin/redirect-script.php');

//        $delete_href->set_get_variable('module', 'shop');
//        $delete_href->set_get_variable('page', 'supplier-shipping-prices');
//        $delete_href->set_get_variable('delete_id', $row->get_id());

//        $delete_link->set_href($delete_href);

//        $delete_link->set_attribute_str('class', 'cool_button');
//        $delete_link->set_attribute_str('id', 'inline');

//        $answer_p->append_tag_to_content($delete_link);

//        $cancel_link = new HTMLTags_A('Cancel');

//        $cancel_link->set_href($cancel_href);

//        $cancel_link->set_attribute_str('class', 'cool_button');
//        $cancel_link->set_attribute_str('id', 'inline');

//        $answer_p->append_tag_to_content($cancel_link);

//        $content_div->append_tag_to_content($answer_p);
if (
	isset($_GET['edit_row'])
		&&
		isset($_GET['supplier_id'])
		&&
		isset($_GET['product_category_id'])
	) {
		/**
		 * Row editing.
		 */
		$editing_action_url = clone $redirect_script_url;
		$editing_action_url->set_get_variable('edit_row');
		$editing_action_url->set_get_variable('supplier_id', $_GET['supplier_id']);
		$editing_action_url->set_get_variable('product_category_id', $_GET['product_category_id']);

		$row_editing_form = $table_renderer->
			get_supplier_shipping_price_editing_form(
				$_GET['supplier_id'],
				$_GET['product_category_id'],
				$editing_action_url,
				$cancel_href
			);

		$content_div->append_tag_to_content($row_editing_form);

//        } elseif (isset($_GET['add_row'])) {
//                /**
//                 * Row Adding.
//                 */
//                $redirect_script_url = new HTMLTags_URL();
//                $redirect_script_url->set_file('/admin/redirect-script.php');
//                $redirect_script_url->set_get_variable('module', 'shop');
//                $redirect_script_url->set_get_variable('page', 'supplier-shipping-prices');
//                $redirect_script_url->set_get_variable('add_row');

//                $row_adding_form = $table_renderer->get_supplier_shipping_price_adding_form($redirect_script_url, $cancel_href);

//                $content_div->append_tag_to_content($row_adding_form);
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
				$message = 'Deleted supplier_shipping_price id: ' . $_GET['last_deleted_id'];
			}
			elseif (isset($_GET['last_edited_id'])) {
				$message = 'Edited supplier_shipping_price id: ' . $_GET['last_edited_id'];
			}
			elseif (isset($_GET['last_added_id'])) {
				$message = 'Added supplier_shipping_price id: ' . $_GET['last_added_id'];
			}
			elseif (isset($_GET['deleted_all'])) {

				if ($_GET['deleted_all'] == 'successful')
				{
					$message = 'Succesfully deleted 
						all of your supplier_shipping_prices! 
						(Not really - feature disabled)';
				}
				else
				{
					$message = 'Failed to delete all of your supplier_shipping_prices.';
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


//                /**
//                 * Links to other pages in the admin section.
//                 */

//                $page_options_div = new HTMLTags_Div();
//                $page_options_div->set_attribute_str('id', 'page-options');

//                $other_pages_ul = new HTMLTags_UL();


//                /**
//                 * Link to the add row form.
//                 */
//                $add_row_li = new HTMLTags_LI();

//                $add_row_a = new HTMLTags_A('Add New supplier_shipping_price');

//                $add_row_href = new HTMLTags_URL();

//                $add_row_href->set_file('/admin/index.php');

//                $add_row_href->set_get_variable('module', 'shop');
//                $add_row_href->set_get_variable('page', 'supplier-shipping-prices');
//                $add_row_href->set_get_variable('add_row');

//                $add_row_a->set_href($add_row_href);

//                $add_row_li->append_tag_to_content($add_row_a);

//                $other_pages_ul->append_tag_to_content($add_row_li);

//                /**
//                 * Link to the delete all confirmation page.
//                 */
//                $delete_all_li = new HTMLTags_LI();

//                $delete_all_a = new HTMLTags_A('Delete All supplier_shipping_prices');

//                $delete_all_href = new HTMLTags_URL();

//                $delete_all_href->set_file('/admin/index.php');

//                $delete_all_href->set_get_variable('module', 'shop');
//                $delete_all_href->set_get_variable('page', 'supplier-shipping-prices');
//                $delete_all_href->set_get_variable('delete_all');

//                $delete_all_a->set_href($delete_all_href);

//                $delete_all_li->append_tag_to_content($delete_all_a);

//                $other_pages_ul->append_tag_to_content($delete_all_li);
//                $page_options_div->append_tag_to_content($other_pages_ul);

//                $content_div->append_tag_to_content($page_options_div);


		####################################################################
		#
		# Display some of the data in the table.
		#
		####################################################################
		# ------------------------------------------------------------------
		$suppliers = $suppliers_table->get_all_rows();
		//        print_r($suppliers);

		foreach ($suppliers as $supplier)
		{
			//                    $supplier_heading = new HTMLTags_Heading(2);
			//                    $supplier_heading->append_str_to_content($supplier->get_name());

			//                $conditions = array();
			//                $conditions['supplier_id'] = $supplier->get_id();

			//                $supplier_shipping_prices = $supplier_shipping_prices_table->get_rows_where($conditions);

			/**
			 * The table.
			 */
			$supplier_table = new HTMLTags_Table();
//                        $supplier_table->set_attribute_str('class', '');

			/**
			 * The caption.
			 */
			$supplier_address = $supplier->get_address();
			$caption_text = '';
			$caption_text .= $supplier->get_name();
			$caption_text .= '&nbsp(';
			$caption_text .= $supplier_address->get_country_name();
			$caption_text .= ')';

			$caption = new HTMLTags_Caption($caption_text);
			$supplier_table->append_tag_to_content($caption);

			$customer_regions = $customer_regions_table->get_all_rows();

			$heading_tr = new HTMLTags_TR();
			$heading_tr->append_tag_to_content(new HTMLTags_TH());

			foreach ($customer_regions as $customer_region)
			{
				$customer_region_currency = $customer_region->get_currency();
				$th_text = '';
				$th_text .= $customer_region->get_name();
				$th_text .= '&nbsp;(';
				$th_text .= $customer_region_currency->get_symbol();
				$th_text .= ')';
				$heading_tr->append_tag_to_content(new HTMLTags_TH($th_text));
			}
			$heading_tr->append_tag_to_content(new HTMLTags_TH('Action'));

			$supplier_table->append_tag_to_content($heading_tr);
			$product_categories = $product_categories_table->get_all_rows();

			foreach ($product_categories as $product_category)
			{
				$row_tr = new HTMLTags_TR();
				$row_th = new HTMLTags_TH($product_category->get_name());
				$row_tr->append_tag_to_content($row_th);

				foreach ($customer_regions as $customer_region)
				{
					/*
					 * FIRST_PRICE
					 */
					try
					{
						$conditions = array();
						$conditions['supplier_id'] = $supplier->get_id();
						$conditions['customer_region_id'] = $customer_region->get_id();
						$conditions['product_category_id'] = $product_category->get_id();

						$supplier_shipping_price =
							$supplier_shipping_prices_table->get_rows_where($conditions);
						if (count($supplier_shipping_price) > 0)
						{
							$data_td = new HTMLTags_TD();
							$data_td->append_str_to_content(
								$supplier_shipping_price[0]->get_first_price()
								. '&nbsp;(' .
								$supplier_shipping_price[0]->get_additional_price()
								. ')'
							);
							$row_tr->append_tag_to_content($data_td);
						}
						else
						{
							$data_td = new HTMLTags_TD('not set');
							$row_tr->append_tag_to_content($data_td);
						}
					}
					catch (Exception $e)
					{
						$data_td = new HTMLTags_TD('not set');
						$row_tr->append_tag_to_content($data_td);
					}
				}

				/*
				 * The edit td.
				 */
				$edit_td = new HTMLTags_TD();

				$edit_link = new HTMLTags_A('Edit');
				$edit_link->set_attribute_str('class', 'cool_button');
				$edit_link->set_attribute_str('id', 'edit_table_button');

				$edit_location = clone $current_page_url;
				$edit_location->set_get_variable('edit_row', '1');
				$edit_location->set_get_variable('supplier_id', $supplier->get_id());
				$edit_location->
					set_get_variable('product_category_id', $product_category->get_id());

				$edit_link->set_href($edit_location);

				$edit_td->append_tag_to_content($edit_link);

				$row_tr->append_tag_to_content($edit_td);
				$supplier_table->append_tag_to_content($row_tr);
			}	

			$content_div->append_tag_to_content($supplier_table);
		}


		# ------------------------------------------------------------------
	}
echo $content_div->get_as_string();

?>
