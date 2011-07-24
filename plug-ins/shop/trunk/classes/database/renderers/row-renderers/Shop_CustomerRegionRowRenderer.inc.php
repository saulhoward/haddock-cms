<?php
/**
 * Shop_CustomerRegionRowRenderer.inc.php
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */


class
	Shop_CustomerRegionRowRenderer
extends
	Database_RowRenderer
{
	public function
		get_admin_customer_regions_html_table_tr($current_page_url)
	{
		$html_row =  new HTMLTags_TR();

		$row = $this->get_element();

		$table = $row->get_table();
		/*
		 * The data.
		 */ 
		$name_field = $table->get_field('name');
		$name_td = $this->get_data_html_table_td($name_field);
		$html_row->append_tag_to_content($name_td);

		$description_field = $table->get_field('description');
		$description_td = $this->get_data_html_table_td($description_field);
		$html_row->append_tag_to_content($description_td);

		$currency_td = $this->get_currency_td();
		$html_row->append_tag_to_content($currency_td);

		$language_td = $this->get_language_td();
		$html_row->append_tag_to_content($language_td);

		$suppliers_td = $this->get_suppliers_td();
		$html_row->append_tag_to_content($suppliers_td);

		$sort_order_field = $table->get_field('sort_order');
		$sort_order_td = $this->get_data_html_table_td($sort_order_field);
		$html_row->append_tag_to_content($sort_order_td);

		/*
		 * The set_suppliers td.
		 */
		$set_suppliers_td = new HTMLTags_TD();

		$set_suppliers_link = new HTMLTags_A('Set Suppliers');
		$set_suppliers_link->set_attribute_str('class', 'cool_button');
		$set_suppliers_link->set_attribute_str('id', 'set_suppliers_table_button');


		$set_suppliers_location = clone $current_page_url;
		$set_suppliers_location->set_get_variable('suppliers');
		$set_suppliers_location->set_get_variable('customer_region_id', $row->get_id());

		$set_suppliers_link->set_href($set_suppliers_location);

		$set_suppliers_td->append_tag_to_content($set_suppliers_link);

		$html_row->append_tag_to_content($set_suppliers_td);


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
		get_language_td()
	{
		$row = $this->get_element();
		$language = $row->get_language(); 

		return new HTMLTags_TD($language->get_name());
	}

	public function
		get_suppliers_td()
	{
		$row = $this->get_element();
		$suppliers = $row->get_suppliers(); 

		$supplier_td = new HTMLTags_TD();

		foreach ($suppliers as $supplier)
		{
			$supplier_td->append_str_to_content($supplier->get_name());
			$supplier_td->append_tag_to_content(new HTMLTags_BR());
		}
		return $supplier_td;
	}



	public function
		get_changed_confirmation_div()
	{

		$customer_region = $this->get_element();

		$confirmation_div = new HTMLTags_Div();

		$confirmation_text = <<<TXT
You have changed your region to&nbsp;
TXT;
		$confirmation_text .= $customer_region->get_name_with_the();

		$confirmation_text .= <<<TXT
.
TXT;

		$confirmation_text_p = new HTMLTags_P($confirmation_text);
		$confirmation_div->append_tag_to_content($confirmation_text_p);

		$all_products_link =
		       	new HTMLTags_A('View Products Available in&nbsp;' . $customer_region->get_name_with_the());
		//            $all_products_link->set_attribute_str('class', 'all_products');

		$all_products_location = new HTMLTags_URL();
		$all_products_location->set_file('/');
		$all_products_location->set_get_variable('section', 'plug-ins');
		$all_products_location->set_get_variable('module', 'shop');
		$all_products_location->set_get_variable('page', 'products');
		$all_products_location->set_get_variable('type', 'html');
		$all_products_location->set_get_variable('customer_region_session', $customer_region->get_id());

		$all_products_link->set_href($all_products_location);

		$confirmation_div->append_tag_to_content($all_products_link);

		return $confirmation_div;
	}
}
?>
