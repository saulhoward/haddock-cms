<?php
/**
 * Shop_CustomerRegionSupplierLinksTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

require_once PROJECT_ROOT
. '/haddock/database/classes/renderers/'
. 'Database_TableRenderer.inc.php';

require_once PROJECT_ROOT
	. '/haddock/html-tags/classes/standard/'
	. 'HTMLTags_BR.inc.php';
require_once PROJECT_ROOT
	. '/haddock/html-tags/classes/standard/'
	. 'HTMLTags_UL.inc.php';

class
	Shop_CustomerRegionSupplierLinksTableRenderer
	extends
	Database_TableRenderer
{
	public function get_customer_region_supplier_link_adding_form(
		HTMLTags_URL $redirect_script_url,
		HTMLTags_URL $cancel_url
	)
	{
		$customer_region_supplier_links_table = $this->get_element();

		$customer_region_supplier_link_adding_form = 
			new HTMLTags_SimpleOLForm('customer_region_supplier_link_adding');
		$customer_region_supplier_link_adding_form->set_action($redirect_script_url);
		$customer_region_supplier_link_adding_form->set_legend_text('Add a customer_region_supplier_link');

		# The Fields:
		/*
		 * The supplier_id
		 */
		$supplier_li = $this->get_supplier_form_select_li();
		$customer_region_supplier_link_adding_form->add_input_li($supplier_li);

		/*
		 * The customer_region_id
		 */
		$customer_region_li = $this->get_customer_region_form_select_li();
		$customer_region_supplier_link_adding_form->add_input_li($customer_region_li);

		/*
		 * The add button.
		 */
		$customer_region_supplier_link_adding_form->set_submit_text('Add');

		$customer_region_supplier_link_adding_form->set_cancel_location($cancel_url);

		return $customer_region_supplier_link_adding_form;
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
		$customer_region_supplier_links_table = $this->get_element();
		$database = $customer_region_supplier_links_table->get_database();
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
		$customer_region_supplier_links_table = $this->get_element();
		$database = $customer_region_supplier_links_table->get_database();
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
		get_customer_region_supplier_links_editing_form(
			$customer_region_id,
			$redirect_script_url,
			$cancel_href
		)
	{
		$customer_region_supplier_links_table = $this->get_element();
		$database = $customer_region_supplier_links_table->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
//                $suppliers_table = $database->get_table('hpi_shop_suppliers');
//                $supplier = $suppliers_table->get_row_by_id($supplier_id);
		$customer_region = $customer_regions_table->get_row_by_id($customer_region_id);

		$customer_region_supplier_link_editing_form = 
			new HTMLTags_SimpleOLForm('customer_region_supplier_link_editing');
		$customer_region_supplier_link_editing_form->set_action($redirect_script_url);
		$legend_text = '';
		$legend_text .= 'Edit the suppliers for&nbsp;';
		$legend_text .= $customer_region->get_name();
		$customer_region_supplier_link_editing_form->set_legend_text($legend_text);

		$input_li = $this->get_supplier_form_checkbox_li($customer_region_id);
		$customer_region_supplier_link_editing_form->add_input_li($input_li);

		/*
		 * The add button.
		 */
		$customer_region_supplier_link_editing_form->set_submit_text('Edit');

		$customer_region_supplier_link_editing_form->set_cancel_location($cancel_href);

		return $customer_region_supplier_link_editing_form;
	}

	public function
		get_supplier_form_checkbox_li($customer_region_id)
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Suppliers');
		$input_label->set_attribute_str('for', 'supplier_id');

		$input_li->append_tag_to_content($input_label);

		$customer_region_supplier_links_table = $this->get_element();
		$database = $customer_region_supplier_links_table->get_database();
		$suppliers_table = $database->get_table('hpi_shop_suppliers');
		$suppliers = $suppliers_table->get_all_rows();

		foreach ($suppliers as $supplier) 
		{

			$input = new HTMLTags_Input();
			$input->set_attribute_str('type', 'checkbox');
			$input->set_attribute_str('name', $supplier->get_id());
			$input->set_value($supplier->get_id());

			$conditions = array();
			$conditions['supplier_id'] = $supplier->get_id();
			$conditions['customer_region_id'] = $customer_region_id;

			$current_supplier = $customer_region_supplier_links_table->get_rows_where($conditions);
			if (count($current_supplier) > 0)
			{
				#print_r('saul');
				$input->set_attribute_str('checked', 'checked');
			}

			$input_li->append_tag_to_content($input);
			$input_li->append_str_to_content($supplier->get_name());

//                        $input_li->append_tag_to_content(new HTMLTags_BR());
		}

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'supplier_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}	
}
?>
