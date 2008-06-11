<?php
/**
 * Shop_SupplierRowRenderer.inc.php
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */


require_once PROJECT_ROOT
. '/haddock/html-tags/classes/standard/'
. 'HTMLTags_P.inc.php';

require_once PROJECT_ROOT
	. '/haddock/html-tags/classes/standard/'
	. 'HTMLTags_Abbr.inc.php';

require_once PROJECT_ROOT
	. '/haddock/formatting/classes/'
	. 'Formatting_DateTime.inc.php';

require_once PROJECT_ROOT
	. '/haddock/database/classes/renderers/'
	. 'Database_RowRenderer.inc.php';

class
	Shop_SupplierRowRenderer
	extends
	Database_RowRenderer
{
	public function
		get_admin_suppliers_html_table_tr($current_page_url)
	{
		$html_row =  new HTMLTags_TR();

		$row = $this->get_element();

		$table = $row->get_table();
		//        name notes');

		//            foreach ($field_names as $field_name) {
		//                $heading_row->append_sortable_field_name($field_name);
		//            }
		//               
		//           $currency_header = new HTMLTags_TH('Currency'); 
		//            $heading_row->append_tag_to_content($currency_header);

		//           $address_header = new HTMLTags_TH('Address'); 
		//            $heading_row->append_tag_to_content($address_header);

		//           $email_address_header = new HTMLTags_TH('Email Address'); 
		//            $heading_row->append_tag_to_content($email_address_header);

		//           $telephone_header = new HTMLTags_TH('Telephone'); 
		//            $heading_row->append_tag_to_content($telephone_header);
		/*
		 * The data.
		 */ 
		$name_field = $table->get_field('name');
		$name_td = $this->get_data_html_table_td($name_field);
		$html_row->append_tag_to_content($name_td);

		$contact_name_field = $table->get_field('contact_name');
		$contact_name_td = $this->get_data_html_table_td($contact_name_field);
		$html_row->append_tag_to_content($contact_name_td);

		$notes_field = $table->get_field('notes');
		$notes_td = $this->get_data_html_table_td($notes_field);
		$html_row->append_tag_to_content($notes_td);

		$currency_td = $this->get_currency_td();
		$html_row->append_tag_to_content($currency_td);

		$address_td = $this->get_address_td();
		$html_row->append_tag_to_content($address_td);

		$email_address_td = $this->get_email_address_td();
		$html_row->append_tag_to_content($email_address_td);

		$telephone_number_td = $this->get_telephone_number_td();
		$html_row->append_tag_to_content($telephone_number_td);

		/*
		 * The edit td.
		 */
		$edit_td = new HTMLTags_TD();

		$edit_link = new HTMLTags_A('Edit');
		$edit_link->set_attribute_str('class', 'cool_button');
		$edit_link->set_attribute_str('id', 'edit_table_button');

		$edit_location = clone $current_page_url;
		$edit_location->set_get_variable('edit_id', $row->get_id());

		$edit_link->set_href($edit_location);

		$edit_td->append_tag_to_content($edit_link);

		$html_row->append_tag_to_content($edit_td);

		/*
		 * The delete td.
		 */
		$delete_td = new HTMLTags_TD();

		$delete_link = new HTMLTags_A('Delete');
		$delete_link->set_attribute_str('class', 'cool_button');
		$delete_link->set_attribute_str('id', 'delete_table_button');

		$delete_location = clone $current_page_url;
		$delete_location->set_get_variable('delete_id', $row->get_id());

		$delete_link->set_href($delete_location);

		$delete_td->append_tag_to_content($delete_link);

		$html_row->append_tag_to_content($delete_td);

		return $html_row;
	}

	public function
		get_currency_td()
	{
		$row = $this->get_element();
		$currency = $row->get_currency(); 

		$currency_text = '';
		$currency_text .= $currency->get_name();
		$currency_text .= '&nbsp;(';
		$currency_text .= $currency->get_symbol();
		$currency_text .= ')';

		$currency_td = new HTMLTags_TD($currency_text);
		return $currency_td;
	}
	public function
		get_address_td()
	{
		$row = $this->get_element();
		$address = $row->get_address(); 
		$address_renderer = $address->get_renderer();
		$address_td = $address_renderer->get_short_address_td();
		return $address_td;
	}

	public function
		get_email_address_td()
	{
		$row = $this->get_element();
		$email_address = $row->get_email_address(); 

		return new HTMLTags_TD($email_address->get_email_address());
	}

	public function
		get_telephone_number_td()
	{
		$row = $this->get_element();
		$telephone_number = $row->get_telephone_number(); 
		$telephone_number_td = new HTMLTags_TD($telephone_number->get_telephone_number());
		return $telephone_number_td;
	}

	public function
		get_all_orders_div($current_page_url)
	{
		$supplier = $this->get_element();
		$database = $supplier->get_database();
		$orders_table = $database->get_table('hpi_shop_orders');

		$all_orders_div = new HTMLTags_Div();
		$all_orders_div->set_attribute_str('id', 'all-orders');
		$all_orders_div->append_tag_to_content(new HTMLTags_Heading(3, $supplier->get_name() . "'s&nbsp;Orders"));

		if ($orders_table->check_for_supplier_in_orders($supplier)) 
		{
			$all_orders_div->append_tag_to_content($this->get_all_orders_table($current_page_url));
		}
		else
		{
			$all_orders_div->append_tag_to_content(
				new HTMLTags_P("There are no orders to display here yet.")
			);
		}
		return $all_orders_div;
	}

	public function
		get_all_orders_table($current_page_url)
	{
		$supplier = $this->get_element();
		$database = $supplier->get_database();
		$orders_table = $database->get_table('hpi_shop_orders');

		$all_orders_table = new HTMLTags_Table();
		$all_orders_table->set_attribute_str('id', 'shopping-basket-table');

		$caption = new HTMLTags_Caption('Your Orders');
		$all_orders_table->append_tag_to_content($caption);

		$thead = new HTMLTags_THead();
		$thead_tr = new HTMLTags_TR();

		$added_th = new HTMLTags_TH('Date of Purchase');
		$id_th = new HTMLTags_TH('Order No.');
		$product_th = new HTMLTags_TH('Product');
		$customer_th = new HTMLTags_TH('Customer');
		$quantity_th = new HTMLTags_TH('Amount');
		$status_th = new HTMLTags_TH('Status');
		$set_status_th = new HTMLTags_TH('Set Status');

		$thead_tr->append_tag_to_content($added_th);
		$thead_tr->append_tag_to_content($id_th);
		$thead_tr->append_tag_to_content($product_th);
		$thead_tr->append_tag_to_content($customer_th);
		$thead_tr->append_tag_to_content($quantity_th);
		$thead_tr->append_tag_to_content($status_th);
		$thead_tr->append_tag_to_content($set_status_th);

		$thead->append_tag_to_content($thead_tr);
		$all_orders_table->append_tag_to_content($thead);

		//                $tfoot = new HTMLTags_TFoot();
		//                $tfoot_tr = new HTMLTags_TR();

		//                $sub_total_th= new HTMLTags_TH('Sub-Total');
		//                $blank_td= new HTMLTags_TD('');
		//                $sub_total_td = new HTMLTags_TD($sub_total_price->get_as_string());
		//                
		//                $tfoot_tr->append_tag_to_content($sub_total_th);
		//                $tfoot_tr->append_tag_to_content($blank_td);
		//                $tfoot_tr->append_tag_to_content($blank_td);
		//                $tfoot_tr->append_tag_to_content($sub_total_td);
		//                $tfoot_tr->append_tag_to_content($blank_td);
		//                
		//                $tfoot->append_tag_to_content($tfoot_tr);
		//                $all_orders_table->append_tag_to_content($tfoot);

		$tbody = new HTMLTags_TBody();

		try 
		{
			$orders = $orders_table->get_orders_for_supplier($supplier, $order_by = 'added');
		} 
		catch (Exception $e) 
		{
			/*
			 * Shouldn't something happen here?
			 */
		}

		#print_r($orders);
		foreach ($orders as $order) 
		{
			$order_renderer = $order->get_renderer();

			$order_tr = 
				$order_renderer
				->get_public_order_supplier_tr($current_page_url);
			$tbody->append_tag_to_content($order_tr);
		}

		$all_orders_table->append_tag_to_content($tbody);
		
		return $all_orders_table;
	}

}
?>
