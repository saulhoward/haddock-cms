<?php
/**
 * Shop_SuppliersTable
 *
 * @copyright Clear Line Web Design, 2007-03-06
 */

class
	Shop_SuppliersTable
	extends
	Database_Table
{
	public function
		add_supplier (
			$name,
			$contact_name,
			$notes,
			$currency_id,
			$email_address,
			$telephone_number,
			$address_post_office_box,
			$address_extended_address,
			$address_street_address,
			$address_locality,
			$address_region,
			$address_postal_code,
			$address_country_name
		)
	{
		$returned_email_address_id = $this->add_email_address($email_address);
		$returned_telephone_number_id = $this->add_telephone_number($telephone_number);

		$address_values = array();
			$address_values['post_office_box'] = $address_post_office_box;
			$address_values['extended_address'] = $address_extended_address;
			$address_values['street_address'] = $address_street_address;
			$address_values['locality'] = $address_locality;
			$address_values['region'] = $address_region;
			$address_values['postal_code'] = $address_postal_code;
			$address_values['country_name'] = $address_country_name;

		$returned_address_id = $this->add_address($address_values);

		$supplier_values = array();
			$supplier_values['name'] = $name;
			$supplier_values['contact_name'] = $contact_name;
			$supplier_values['notes'] = $notes;
			$supplier_values['currency_id'] = $currency_id;
			$supplier_values['address_id'] = $returned_address_id;
			$supplier_values['telephone_number_id'] = $returned_telephone_number_id;
			$supplier_values['email_address_id'] = $returned_email_address_id;

//                        $first_name = '',
//                        $last_name = '',
//                        $password = '',
//                        $email_address = '',
//                        $telephone_number = '',
//                        $address_post_office_box = '',
//                        $address_extended_address = '',
//                        $address_street_address = '',
//                        $address_locality = '',
//                        $address_region = '',
//                        $address_postal_code = '',
//                        $address_country_name = '',
//                        $customer_region_id = ''

//                $customer_values = array();
//                        $customer_values['first_name'] = $contact_name;
//                        $customer_values['password'] = $notes;
//                        $customer_values['currency_id'] = $currency_id;
//                        $customer_values['address_id'] = $returned_address_id;
//                        $customer_values['telephone_number_id'] = $returned_telephone_number_id;
//                        $customer_values['email_address_id'] = $returned_email_address_id;

//                $returned_user_id = $this->add_customer($customer_values);

		$supplier_id = $this->add($supplier_values);
		return $supplier_id;
	}

	public function
		add_address($address_values)
	{
		$database = $this->get_database();
		$addresses_table = $database->get_table('hpi_shop_addresses');

		return $addresses_table->add($address_values);
	}

	public function
		add_email_address($email_address)
	{
		$database = $this->get_database();
		$email_addresses_table = $database->get_table('hpi_shop_email_addresses');
		$email_address_values = array();
		$email_address_values['email_address'] = $email_address;

		return $email_addresses_table->add($email_address_values);
	}

	public function
		add_telephone_number($telephone_number)
	{
		$database = $this->get_database();
		$telephone_numbers_table = $database->get_table('hpi_shop_telephone_numbers');
		$telephone_number_values = array();
		$telephone_number_values['telephone_number'] = $telephone_number;

		return $telephone_numbers_table->add($telephone_number_values);
	}

	public function
		edit_supplier (
			$edit_id,
			$name,
			$contact_name,
			$notes,
			$currency_id,
			$email_address,
			$telephone_number,
			$address_post_office_box,
			$address_extended_address,
			$address_street_address,
			$address_locality,
			$address_region,
			$address_postal_code,
			$address_country_name
		)
	{
		// Clean up first
		// delete telephone_number, email_address and address
		$row_to_be_edited = $this->get_row_by_id($edit_id);
		try
		{
			$row_to_be_edited->delete_telephone_number();
			$row_to_be_edited->delete_email_address();
			$row_to_be_edited->delete_address();
		}
		catch (Exception $e)
		{
			print('Problem with deleting old Telephone Number, Email Address and Address');
		}

		// Add Telephone Number, Address and email address
		$returned_email_address_id = $this->add_email_address($email_address);
		$returned_telephone_number_id = $this->add_telephone_number($telephone_number);

		$address_values = array();
			$address_values['post_office_box'] = $address_post_office_box;
			$address_values['extended_address'] = $address_extended_address;
			$address_values['street_address'] = $address_street_address;
			$address_values['locality'] = $address_locality;
			$address_values['region'] = $address_region;
			$address_values['postal_code'] = $address_postal_code;
			$address_values['country_name'] = $address_country_name;

		$returned_address_id = $this->add_address($address_values);

		$supplier_values = array();
			$supplier_values['name'] = $name;
			$supplier_values['contact_name'] = $contact_name;
			$supplier_values['notes'] = $notes;
			$supplier_values['currency_id'] = $currency_id;
			$supplier_values['address_id'] = $returned_address_id;
			$supplier_values['telephone_number_id'] = $returned_telephone_number_id;
			$supplier_values['email_address_id'] = $returned_email_address_id;

		return $this->update_by_id($edit_id, $supplier_values);
	}

	public function
		delete_supplier (
			$delete_id
		)
	{
		// Clean up first
		// delete telephone_number, email_address and address
		$row_to_be_deleted = $this->get_row_by_id($delete_id);
		try
		{
			$row_to_be_deleted->delete_telephone_number();
			$row_to_be_deleted->delete_email_address();
			$row_to_be_deleted->delete_address();
		}
		catch (Exception $e)
		{
			print('Problem with deleting old Telephone Number, Email Address and Address');
		}

		$this->delete_by_id($delete_id);
	}
}
?>
