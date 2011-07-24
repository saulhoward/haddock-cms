<?php
/**
 * Shop_CustomerRowRenderer.inc.php
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

class
	Shop_CustomerRowRenderer
	extends
	Database_RowRenderer
{
	public function
		get_admin_customers_html_table_tr($current_page_url)
	{
		$html_row =  new HTMLTags_TR();

		$row = $this->get_element();

		$table = $row->get_table();
		//        name notes');

		//            foreach ($field_names as $field_name) {
		//                $heading_row->append_sortable_field_name($field_name);
		//            }
		//               
		//           $customer_region_header = new HTMLTags_TH('Currency'); 
		//            $heading_row->append_tag_to_content($customer_region_header);

		//           $address_header = new HTMLTags_TH('Address'); 
		//            $heading_row->append_tag_to_content($address_header);

		//           $email_address_header = new HTMLTags_TH('Email Address'); 
		//            $heading_row->append_tag_to_content($email_address_header);

		//           $telephone_header = new HTMLTags_TH('Telephone'); 
		//            $heading_row->append_tag_to_content($telephone_header);
		/*
		 * The data.
		 */ 

		$added_field = $table->get_field('added');
		$added_td = $this->get_data_html_table_td($added_field);
		$html_row->append_tag_to_content($added_td);

		$full_name_td = $this->get_full_name_td();
		$html_row->append_tag_to_content($full_name_td);

		$address_td = $this->get_address_td();
		$html_row->append_tag_to_content($address_td);

		$email_address_td = $this->get_email_address_td();
		$html_row->append_tag_to_content($email_address_td);

		$telephone_number_td = $this->get_telephone_number_td();
		$html_row->append_tag_to_content($telephone_number_td);

		$customer_region_td = $this->get_customer_region_td();
		$html_row->append_tag_to_content($customer_region_td);

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
		get_customer_region_td()
	{
		$row = $this->get_element();
		if ($row->has_customer_region())
		{
			$row = $this->get_element();
			$customer_region = $row->get_customer_region(); 

			$customer_region_text = '';
			$customer_region_text .= $customer_region->get_name();

			$customer_region_td = new HTMLTags_TD($customer_region_text);
		}
		else
		{
			$customer_region_td = new HTMLTags_TD();
		}
		return $customer_region_td;
	}

	public function
		get_full_name_td()
	{
		$row = $this->get_element();
		$full_name_td = new HTMLTags_TD($row->get_first_name() . '&nbsp;' . $row->get_last_name());
		return $full_name_td;
	}

	public function
		get_address_td()
	{
		$row = $this->get_element();
		if ($row->has_address())
		{
			$address = $row->get_address(); 
			$address_renderer = $address->get_renderer();
			$address_td = $address_renderer->get_short_address_td();
		}
		else
		{
			$address_td = new HTMLTags_TD();
		}
		return $address_td;
	}

	public function
		get_email_address_td()
	{
		$row = $this->get_element();
		//                $email_address = $row->get_email_address(); 

		return new HTMLTags_TD($row->get_email_address());
	}

	public function
		get_telephone_number_td()
	{
		$row = $this->get_element();
		if ($row->has_telephone_number())
		{
			$row = $this->get_element();
			$telephone_number = $row->get_telephone_number(); 
			$telephone_number_td = new HTMLTags_TD($telephone_number->get_telephone_number());
		}
		else
		{
			$telephone_number_td = new HTMLTags_TD();
		}
		return $telephone_number_td;
	}

	public function
		get_checkout_shipping_address_div()
	{
		$customer = $this->get_element();
		$shipping_address = $customer->get_address();
		$shipping_address_renderer = $shipping_address->get_renderer();

		$shipping_address_ul = $shipping_address_renderer->get_short_address_ul();

		$shipping_address_div = new HTMLTags_Div();
		$shipping_address_div->set_attribute_str('id', 'shipping_address');


		$shipping_address_div->append_tag_to_content($shipping_address_ul);

		return $shipping_address_div;
	}

	public function
		get_customer_details_editing_form(
			HTMLTags_URL $form_location,
			HTMLTags_URL $redirect_script_location,
			HTMLTags_URL $desired_location,
			HTMLTags_URL $cancel_page_location
		)
	{
		$customer = $this->get_element();
		$database = $customer->get_database();
		$customers_table = $database->get_table('hpi_shop_customers');
		$telephone_numbers_table = $database->get_table('hpi_shop_telephone_numbers');
		$addresses_table = $database->get_table('hpi_shop_addresses');

		$customer_details_form
			= new HTMLTags_SimpleOLForm('customer_details');

		$customer_details_form->set_attribute_str('id', $this->get_customer_details_form_id());
		$customer_details_form->set_attribute_str(
			'class',
			$this->get_customer_details_form_css_class()
		); 

		$svm = Caching_SessionVarManager::get_instance();

		/*
		 * The action.
		 */
		$customer_details_script_location = clone $redirect_script_location;
		$customer_details_script_location->set_get_variable('customer_details');

		$customer_details_script_location->set_get_variable(
			'desired_location',
			urlencode($desired_location->get_as_string())
		);
		$customer_details_script_location->set_get_variable(
			'form_location',
			urlencode($form_location->get_as_string())
		);

		$customer_details_form->set_action($customer_details_script_location);
		$customer_details_form->set_legend_text($this->get_customer_details_form_legend_text());

		/*
		 * The input tags.
		 */
		/*
		 * The first_name
		 */
		$first_name_field = $customers_table->get_field('first_name');
		$first_name_field_renderer = $first_name_field->get_renderer();
		$input_tag = $first_name_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'first_name');
		$input_tag->set_attribute_str('value', $customer->get_first_name());
		$customer_details_form->add_input_tag(
			'first_name',
			$input_tag
		);        
		/*
		 * The last_name
		 */
		$last_name_field = $customers_table->get_field('last_name');
		$last_name_field_renderer = $last_name_field->get_renderer();
		$input_tag = $last_name_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'last_name');
		$input_tag->set_attribute_str('value', $customer->get_last_name());
		$customer_details_form->add_input_tag(
			'last_name',
			$input_tag
		);        

		/*
		 * The telephone_number
		 */
		$telephone_number_field = $telephone_numbers_table->get_field('telephone_number');
		$telephone_number_field_renderer = $telephone_number_field->get_renderer();
		$input_tag = $telephone_number_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'telephone_number');
		if ($customer->get_telephone_number_id() != 0)
		{
			$telephone_number = $customer->get_telephone_number();
			$input_tag->set_attribute_str('value', $telephone_number->get_telephone_number());
		}
		$customer_details_form->add_input_tag(
			'telephone_number',
			$input_tag
		);

		//                /*
		//                 * The address (to be put striaght into street_address)
		//                 */
		//                $address_li = $this->get_address_form_input_li();
		//                $customer_details_form->add_input_li($address_li);
		/*
		 * The address_street_address
		 */
		$address_field = $addresses_table->get_field('street_address');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'street_address');
		if ($customer->get_address_id() != 0)
		{
			$address = $customer->get_address();
			$input_tag->set_attribute_str('value', $address->get_street_address());
		}
		$customer_details_form->add_input_tag(
			'street_address',
			$input_tag
		);
		/*
		 * The address_locality
		 */
		$address_field = $addresses_table->get_field('locality');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'locality');
		if ($customer->get_address_id() != 0)
		{
			$address = $customer->get_address();
			$input_tag->set_attribute_str('value', $address->get_locality());
		}
		$customer_details_form->add_input_tag(
			'locality',
			$input_tag,
			'City'
		);
		/*
		 * The address_postal_code
		 */
		$address_field = $addresses_table->get_field('postal_code');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'postal_code');
		if ($customer->get_address_id() != 0)
		{
			$address = $customer->get_address();
			$input_tag->set_attribute_str('value', $address->get_postal_code());
		}
		$customer_details_form->add_input_tag(
			'postal_code',
			$input_tag
		);

		/*
		 * The address_country_name
		 */
		$address_field = $addresses_table->get_field('country_name');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'country_name');

		if ($customer->get_address_id() != 0)
		{
			$address = $customer->get_address();
			if ($address->get_country_name() != '')
			{
				$input_tag->set_value($address->get_country_name());
			}
		}
		elseif (isset($_SESSION['customer_region_id']))
		{
			$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
			$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
			$input_tag->set_value($customer_region->get_name());
		}
		$customer_details_form->add_input_tag(
			'country_name',
			$input_tag
		);

		/*
		 * The customer_region_id
		 */
		$customer_region_li = $this->get_customer_region_form_select_li();
		$customer_details_form->add_input_li($customer_region_li);

		/*
		 * The submit button.
		 */
		$customer_details_form->set_submit_text('Confirm');

		/*
		 * The cancel button
		 */
		$cancel_location = clone $redirect_script_location;

		$cancel_location->set_get_variable('cancel');
		$cancel_location->set_get_variable(
			'cancel_page_location',
			urlencode($cancel_page_location->get_as_string())
		);

		$customer_details_form->set_cancel_location($cancel_location);

		return $customer_details_form;
	}

	public function
		get_customer_details_form_id()
	{
		return 'customer-details-form';
	}

	public function
		get_customer_details_form_css_class()
	{
		return 'cmxform';
	}

	public function
		get_customer_details_form_legend_text()
	{
		return 'Shipping Details';
	}

	public function
		get_address_form_input_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Address');
		$input_label->set_attribute_str('for', 'full_address');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_address_form_input());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'full_address' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}

	public function
		get_address_form_input()
	{
		$full_address_form_input = new HTMLTags_TextArea();

		$full_address_form_input->set_attribute_str('cols', 50);
		$full_address_form_input->set_attribute_str('rows', 7);
		$full_address_form_input->set_attribute_str('name', 'full_address');
		$full_address_form_input->set_attribute_str('id', 'full_address');

		$customer = $this->get_element();
		if ($customer->get_address_id() != '')
		{
			$address = $customer->get_address();
			$full_address_form_input->append_str_to_content($address->get_street_address());
		}
		return $full_address_form_input;
	}

	public function
		get_customer_region_form_select_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Shipping Region');
		$input_label->set_attribute_str('for', 'customer_region_id');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_customer_region_form_select());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'customer_region_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}	

	public function
		get_customer_region_form_select()
	{
		$customer = $this->get_element();
		$database = $customer->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_regions = $customer_regions_table->get_all_rows();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'customer_region_id');

		foreach ($customer_regions as $customer_region) 
		{
			$customer_region_text = '';
			$customer_region_text .= $customer_region->get_name();

			$option = new HTMLTags_Option($customer_region_text);
			$option->set_attribute_str('value', $customer_region->get_id());
			$select->add_option($option);
		}
		if (isset($_SESSION['customer_region_id']))
		{
			$select->set_value($_SESSION['customer_region_id']);
		}
		return $select;
	}

	public function
		get_customer_details_display_div(
			HTMLTags_URL $redirect_script_location,
			HTMLTags_URL $desired_location
		)
	{
		$customer_details_div = new HTMLTags_Div();
		$customer_details_div->set_attribute_str('id', 'shipping-details-confirmation');
		$customer_details_div->append_tag_to_content(new HTMLTags_Heading(3, 'Shipping Details'));

		$customer_details_div->append_tag_to_content($this->get_customer_hcard());

		$edit_details_link = new HTMLTags_A('Edit Shipping Details');

		$edit_details_action = clone $redirect_script_location;
		$edit_details_action->set_get_variable('edit_customer_details', 1);
		$edit_details_action->set_get_variable(
			'desired_location',
			urlencode($desired_location->get_as_string())
		);
		$edit_details_link->set_href($edit_details_action);
		$edit_details_link->set_attribute_str('class', 'edit-shipping-details');

		$customer_details_div->append_tag_to_content($edit_details_link);

		return $customer_details_div;
	}

	public function
		get_customer_hcard()
	{
		$customer = $this->get_element();
		$address = $customer->get_address();
		$telephone_number = $customer->get_telephone_number();

		//<div class="vcard">
		//  <div class="fn org">Wikimedia Foundation Inc.</div>
		//  <div class="adr">
		//    <div class="street-address">200 2nd Ave. South #358</div>
		//    <div>
		//      <span class="locality">St. Petersburg</span>, 
		//      <abbr class="region" title="Florida">FL</abbr> <span class="postal-code">33701-4313</span>
		//    </div>
		//    <div class="country-name">USA</div>
		//    </div>
		//  <div>Phone: <span class="tel">+1-727-231-0101</span></div>
		//  <div>Email: <span class="email">info@wikimedia.org</span></div>
		//  <div>
		//    <span class="tel"><span class="type">Fax</span>: 
		//    <span class="value">+1-727-258-0207</span></span>
		//  </div>
		//  </div>
		$hcard_div = new HTMLTags_DIV();
		$hcard_div->set_attribute_str('class', 'vcard');

		$fn_div = new HTMLTags_DIV();
		$fn_div->set_attribute_str('class', 'fn');
		$fn_div->append_str_to_content($customer->get_first_name() . '&nbsp;' . $customer->get_last_name());

		$hcard_div->append_tag_to_content($fn_div);

		$adr_div = new HTMLTags_DIV();
		$adr_div->set_attribute_str('class', 'adr');

		$street_address_div = new HTMLTags_DIV();
		$street_address_div->set_attribute_str('class', 'street-address');
		$street_address_div->append_str_to_content($address->get_street_address() . ',');
		$adr_div->append_tag_to_content($street_address_div);

		$further_address_div = new HTMLTags_DIV();

		$locality_span = new HTMLTags_Span();
		$locality_span->set_attribute_str('class', 'locality');
		$locality_span->append_str_to_content($address->get_locality());
		$further_address_div->append_tag_to_content($locality_span);

		$region_span = new HTMLTags_Span();
		$region_span->set_attribute_str('class', 'region');
		$region_span->append_str_to_content($address->get_region());
		$further_address_div->append_tag_to_content($region_span);

		$postal_code_span = new HTMLTags_Span();
		$postal_code_span->set_attribute_str('class', 'postal_code');
		$postal_code_span->append_str_to_content($address->get_postal_code());
		$further_address_div->append_tag_to_content($postal_code_span);

		$adr_div->append_tag_to_content($further_address_div);

		$country_name_div = new HTMLTags_DIV();
		$country_name_div->set_attribute_str('class', 'country-name');
		$country_name_div->append_str_to_content($address->get_country_name());

		$adr_div->append_tag_to_content($country_name_div);

		$hcard_div->append_tag_to_content($adr_div);

		$phone_div = new HTMLTags_DIV();
		$phone_div->append_str_to_content('Phone:&nbsp;');
		$phone_span = new HTMLTags_Span($telephone_number->get_telephone_number());
		$phone_span->set_attribute_str('class', 'tel');
		$phone_div->append_tag_to_content($phone_span);
		$hcard_div->append_tag_to_content($phone_div);

		$email_div = new HTMLTags_DIV();
		$email_div->append_str_to_content('Email:&nbsp;');
		$email_span = new HTMLTags_Span($customer->get_email_address());
		$email_span->set_attribute_str('class', 'email');
		$email_div->append_tag_to_content($email_span);
		$hcard_div->append_tag_to_content($email_div);

		return $hcard_div;
	}

	public function
		get_all_orders_div()
	{
		$customer = $this->get_element();
		$database = $customer->get_database();
		$orders_table = $database->get_table('hpi_shop_orders');

		$all_orders_div = new HTMLTags_Div();
		$all_orders_div->set_attribute_str('id', 'all-orders');
		$all_orders_div->append_tag_to_content(new HTMLTags_Heading(3, 'Your Orders'));

		if ($orders_table->check_for_customer_in_orders($customer)) 
		{
			$all_orders_div->append_tag_to_content($this->get_all_orders_table());
		}
		else
		{
			$all_orders_div->append_tag_to_content(
				new HTMLTags_P("There are no orders to display here yet. If you expected to see an order here, it's likely that your order is still being processed.")
			);
		}

		//                $edit_details_link = new HTMLTags_A('Edit Shipping Details');

		//                $edit_details_action = clone $redirect_script_location;
		//                $edit_details_action->set_get_variable('edit_all_orders', 1);
		//                $edit_details_action->set_get_variable(
		//                        'desired_location',
		//                        urlencode($desired_location->get_as_string())
		//                );
		//                $edit_details_link->set_href($edit_details_action);
		//                $edit_details_link->set_attribute_str('class', 'edit-shipping-details');

		//                $all_orders_div->append_tag_to_content($edit_details_link);

		return $all_orders_div;
	}

	public function
		get_all_orders_table()
	{
		$customer = $this->get_element();
		$database = $customer->get_database();
		$orders_table = $database->get_table('hpi_shop_orders');

		$all_orders_table = new HTMLTags_Table();
		$all_orders_table->set_attribute_str('id', 'shopping-basket-table');

		$caption = new HTMLTags_Caption('Your Orders');
		$all_orders_table->append_tag_to_content($caption);

		$thead = new HTMLTags_THead();
		$thead_tr = new HTMLTags_TR();

		$added_th = new HTMLTags_TH('Date of Purchase');
		$id_th = new HTMLTags_TH('Order No.');
//                $product_th = new HTMLTags_TH('Product');
//                $price_th = new HTMLTags_TH('Price');
//                $quantity_th = new HTMLTags_TH('Amount');
		$status_th = new HTMLTags_TH('Status');

		$thead_tr->append_tag_to_content($added_th);
		$thead_tr->append_tag_to_content($id_th);
//                $thead_tr->append_tag_to_content($product_th);
//                $thead_tr->append_tag_to_content($price_th);
//                $thead_tr->append_tag_to_content($quantity_th);
		$thead_tr->append_tag_to_content($status_th);

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
		//                
		$tbody = new HTMLTags_TBody();

		try 
		{
			$orders = $orders_table->get_orders_for_customer($customer, $order_by = 'added');
		} 
		catch (Exception $e) 
		{
			/*
			 * Shouldn't something happen here?
			 */
		}

		foreach ($orders as $order) {
			$order_renderer = $order->get_renderer();

			$order_tr = 
				$order_renderer
				->get_public_order_tr();
			$tbody->append_tag_to_content($order_tr);
		}

		$all_orders_table->append_tag_to_content($tbody);
		
		return $all_orders_table;
	}
}
?>
