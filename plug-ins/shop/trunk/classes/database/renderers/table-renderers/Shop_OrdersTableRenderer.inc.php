<?php
/**
 * Shop_OrdersTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

class
	Shop_OrdersTableRenderer
	extends
	Database_TableRenderer
{
	public function get_all_orders_ul_in_public()
	{
		$orders_table = $this->get_element();

		$orders_ul = new HTMLTags_UL();

		$conditions['status'] = 'display';
		$rows = $orders_table->get_rows_where($conditions, 'added', DESC, 0, 0);

		#print_r($rows);

		foreach ($rows as $row) {
			$row_renderer = $row->get_renderer();

			$order_description_li =
				$row_renderer->get_order_description_li();
			$orders_ul->append_tag_to_content($order_description_li);
		}

		return $orders_ul;
	}

	public function get_mini_orders_for_current_session_div()
	{
		$mini_order_div = new HTMLTags_Div();

		$top_right_p = new HTMLTags_P('Shopping Basket');
		$top_right_p->set_attribute_str('class', 'top-right');
		$mini_order_div->append_tag_to_content($top_right_p);

		$mini_order_table = 
			$this->get_mini_orders_for_current_session_table();

		$middle_right_div = new HTMLTags_Div();
		$middle_right_div->set_attribute_str('class', 'middle-right');

		$middle_right_div->append_tag_to_content($mini_order_table);

		$mini_order_div->append_tag_to_content($middle_right_div);
		$bottom_left_div = new HTMLTags_Div();
		$bottom_left_div->set_attribute_str('class', 'bottom-left');
		$bottom_right_p = new HTMLTags_P();
		$bottom_right_p->set_attribute_str('class', 'bottom-right');

		$go_to_basket_link = new HTMLTags_A();
		$go_to_basket_link->set_attribute_str('class', 'add-to-basket-link');
		$go_to_basket_link->set_attribute_str('id', 'add-to-basket-link');

		$go_to_basket_location = new HTMLTags_URL();

		$go_to_basket_location->set_file('/shopping-basket.html');

		$go_to_basket_link->set_href($go_to_basket_location);
		$go_to_basket_link->append_tag_to_content(new HTMLTags_Span('Go to Basket'));

		$bottom_right_p->append_tag_to_content($go_to_basket_link);
		$bottom_left_div->append_tag_to_content($bottom_right_p);

		$mini_order_div->append_tag_to_content($bottom_left_div);

		return $mini_order_div;
	}

	public function get_mini_orders_for_current_session_table()
	{
		$orders_table = $this->get_element();

		$mini_order_table = new HTMLTags_Table();
		$mini_order_table->set_attribute_str('id', 'mini-shopping-basket-table');

		$caption = new HTMLTags_Caption('Your Shopping Basket');
		$mini_order_table->append_tag_to_content($caption);

		$thead = new HTMLTags_THead();
		$thead_tr = new HTMLTags_TR();

		$name_th = new HTMLTags_TH('Name');
		$price_th = new HTMLTags_TH('Price');
		$quantity_th = new HTMLTags_TH('Qty.');
		$sub_total_th = new HTMLTags_TH('Sub-Total');

		$thead_tr->append_tag_to_content($name_th);
		$thead_tr->append_tag_to_content($price_th);
		$thead_tr->append_tag_to_content($quantity_th);
		$thead_tr->append_tag_to_content($sub_total_th);

		$thead->append_tag_to_content($thead_tr);
		$mini_order_table->append_tag_to_content($thead);


		$tfoot = new HTMLTags_TFoot();
		$tfoot_tr = new HTMLTags_TR();

		$sub_total_th= new HTMLTags_TH('Sub-Total');
		$blank_td= new HTMLTags_TD('');
		$sub_total_td = new HTMLTags_TD($orders_table
			->get_sub_total_for_current_session());

		$tfoot_tr->append_tag_to_content($sub_total_th);
		$tfoot_tr->append_tag_to_content($blank_td);
		$tfoot_tr->append_tag_to_content($blank_td);
		$tfoot_tr->append_tag_to_content($sub_total_td);

		$tfoot->append_tag_to_content($tfoot_tr);
		$mini_order_table->append_tag_to_content($tfoot);


		$tbody = new HTMLTags_TBody();

		if ($orders_table->check_for_current_session_in_orders())
		{
			try
			{
				$orders = 
					$orders_table
					->get_orders_for_current_session();

			}
			catch (Exception $e)
			{

			}
			foreach ($orders as $order)
			{
				$order_renderer = $order->get_renderer();

				$order_tr = 
					$order_renderer
					->get_mini_order_tr();
				$tbody->append_tag_to_content($order_tr);

			}
		}
		$mini_order_table->append_tag_to_content($tbody);

		return $mini_order_table;
	}

	public function
		get_full_orders_for_current_session_div()
	{
		$orders_table = $this->get_element();
		$full_order_div = new HTMLTags_Div();

		if ($orders_table->check_for_current_session_in_orders())
		{
			$full_order_table = 
				$this->get_full_orders_for_current_session_table();
			$full_order_div->append_tag_to_content($full_order_table);
		}
		else
		{
			$empty_basket_p = new HTMLTags_P('The Shopping Basket is empty.');

			$full_order_div->append_tag_to_content($empty_basket_p);
		}
		return $full_order_div;
	}


	public function get_full_orders_for_current_session_table()
	{
		$orders_table = $this->get_element();

		$full_order_table = new HTMLTags_Table();
		$full_order_table->set_attribute_str('id', 'shopping-basket-table');

		$caption = new HTMLTags_Caption('Your Shopping Basket');
		$full_order_table->append_tag_to_content($caption);

		$thead = new HTMLTags_THead();
		$thead_tr = new HTMLTags_TR();

		$name_th = new HTMLTags_TH('Name');
		$price_th = new HTMLTags_TH('Unit Price');
		$quantity_th = new HTMLTags_TH('Amount');
		$sub_total_th = new HTMLTags_TH('Sub-Total');
		$delete_th = new HTMLTags_TH('Action');

		$thead_tr->append_tag_to_content($name_th);
		$thead_tr->append_tag_to_content($price_th);
		$thead_tr->append_tag_to_content($quantity_th);
		$thead_tr->append_tag_to_content($sub_total_th);
		$thead_tr->append_tag_to_content($delete_th);

		$thead->append_tag_to_content($thead_tr);
		$full_order_table->append_tag_to_content($thead);


		$tfoot = new HTMLTags_TFoot();
		$tfoot_tr = new HTMLTags_TR();

		$sub_total_th= new HTMLTags_TH('Sub-Total');
		$blank_td= new HTMLTags_TD('');
		$sub_total_td = new HTMLTags_TD($orders_table
			->get_sub_total_for_current_session());

		$tfoot_tr->append_tag_to_content($sub_total_th);
		$tfoot_tr->append_tag_to_content($blank_td);
		$tfoot_tr->append_tag_to_content($blank_td);
		$tfoot_tr->append_tag_to_content($sub_total_td);
		$tfoot_tr->append_tag_to_content($blank_td);

		$tfoot->append_tag_to_content($tfoot_tr);
		$full_order_table->append_tag_to_content($tfoot);


		$tbody = new HTMLTags_TBody();

		if ($orders_table->check_for_current_session_in_orders())
		{
			try
			{
				$orders = 
					$orders_table
					->get_orders_for_current_session();

			}
			catch (Exception $e)
			{

			}
			foreach ($orders as $order)
			{
				$order_renderer = $order->get_renderer();

				$order_tr = 
					$order_renderer
					->get_full_order_tr();
				$tbody->append_tag_to_content($order_tr);

			}
		}
		$full_order_table->append_tag_to_content($tbody);

		return $full_order_table;
	}

	public function
		get_checkout_order_for_current_session_div()
	{
		$checkout_div = new HTMLTags_Div();

		$checkout_table = 
			$this->get_checkout_order_for_current_session_table();
		$checkout_div->append_tag_to_content($checkout_table);

		return $checkout_div;
	}

	public function
		get_checkout_order_for_current_session_table()
	{

		$orders_table = $this->get_element();
		$database = $orders_table->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');

		$orders_table = $this->get_element();

		$checkout_order_table = new HTMLTags_Table();
		$caption = new HTMLTags_Caption('Your Shopping Basket');
		$checkout_order_table->append_tag_to_content($caption);

		// THEAD
		$thead = new HTMLTags_THead();
		$thead_tr = new HTMLTags_TR();

		$name_th = new HTMLTags_TH('Name');
		$price_th = new HTMLTags_TH('Unit Price');
		$quantity_th = new HTMLTags_TH('Amount');
		$sub_total_th = new HTMLTags_TH('Sub-Total');

		$thead_tr->append_tag_to_content($name_th);
		$thead_tr->append_tag_to_content($price_th);
		$thead_tr->append_tag_to_content($quantity_th);
		$thead_tr->append_tag_to_content($sub_total_th);

		$thead->append_tag_to_content($thead_tr);
		$checkout_order_table->append_tag_to_content($thead);

		// TFOOT
		$tfoot = new HTMLTags_TFoot();
		$blank_td= new HTMLTags_TD('');
		// TFOOT - sub-total-tr
		$tfoot_sub_total_tr = new HTMLTags_TR();
		$sub_total_th= new HTMLTags_TH('Sub-Total');
		$sub_total_td = new HTMLTags_TD($orders_table
			->get_sub_total_for_current_session());

		$tfoot_sub_total_tr->append_tag_to_content($blank_td);
		$tfoot_sub_total_tr->append_tag_to_content($blank_td);
		$tfoot_sub_total_tr->append_tag_to_content($sub_total_th);
		$tfoot_sub_total_tr->append_tag_to_content($sub_total_td);

		$tfoot->append_tag_to_content($tfoot_sub_total_tr);

		// TFOOT - shipping-tr
		$tfoot_shipping_tr = new HTMLTags_TR();
		$shipping_th= new HTMLTags_TH('Shipping');
		$shipping_td = new HTMLTags_TD($orders_table
			->get_shipping_total_for_current_session());

		$tfoot_shipping_tr->append_tag_to_content($blank_td);
		$tfoot_shipping_tr->append_tag_to_content($blank_td);
		$tfoot_shipping_tr->append_tag_to_content($shipping_th);
		$tfoot_shipping_tr->append_tag_to_content($shipping_td);

		$tfoot->append_tag_to_content($tfoot_shipping_tr);


		// TFOOT - total-tr
		$tfoot_total_tr = new HTMLTags_TR();
		$total_th= new HTMLTags_TH('Total');
		$total_td = new HTMLTags_TD($orders_table
			->get_total_for_current_session($shipping_location));

		$tfoot_total_tr->append_tag_to_content($blank_td);
		$tfoot_total_tr->append_tag_to_content($blank_td);
		$tfoot_total_tr->append_tag_to_content($total_th);
		$tfoot_total_tr->append_tag_to_content($total_td);

		$tfoot->append_tag_to_content($tfoot_total_tr);


		$checkout_order_table->append_tag_to_content($tfoot);

		// TBODY
		$tbody = new HTMLTags_TBody();
		try
		{
			$orders = 
				$orders_table
				->get_orders_for_current_session();

		}
		catch (Exception $e)
		{

		}
		if (count($orders) > 0)
		{
			foreach ($orders as $order)
			{
				$order_renderer = $order->get_renderer();

				$order_tr = 
					$order_renderer
					->get_checkout_order_tr();
				$tbody->append_tag_to_content($order_tr);

			}
		}
		$checkout_order_table->append_tag_to_content($tbody);

		return $checkout_order_table;

	}

	public function
		get_checkout_shipping_location_choice_for_current_session_div
		(
			HTMLTags_URL $action
		)
	{
//                $locations = $this->get_shipping_locations();

//                $shipping_location_div = new HTMLTags_Div();

//                $location_form = new HTMLTags_Form();

//                $location_form->set_attribute_str('name', 'shipping_location');
//                $location_form->set_action($action);
//                $location_form->set_attribute_str('method', 'POST');

//                $select = new HTMLTags_Select();

//                $select->set_attribute_str('name', 'shipping_location');

//                foreach ($locations as $location) {
//                        $option = new HTMLTags_Option($location['text']);

//                        $option->set_attribute_str('value', $location['title']);

//                        $select->add_option($option);
//                }

//                 Set Default Select
//                if ($shipping_location == '')
//                {
//                        $select->set_value('uk');
//                }
//                else
//                {
//                        $select->set_value($shipping_location);
//                }	

//                $location_form->append_tag_to_content($select);

//                $submit = new HTMLTags_Input();
//                $submit->set_attribute_str('type', 'submit');
//                $submit->set_attribute_str('value', 'Go');

//                $location_form->append_tag_to_content($submit);
//                $shipping_location_div->append_tag_to_content($location_form);


//                return $shipping_location_div;
		$orders_table = $this->get_element();
		$database = $orders_table->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_regions = $customer_regions_table->get_all_rows('sort_order', 'ASC');

		$customer_regions_div = new HTMLTags_Div();

		$location_form = new HTMLTags_Form();

		$location_form->set_attribute_str('name', 'shipping_location');
		$location_form->set_action($action);
		$location_form->set_attribute_str('method', 'POST');


		$select = new HTMLTags_Select();

		$select->set_attribute_str('name', 'customer_region');

		foreach ($customer_regions as $customer_region)
		{
			$option = new HTMLTags_Option($customer_region->get_name());
			$option->set_attribute_str('value', $customer_region->get_id());
			$select->add_option($option);
		}
		if (isset($_SESSION['customer_region_id']))
		{
			$select->set_value($_SESSION['customer_region_id']);
		}
  
		$location_form->append_tag_to_content($select);

		$submit = new HTMLTags_Input();
		$submit->set_attribute_str('type', 'submit');
		$submit->set_attribute_str('value', 'Change');

		$location_form->append_tag_to_content($submit);

		$customer_regions_div->append_tag_to_content($location_form);

		if (isset($_SESSION['customer_region_id']))
		{
			$selected_customer_region = 
				$customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);

			$customer_region_description_div = new HTMLTags_P($selected_customer_region->get_description());
			$customer_regions_div->append_tag_to_content($customer_region_description_div);
		}

		return $customer_regions_div;
	}


	public function
		get_order_checkout_links_ul()
	{
		$orders_table = $this->get_element();
		$product_links_ul = new HTMLTags_UL();
		$product_links_ul->set_attribute_str('id', 'shopping-basket-ul');

		if ($orders_table->check_for_current_session_in_orders())
		{

			$checkout_link = new HTMLTags_A();
			$checkout_link->append_tag_to_content(new HTMLTags_Span('Checkout'));
			$checkout_location = new HTMLTags_URL();
			$checkout_location->set_file('/checkout.html');
			$checkout_link->set_href($checkout_location);
			$checkout_li = new HTMLTags_LI();
			$checkout_li->set_attribute_str('class', 'checkout');
			$checkout_li->append_tag_to_content($checkout_link);

			$product_links_ul->append_tag_to_content($checkout_li);

		}
		$all_products_link = new HTMLTags_A('See All Products');
		$all_products_location = new HTMLTags_URL();
		$all_products_location->set_file('/products.html');
		$all_products_link->set_href($all_products_location);
		$all_products_li = new HTMLTags_LI();
		$all_products_li->set_attribute_str('class', 'all-products');
		$all_products_li->append_tag_to_content($all_products_link);

		$product_links_ul->append_tag_to_content($all_products_li);

		return $product_links_ul;
	}


	public function
		get_checkout_shipping_address_form_div()
	{
		$shipping_address_form_div = new HTMLTags_Div();

		$cancel_href = new HTMLTags_URL();
		$cancel_href->set_file('/checkout.html');

		$redirect_script_url = new HTMLTags_URL();
		$redirect_script_url->set_file('/');
		$redirect_script_url->set_get_variable('page', 'checkout');
		$redirect_script_url->set_get_variable('type', 'redirect-script');
		$redirect_script_url->set_get_variable('add_order', 1);

		$row_adding_form = 
			$this
			->get_checkout_shipping_address_adding_form($redirect_script_url, $cancel_href);

		$shipping_address_form_div->append_tag_to_content($row_adding_form);

		return $shipping_address_form_div;
	}

	public function
		get_checkout_shipping_address_adding_form($redirect_script_url, $cancel_url)
	{
		$orders_table = $this->get_element();
		$database = $orders_table->get_database();

		$customers_table =  $database->get_table('hpi_shop_customers');
		$customers_table_renderer = $customers_table->get_renderer();
		$email_addresses_table = $database->get_table('hpi_shop_email_addresses');
		$telephone_numbers_table = $database->get_table('hpi_shop_telephone_numbers');
		$addresses_table = $database->get_table('hpi_shop_addresses');

		$customer_adding_form = new HTMLTags_SimpleOLForm('order_adding');

		$customer_adding_form->set_action($redirect_script_url);

		$customer_adding_form->set_legend_text('Add your order');

		# The Fields:
		//$last_added_id = $customers_table->add_customer(
		//            $_POST['name'],
		//            $_POST['customer_region_id'],
		//            $_POST['email_address'],
		//            $_POST['telephone_number'],
		//            $_POST['post_office_box'],
		//            $_POST['extended_address'],
		//            $_POST['street_address'],
		//            $_POST['locality'],
		//            $_POST['region'],
		//            $_POST['postal_code'],
		//            $_POST['country_name'],
		//            $_POST['customer_region_id'] = $_SESSION['customer_region_id']
		//        );
		/*
		 * The name
		 */
		$name_field = $customers_table->get_field('name');
		$name_field_renderer = $name_field->get_renderer();
		$input_tag = $name_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'name');
		$customer_adding_form->add_input_tag(
			'name',
			$input_tag
		);        

//                /*
//                 * The customer_region_id
//                 */
		$customer_region_li = $customers_table_renderer->get_customer_region_form_select_li();

//                $customer_region_select_li = $this->get_customer_region_form_select_li();
//                $customer_adding_form->append_tag_to_content($customer_region_select_li);
		$customer_adding_form->add_input_li($customer_region_li);
		/*
		 * The email_address
		 */
		$email_address_field = $email_addresses_table->get_field('email_address');
		$email_address_field_renderer = $email_address_field->get_renderer();
		$input_tag = $email_address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'email_address');
		$customer_adding_form->add_input_tag(
			'email_address',
			$input_tag
		);
		/*
		 * The telephone_number
		 */
		$telephone_number_field = $telephone_numbers_table->get_field('telephone_number');
		$telephone_number_field_renderer = $telephone_number_field->get_renderer();
		$input_tag = $telephone_number_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'telephone_number');
		$customer_adding_form->add_input_tag(
			'telephone_number',
			$input_tag
		);
		/*
		 * The address_post_office_box
		 */
		$address_field = $addresses_table->get_field('post_office_box');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'address_post_office_box');
		$customer_adding_form->add_input_tag(
			'address_post_office_box',
			$input_tag
		);
		/*
		 * The address_extended_address
		 */
		$address_field = $addresses_table->get_field('extended_address');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'extended_address');
		$customer_adding_form->add_input_tag(
			'extended_address',
			$input_tag
		);
		/*
		 * The address_street_address
		 */
		$address_field = $addresses_table->get_field('street_address');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'street_address');
		$customer_adding_form->add_input_tag(
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
		$customer_adding_form->add_input_tag(
			'locality',
			$input_tag
		);
		/*
		 * The address_region
		 */
		$address_field = $addresses_table->get_field('region');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'region');
		$customer_adding_form->add_input_tag(
			'region',
			$input_tag
		);
		/*
		 * The address_postal_code
		 */
		$address_field = $addresses_table->get_field('postal_code');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'postal_code');
		$customer_adding_form->add_input_tag(
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
		$customer_adding_form->add_input_tag(
			'country_name',
			$input_tag
		);

		/*
		 * The add button.
		 */
		$customer_adding_form->set_submit_text('Add');

		$customer_adding_form->set_cancel_location($cancel_url);

		return $customer_adding_form;



	}

}
?>
