<?php
/**
 * Shop_SupplierShippingPriceRowRenderer.inc.php
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
	Shop_SupplierShippingPriceRowRenderer
	extends
	Database_RowRenderer
{
	public function
		get_admin_supplier_shipping_prices_html_table_tr()
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

		$edit_location = new HTMLTags_URL();

		$edit_location->set_file('/admin/');

		$edit_location->set_get_variable('module', 'shop');            
		$edit_location->set_get_variable('page', 'supplier_shipping_prices');

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

		$delete_location = new HTMLTags_URL();

		$delete_location->set_file('/admin/');

		$delete_location->set_get_variable('module', 'shop');     
		$delete_location->set_get_variable('page', 'supplier_shipping_prices');

		$delete_location->set_get_variable('delete_id', $row->get_id());

		$delete_link->set_href($delete_location);

		$delete_td->append_tag_to_content($delete_link);

		$html_row->append_tag_to_content($delete_td);

		return $html_row;
	}
}
?>
