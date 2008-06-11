<?php
/**
 * Shop_ShoppingBasketsTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

class
	Shop_ShoppingBasketsTableRenderer
extends
	Database_TableRenderer
{
	public function get_all_shopping_baskets_ul_in_public()
	{
		$shopping_baskets_table = $this->get_element();

		$shopping_baskets_ul = new HTMLTags_UL();

		$conditions['status'] = 'display';
		$rows = $shopping_baskets_table->get_rows_where($conditions, 'added', DESC, 0, 0);

		#print_r($rows);

		foreach ($rows as $row) {
			$row_renderer = $row->get_renderer();

			$shopping_basket_description_li =
				$row_renderer->get_shopping_basket_description_li();
			$shopping_baskets_ul->append_tag_to_content($shopping_basket_description_li);
		}

		return $shopping_baskets_ul;
	}

	public function get_mini_shopping_baskets_for_current_session_div()
	{

		$page_manager = PublicHTML_PageManager::get_instance();

		$mini_shopping_basket_div = new HTMLTags_Div();

		$top_right_p = new HTMLTags_P('Shopping Basket');
		$top_right_p->set_attribute_str('class', 'top-right');
		$mini_shopping_basket_div->append_tag_to_content($top_right_p);

		$mini_shopping_basket_table = 
			$this->get_mini_shopping_baskets_for_current_session_table();

		$middle_right_div = new HTMLTags_Div();
		$middle_right_div->set_attribute_str('class', 'middle-right');

		$middle_right_div->append_tag_to_content($mini_shopping_basket_table);

		$mini_shopping_basket_div->append_tag_to_content($middle_right_div);
		$bottom_left_div = new HTMLTags_Div();
		$bottom_left_div->set_attribute_str('class', 'bottom-left');
		$bottom_right_p = new HTMLTags_P();
		$bottom_right_p->set_attribute_str('class', 'bottom-right');

		$basket_and_checkout_links_ul = new HTMLTags_UL();
		$basket_link_li = new HTMLTags_LI();

		$go_to_basket_link = new HTMLTags_A();
		$go_to_basket_link->set_attribute_str('class', 'mini-shopping-basket-add-to-basket-link');
		$go_to_basket_link->set_attribute_str('id', 'mini-shopping-basket-add-to-basket-link');

		$go_to_basket_location = new HTMLTags_URL();

		$go_to_basket_location->set_file('/hpi/shop/shopping-basket.html');

		$go_to_basket_link->set_href($go_to_basket_location);
		$go_to_basket_link->append_tag_to_content(new HTMLTags_Span('Go to Basket'));

		$basket_link_li->append_tag_to_content($go_to_basket_link);
		$basket_and_checkout_links_ul->append_tag_to_content($basket_link_li); 

		if ($page_manager->get_page() != 'checkout') 
		{
			$checkout_link_li = new HTMLTags_LI();
			$go_to_checkout_link = new HTMLTags_A();
			$go_to_checkout_link->set_attribute_str('class', 'mini-shopping-basket-go-to-checkout-link');
			$go_to_checkout_link->set_attribute_str('id', 'mini-shopping-basket-go-to-checkout-link');

			$go_to_checkout_location = new HTMLTags_URL();

			$go_to_checkout_location->set_file('/hpi/shop/checkout.html');

			$go_to_checkout_link->set_href($go_to_checkout_location);
			$go_to_checkout_link->append_tag_to_content(new HTMLTags_Span('Go to Checkout'));

			$checkout_link_li->append_tag_to_content($go_to_checkout_link);
			$basket_and_checkout_links_ul->append_tag_to_content($checkout_link_li); 

		}
//                $bottom_right_p->append_tag_to_content($go_to_basket_link);
//                $bottom_right_p->append_tag_to_content($go_to_checkout_link);
//                $bottom_right_p->append_tag_to_content($basket_and_checkout_links_ul);
		$middle_right_div->append_tag_to_content($basket_and_checkout_links_ul);
		$bottom_left_div->append_tag_to_content($bottom_right_p);

		$mini_shopping_basket_div->append_tag_to_content($bottom_left_div);

		return $mini_shopping_basket_div;
	}

	public function get_mini_shopping_baskets_for_current_session_table()
	{
		$shopping_baskets_table = $this->get_element();
		$database = $shopping_baskets_table->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
		$currency = $customer_region->get_currency();

		$sub_total_price = new Shop_SumOfMoney(
			$shopping_baskets_table->get_sub_total_for_current_session(), $currency
		);

		$mini_shopping_basket_table = new HTMLTags_Table();
		$mini_shopping_basket_table->set_attribute_str('id', 'mini-shopping-basket-table');

		$caption = new HTMLTags_Caption('Your Shopping Basket');
		$mini_shopping_basket_table->append_tag_to_content($caption);

		$thead = new HTMLTags_THead();
		$thead_tr = new HTMLTags_TR();

		$name_th = new HTMLTags_TH('Name');
//                $price_th = new HTMLTags_TH('Price');
		$quantity_th = new HTMLTags_TH('Qty.');
		$sub_total_th = new HTMLTags_TH('Sub-Total');

		$thead_tr->append_tag_to_content($name_th);
//                $thead_tr->append_tag_to_content($price_th);
		$thead_tr->append_tag_to_content($quantity_th);
		$thead_tr->append_tag_to_content($sub_total_th);

		$thead->append_tag_to_content($thead_tr);
		$mini_shopping_basket_table->append_tag_to_content($thead);


		$tfoot = new HTMLTags_TFoot();
		$tfoot_tr = new HTMLTags_TR();

		$sub_total_th= new HTMLTags_TH('Sub-Total');
		$blank_td= new HTMLTags_TD('');
		$sub_total_td = new HTMLTags_TD($sub_total_price->get_as_string());

		$tfoot_tr->append_tag_to_content($sub_total_th);
		$tfoot_tr->append_tag_to_content($blank_td);
//                $tfoot_tr->append_tag_to_content($blank_td);
		$tfoot_tr->append_tag_to_content($sub_total_td);

		$tfoot->append_tag_to_content($tfoot_tr);
		$mini_shopping_basket_table->append_tag_to_content($tfoot);


		$tbody = new HTMLTags_TBody();

		if ($shopping_baskets_table->check_for_current_session_in_shopping_baskets())
		{
			try
			{
				$shopping_baskets = 
					$shopping_baskets_table
					->get_shopping_baskets_for_current_session();

			}
			catch (Exception $e)
			{

			}
			foreach ($shopping_baskets as $shopping_basket)
			{
				$shopping_basket_renderer = $shopping_basket->get_renderer();

				$shopping_basket_tr = 
					$shopping_basket_renderer
					->get_mini_shopping_basket_tr();
				$tbody->append_tag_to_content($shopping_basket_tr);

			}
		}
		$mini_shopping_basket_table->append_tag_to_content($tbody);

		return $mini_shopping_basket_table;
	}

	public function
		get_full_shopping_baskets_for_current_session_div()
	{
		$shopping_baskets_table = $this->get_element();
		$full_shopping_basket_div = new HTMLTags_Div();

		if ($shopping_baskets_table->check_for_current_session_in_shopping_baskets())
		{
			$full_shopping_basket_table = 
				$this->get_full_shopping_baskets_for_current_session_table();
			$full_shopping_basket_div->append_tag_to_content($full_shopping_basket_table);
		}
		else
		{
			$empty_basket_p = new HTMLTags_P('The Shopping Basket is empty.');

			$full_shopping_basket_div->append_tag_to_content($empty_basket_p);
		}
		return $full_shopping_basket_div;
	}
	
	/**
	 * Gets the table containing the items in the current shopping basket.
	 */
	public function
		get_full_shopping_baskets_for_current_session_table()
	{
		$shopping_baskets_table = $this->get_element();
		
		$database = $shopping_baskets_table->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
		$currency = $customer_region->get_currency();

		$sub_total_price = new Shop_SumOfMoney(
			$shopping_baskets_table->get_sub_total_for_current_session(), $currency
		);

		$full_shopping_basket_table = new HTMLTags_Table();
		$full_shopping_basket_table->set_attribute_str('id', 'shopping-basket-table');

		$caption = new HTMLTags_Caption('Your Shopping Basket');
		$full_shopping_basket_table->append_tag_to_content($caption);

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
		$full_shopping_basket_table->append_tag_to_content($thead);

		$tfoot = new HTMLTags_TFoot();
		$tfoot_tr = new HTMLTags_TR();

		$sub_total_th= new HTMLTags_TH('Sub-Total');
		$blank_td= new HTMLTags_TD('');
		$sub_total_td = new HTMLTags_TD($sub_total_price->get_as_string());
		
		$tfoot_tr->append_tag_to_content($sub_total_th);
		$tfoot_tr->append_tag_to_content($blank_td);
		$tfoot_tr->append_tag_to_content($blank_td);
		$tfoot_tr->append_tag_to_content($sub_total_td);
		$tfoot_tr->append_tag_to_content($blank_td);
		
		$tfoot->append_tag_to_content($tfoot_tr);
		$full_shopping_basket_table->append_tag_to_content($tfoot);
		
		$tbody = new HTMLTags_TBody();
		
		if ($shopping_baskets_table->check_for_current_session_in_shopping_baskets()) {
			try {
				$shopping_baskets = 
					$shopping_baskets_table
						->get_shopping_baskets_for_current_session();
			} catch (Exception $e) {
				/*
				 * Shouldn't something happen here?
				 */
			}
			
			foreach ($shopping_baskets as $shopping_basket) {
				$shopping_basket_renderer = $shopping_basket->get_renderer();
				
				$shopping_basket_tr = 
					$shopping_basket_renderer
						->get_full_shopping_basket_tr();
				$tbody->append_tag_to_content($shopping_basket_tr);
			}
		}
		
		$full_shopping_basket_table->append_tag_to_content($tbody);
		
		return $full_shopping_basket_table;
	}

	public function
		get_checkout_shopping_basket_for_current_session_div()
	{
		$checkout_div = new HTMLTags_Div();

		$checkout_table = 
			$this->get_checkout_shopping_basket_for_current_session_table();
		$checkout_div->append_tag_to_content($checkout_table);

		return $checkout_div;
	}

	public function
		get_checkout_shopping_basket_for_current_session_table()
	{

		$shopping_baskets_table = $this->get_element();
		$database = $shopping_baskets_table->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
		$currency = $customer_region->get_currency();

		$shopping_baskets_table = $this->get_element();

		$checkout_shopping_basket_table = new HTMLTags_Table();
		$checkout_shopping_basket_table->set_attribute_str('id', 'shopping-basket-table');

		$caption = new HTMLTags_Caption('Your Shopping Basket');
		$checkout_shopping_basket_table->append_tag_to_content($caption);

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
		$checkout_shopping_basket_table->append_tag_to_content($thead);

		// TFOOT
		$tfoot = new HTMLTags_TFoot();
		$blank_td= new HTMLTags_TD('');
		// TFOOT - sub-total-tr
		$tfoot_sub_total_tr = new HTMLTags_TR();

		$sub_total_price = new Shop_SumOfMoney(
			$shopping_baskets_table->get_sub_total_for_current_session($customer_region), $currency
		);

		$sub_total_th= new HTMLTags_TH('Sub-Total');
		$sub_total_td = new HTMLTags_TD($sub_total_price->get_as_string());

		$tfoot_sub_total_tr->append_tag_to_content($blank_td);
		$tfoot_sub_total_tr->append_tag_to_content($blank_td);
		$tfoot_sub_total_tr->append_tag_to_content($sub_total_th);
		$tfoot_sub_total_tr->append_tag_to_content($sub_total_td);

		$tfoot->append_tag_to_content($tfoot_sub_total_tr);

		// TFOOT - shipping-tr
		$shipping_price = new Shop_SumOfMoney(
			$shopping_baskets_table->get_shipping_total_for_current_session(
				$customer_region->get_id()
			), $currency
		);

		$tfoot_shipping_tr = new HTMLTags_TR();
		$shipping_th= new HTMLTags_TH('Shipping');
		$shipping_td = new HTMLTags_TD($shipping_price->get_as_string());

		$tfoot_shipping_tr->append_tag_to_content($blank_td);
		$tfoot_shipping_tr->append_tag_to_content($blank_td);
		$tfoot_shipping_tr->append_tag_to_content($shipping_th);
		$tfoot_shipping_tr->append_tag_to_content($shipping_td);

		$tfoot->append_tag_to_content($tfoot_shipping_tr);

		// TFOOT - total-tr

		$total_price = new Shop_SumOfMoney(
			$shopping_baskets_table->get_total_for_current_session($customer_region->get_id()), $currency
		);
		$tfoot_total_tr = new HTMLTags_TR();
		$total_th= new HTMLTags_TH('Total');
		$total_td = new HTMLTags_TD($total_price->get_as_string());

		$tfoot_total_tr->append_tag_to_content($blank_td);
		$tfoot_total_tr->append_tag_to_content($blank_td);
		$tfoot_total_tr->append_tag_to_content($total_th);
		$tfoot_total_tr->append_tag_to_content($total_td);

		$tfoot->append_tag_to_content($tfoot_total_tr);


		$checkout_shopping_basket_table->append_tag_to_content($tfoot);

		// TBODY
		$tbody = new HTMLTags_TBody();
		try
		{
			$shopping_baskets = 
				$shopping_baskets_table
				->get_shopping_baskets_for_current_session();

		}
		catch (Exception $e)
		{

		}
		if (count($shopping_baskets) > 0)
		{
			foreach ($shopping_baskets as $shopping_basket)
			{
				$shopping_basket_renderer = $shopping_basket->get_renderer();

				$shopping_basket_tr = 
					$shopping_basket_renderer
					->get_checkout_shopping_basket_tr();
				$tbody->append_tag_to_content($shopping_basket_tr);

			}
		}
		$checkout_shopping_basket_table->append_tag_to_content($tbody);

		return $checkout_shopping_basket_table;

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
		$shopping_baskets_table = $this->get_element();
		$database = $shopping_baskets_table->get_database();
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
		get_shopping_basket_checkout_links_ul()
	{
		$shopping_baskets_table = $this->get_element();
		$product_links_ul = new HTMLTags_UL();
		$product_links_ul->set_attribute_str('id', 'shopping-basket-ul');

		if ($shopping_baskets_table->check_for_current_session_in_shopping_baskets())
		{
			$checkout_link = new HTMLTags_A();
			$checkout_link->append_tag_to_content(new HTMLTags_Span('Checkout'));
			$checkout_location = new HTMLTags_URL();

			$checkout_location->set_file('/hpi/shop/checkout.html');
			$checkout_link->set_href($checkout_location);
			$checkout_li = new HTMLTags_LI();
			$checkout_li->set_attribute_str('class', 'checkout');
			$checkout_li->append_tag_to_content($checkout_link);

			$product_links_ul->append_tag_to_content($checkout_li);

		}
		$all_products_link = new HTMLTags_A('Continue Shopping');
		$all_products_location = new HTMLTags_URL();
		$all_products_location->set_file('/hpi/shop/products.html');
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
		$shopping_baskets_table = $this->get_element();
		$database = $shopping_baskets_table->get_database();
		$customers_table = $database->get_table('hpi_shop_customers');
		$customers_table_renderer = $customers_table->get_renderer();

		$shipping_address_form_div = new HTMLTags_Div();

		$cancel_href = new HTMLTags_URL();
		$cancel_href->set_file('/checkout.html');

		$redirect_script_url = new HTMLTags_URL();
		$redirect_script_url->set_file('/');
		$redirect_script_url->set_get_variable('page', 'checkout');

		$row_adding_form = 
			$customers_table_renderer->get_customer_adding_form($redirect_script_url, $cancel_href);

		$shipping_address_form_div->append_tag_to_content($row_adding_form);

		return $shipping_address_form_div;
	}

	public function get_display_shopping_baskets_for_current_session_div()
	{

		$page_manager = PublicHTML_PageManager::get_instance();

		$shopping_basket_div = new HTMLTags_Div();
		$shopping_basket_div->set_attribute_str('id', 'shopping-basket-confirmation');

		$heading = new HTMLTags_Heading(3, 'Shopping Basket');
		$shopping_basket_div->append_tag_to_content($heading);

		$shopping_basket_table = 
			$this->get_checkout_shopping_basket_for_current_session_table();

		$shopping_basket_div->append_tag_to_content($shopping_basket_table);

		$go_to_basket_link = new HTMLTags_A('Edit Shopping Basket');
		$go_to_basket_link->set_attribute_str('class', 'edit-shopping-basket');

		$go_to_basket_location = new HTMLTags_URL();

		$go_to_basket_location->set_file('/hpi/shop/shopping-basket.html');

		$go_to_basket_link->set_href($go_to_basket_location);

		$shopping_basket_div->append_tag_to_content($go_to_basket_link);

		return $shopping_basket_div;
	}
	
	/**
	 * The core of the functions to do with the div for confirming the deletion
	 * of items from the shopping basket.
	 */
	public static function
		get_deleted_shopping_basket_confirmation_div(
			$product_name,
			HTMLTags_URL $undo_url
		)
	{
		$confirmation_div = new HTMLTags_Div();

		$confirmation_text = "You have deleted&nbsp;$product_name&nbsp;from your Shopping Basket.";
		
		$confirmation_text_p = new HTMLTags_P($confirmation_text);
		$confirmation_div->append_tag_to_content($confirmation_text_p);
		
		$undo_link = new HTMLTags_A('Undo');
		$undo_link->set_attribute_str('class', 'undo');
		
		$undo_link->set_href($undo_url);
		
		$confirmation_div->append_tag_to_content($undo_link);
		
		return $confirmation_div;
	}
	
	/**
	 * This is shown in the last action div of the shopping
	 * baskets page after a user has deleted an item from
	 * their shopping basket.
	 */
	public static function
		get_deleted_shopping_basket_confirmation_div_for_sbid(
			$shopping_basket_id
		)
	{
		$product_name = Shop_ShoppingBasketsTable
			::get_product_name_for_sbid($shopping_basket_id);
		$undo_url = Shop_ShoppingBasketsTable
			::get_restore_shopping_basket_item_url($shopping_basket_id);
		
		return self::get_deleted_shopping_basket_confirmation_div($product_name, $undo_url);
	}
}
?>