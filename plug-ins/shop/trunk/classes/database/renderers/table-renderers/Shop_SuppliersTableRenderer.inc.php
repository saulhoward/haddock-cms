<?php
/**
 * Shop_SuppliersTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

class
	Shop_SuppliersTableRenderer
	extends
	Database_TableRenderer
{
	public function get_supplier_adding_form(
		HTMLTags_URL $redirect_script_url,
		HTMLTags_URL $cancel_url
	)
	{
		$suppliers_table = $this->get_element();
		$database = $suppliers_table->get_database();
		$email_addresses_table = $database->get_table('hpi_shop_email_addresses');
		$telephone_numbers_table = $database->get_table('hpi_shop_telephone_numbers');
		$addresses_table = $database->get_table('hpi_shop_addresses');

		$supplier_adding_form = new HTMLTags_SimpleOLForm('supplier_adding');

		$supplier_adding_form->set_action($redirect_script_url);

		$supplier_adding_form->set_legend_text('Add a supplier');

		# The Fields:
		//$last_added_id = $suppliers_table->add_supplier(
		//            $_POST['name'],
		//            $_POST['notes'],
		//            $_POST['currency_id'],
		//            $_POST['email_address'],
		//            $_POST['telephone_number'],
		//            $_POST['post_office_box'],
		//            $_POST['extended_address'],
		//            $_POST['street_address'],
		//            $_POST['locality'],
		//            $_POST['region'],
		//            $_POST['postal_code'],
		//            $_POST['country_name'],
		//        );
		/*
		 * The name
		 */
		$name_field = $suppliers_table->get_field('name');
		$name_field_renderer = $name_field->get_renderer();
		$input_tag = $name_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'name');
		$supplier_adding_form->add_input_tag(
			'name',
			$input_tag
		);        

		/*
		 * The contact_name
		 */
		$contact_name_field = $suppliers_table->get_field('contact_name');
		$contact_name_field_renderer = $contact_name_field->get_renderer();
		$input_tag = $contact_name_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'contact_name');
		$supplier_adding_form->add_input_tag(
			'contact_name',
			$input_tag
		);   
		/*
		 * The notes
		 */
		$notes_field = $suppliers_table->get_field('notes');
		$notes_field_renderer = $notes_field->get_renderer();
		$input_tag = $notes_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'notes');
		$supplier_adding_form->add_input_tag(
			'notes',
			$input_tag
		);

//                /*
//                 * The currency_id
//                 */
		$currency_li = $this->get_currency_form_select_li();

//                $currency_select_li = $this->get_currency_form_select_li();
//                $supplier_adding_form->append_tag_to_content($currency_select_li);
		$supplier_adding_form->add_input_li($currency_li);
		/*
		 * The email_address
		 */
		$email_address_field = $email_addresses_table->get_field('email_address');
		$email_address_field_renderer = $email_address_field->get_renderer();
		$input_tag = $email_address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'email_address');
		$supplier_adding_form->add_input_tag(
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
		$supplier_adding_form->add_input_tag(
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
		$supplier_adding_form->add_input_tag(
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
		$supplier_adding_form->add_input_tag(
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
		$supplier_adding_form->add_input_tag(
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
		$supplier_adding_form->add_input_tag(
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
		$supplier_adding_form->add_input_tag(
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
		$supplier_adding_form->add_input_tag(
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
		$supplier_adding_form->add_input_tag(
			'country_name',
			$input_tag
		);

		/*
		 * The add button.
		 */
		$supplier_adding_form->set_submit_text('Add');

		$supplier_adding_form->set_cancel_location($cancel_url);

		return $supplier_adding_form;
	}

	public function
		get_currency_form_select_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Currency');
		$input_label->set_attribute_str('for', 'currency_id');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_currency_form_select());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'currency_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}	

	public function
		get_currency_form_select()
	{
		$suppliers_table = $this->get_element();
		$database = $suppliers_table->get_database();
		$currencies_table = $database->get_table('hpi_shop_currencies');
		$currencies = $currencies_table->get_all_rows();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'currency_id');

		foreach ($currencies as $currency) 
		{
			$currency_text = '';
			$currency_text .= $currency->get_name();
			$currency_text .= '&nbsp;(';
			$currency_text .= $currency->get_symbol();
			$currency_text .= ')';

			$option = new HTMLTags_Option($currency_text);
			$option->set_attribute_str('value', $currency->get_id());
			$select->add_option($option);
		}

		return $select;
	}
}
?>
