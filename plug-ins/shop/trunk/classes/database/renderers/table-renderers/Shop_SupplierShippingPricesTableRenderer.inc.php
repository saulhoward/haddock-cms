<?php
/**
 * Shop_SupplierShippingPricesTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

require_once PROJECT_ROOT
. '/haddock/database/classes/renderers/'
. 'Database_TableRenderer.inc.php';

require_once PROJECT_ROOT
	. '/haddock/html-tags/classes/standard/'
	. 'HTMLTags_UL.inc.php';

class
	Shop_SupplierShippingPricesTableRenderer
	extends
	Database_TableRenderer
{
	public function get_supplier_shipping_price_adding_form(
		HTMLTags_URL $redirect_script_url,
		HTMLTags_URL $cancel_url
	)
	{
		$supplier_shipping_prices_table = $this->get_element();

		$supplier_shipping_price_adding_form = new HTMLTags_SimpleOLForm('supplier_shipping_price_adding');
		$supplier_shipping_price_adding_form->set_action($redirect_script_url);
		$supplier_shipping_price_adding_form->set_legend_text('Add a supplier_shipping_price');

		# The Fields:
		/*
		 * The supplier_id
		 */
		$supplier_li = $this->get_supplier_form_select_li();
		$supplier_shipping_price_adding_form->add_input_li($supplier_li);

		/*
		 * The customer_region_id
		 */
		$customer_region_li = $this->get_customer_region_form_select_li();
		$supplier_shipping_price_adding_form->add_input_li($customer_region_li);

		/*
		 * The product_category_id
		 */
		$product_category_li = $this->get_product_category_form_select_li();
		$supplier_shipping_price_adding_form->add_input_li($product_category_li);

		/*
		 * The add button.
		 */
		$supplier_shipping_price_adding_form->set_submit_text('Add');

		$supplier_shipping_price_adding_form->set_cancel_location($cancel_url);

		return $supplier_shipping_price_adding_form;
	}

	public function
		get_supplier_form_select_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Currency');
		$input_label->set_attribute_str('for', 'supplier_id');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_supplier_form_select());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'supplier_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}	

	public function
		get_supplier_form_select()
	{
		$supplier_shipping_prices_table = $this->get_element();
		$database = $supplier_shipping_prices_table->get_database();
		$suppliers_table = $database->get_table('hpi_shop_suppliers');
		$suppliers = $suppliers_table->get_all_rows();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'supplier_id');

		foreach ($suppliers as $supplier) 
		{
			$address = $supplier->get_address();
			$supplier_text = '';
			$supplier_text .= $supplier->get_name();
			$supplier_text .= '&nbsp;(';
			$supplier_text .= $address->get_country_name();
			$supplier_text .= ')';

			$option = new HTMLTags_Option($supplier_text);
			$option->set_attribute_str('value', $supplier->get_id());
			$select->add_option($option);
		}

		return $select;
	}

	public function
		get_customer_region_form_select_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Currency');
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
		$supplier_shipping_prices_table = $this->get_element();
		$database = $supplier_shipping_prices_table->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_regions = $customer_regions_table->get_all_rows();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'customer_region_id');

		foreach ($customer_regions as $customer_region) 
		{
			$currency = $customer_region->get_currency();
			$customer_region_text = '';
			$customer_region_text .= $customer_region->get_name();
			$customer_region_text .= '&nbsp;(';
			$customer_region_text .= $currency->get_symbol();
			$customer_region_text .= ')';

			$option = new HTMLTags_Option($customer_region_text);
			$option->set_attribute_str('value', $customer_region->get_id());
			$select->add_option($option);
		}

		return $select;
	}

	public function
		get_product_category_form_select_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Currency');
		$input_label->set_attribute_str('for', 'product_category_id');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_product_category_form_select());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'product_category_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}	

	public function
		get_product_category_form_select()
	{
		$supplier_shipping_prices_table = $this->get_element();
		$database = $supplier_shipping_prices_table->get_database();
		$product_categories_table = $database->get_table('hpi_shop_product_categories');
		$product_categories = $product_categories_table->get_all_rows();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'product_category_id');

		foreach ($product_categories as $product_category) 
		{
			$option = new HTMLTags_Option($product_category->get_name());
			$option->set_attribute_str('value', $product_category->get_id());
			$select->add_option($option);
		}

		return $select;
	}


	public function
		get_supplier_shipping_price_editing_form(
			$supplier_id,
			$product_category_id,
			$redirect_script_url,
			$cancel_href
		)
	{
		$supplier_shipping_prices_table = $this->get_element();
		$database = $supplier_shipping_prices_table->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$suppliers_table = $database->get_table('hpi_shop_suppliers');
		$supplier = $suppliers_table->get_row_by_id($supplier_id);
		$product_categories_table = $database->get_table('hpi_shop_product_categories');
		$product_category = $product_categories_table->get_row_by_id($product_category_id);

		$supplier_shipping_price_editing_form = new HTMLTags_SimpleOLForm('supplier_shipping_price_editing');
		$supplier_shipping_price_editing_form->set_action($redirect_script_url);
		$legend_text = '';
		$legend_text .= 'Edit&nbsp;';
		$legend_text .= $supplier->get_name();
		$legend_text .= "'s shipping prices for&nbsp;";
		$legend_text .= $product_category->get_name();
		$supplier_shipping_price_editing_form->set_legend_text($legend_text);


		$customer_regions = $customer_regions_table->get_all_rows();

		foreach ($customer_regions as $customer_region)
		{
			$price_id = $customer_region->get_id();
			$conditions = array();
			$conditions['customer_region_id'] = $customer_region->get_id();
			$conditions['product_category_id'] = $product_category_id;
			$conditions['supplier_id'] = $supplier_id;

			$supplier_shipping_prices = $supplier_shipping_prices_table->get_rows_where($conditions);
			if (count($supplier_shipping_prices) > 0)
			{
				$current_first_price = $supplier_shipping_prices[0]->get_first_price();
				$current_additional_price = $supplier_shipping_prices[0]->get_additional_price();
			}
			else
			{
				$current_first_price = 0;
				$current_additional_price = 0;
			}

			/*
			 * The first_price
			 */
			$input_li = new HTMLTags_LI();
			$currency = $customer_region->get_currency();
			$input_label_text = '';
			$input_label_text .= 'Price of first item to&nbsp;';
			$input_label_text .= $customer_region->get_name();
			$input_label_text .= '&nbsp;(';
			$input_label_text .= $currency->get_symbol();
			$input_label_text .= ')';

			$input_label_title = 'first_price_';
			$input_label_title .= $customer_region->get_id();
				
			$input_label = new HTMLTags_Label($input_label_text);
			$input_label->set_attribute_str('for', $input_label_title);

			$input_li->append_tag_to_content($input_label);

			$input = new HTMLTags_Input();
			$input->set_attribute_str('type', 'text');
			$input->set_attribute_str('name', $input_label_title);
			$input->set_value($current_first_price);

			$input_li->append_tag_to_content($input);
			$supplier_shipping_price_editing_form->add_input_li($input_li);

			/*
			 * The additional_price
			 */
			$input_li = new HTMLTags_LI();
			$currency = $customer_region->get_currency();
			$input_label_text = '';
			$input_label_text .= 'Price of each additional item to&nbsp;';
			$input_label_text .= $customer_region->get_name();
			$input_label_text .= '&nbsp;(';
			$input_label_text .= $currency->get_symbol();
			$input_label_text .= ')';

			$input_label_title = 'additional_price_';
			$input_label_title .= $customer_region->get_id();
				
			$input_label = new HTMLTags_Label($input_label_text);
			$input_label->set_attribute_str('for', $input_label_title);

			$input_li->append_tag_to_content($input_label);

			$input = new HTMLTags_Input();
			$input->set_attribute_str('type', 'text');
			$input->set_attribute_str('name', $input_label_title);
			$input->set_value($current_additional_price);

			$input_li->append_tag_to_content($input);
			$supplier_shipping_price_editing_form->add_input_li($input_li);
		}
		/*
		 * The add button.
		 */
		$supplier_shipping_price_editing_form->set_submit_text('Edit');

		$supplier_shipping_price_editing_form->set_cancel_location($cancel_href);

		return $supplier_shipping_price_editing_form;
	}
}
?>
