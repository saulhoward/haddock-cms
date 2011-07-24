<?php
/**
 * Shop_CustomersTable
 *
 * @copyright Clear Line Web Design, 2007-03-06
 */

class
	Shop_CustomersTable
extends
	Database_Table
{
	//SIMPLIFIED CUSTOMER
	//$last_added_id = $customers_table->add_simplified_customer(
	//                        $_POST['full_name'],
	//                        $_POST['password'],
	//                        $_POST['email_address'],
	//                        $_POST['telephone_number'],
	//                        $_POST['full_address'],
	//                        $_POST['postal_code'],
	//                        $_POST['country_name'],
	//                        $_POST['customer_region_id']
	//                );
	public function
		add_simplified_customer (
			$first_name = '',
			$last_name = '',
			$password = '',
			$email_address = '',
			$telephone_number = '',
			$full_address = '',
			$address_postal_code = '',
			$address_country_name = '',
			$customer_region_id = ''
		)
	{
		//$returned_email_address_id = $this->add_email_address($email_address);
		$returned_telephone_number_id = $this->add_telephone_number($telephone_number);

		if ($customer_region_id == '')
		{
			$customer_region_id = $_SESSION['customer_region_id'];
		}

		$address_values = array();
		$address_values['street_address'] = $full_address;
		$address_values['postal_code'] = $address_postal_code;
		$address_values['country_name'] = $address_country_name;

		$returned_address_id = $this->add_address($address_values);

		$encrypted_password = hash('sha256', $password);
		//$log_in_manager = LogIn_LogInManager::get_instance();
		//$encrypted_password = $log_in_manager->get_encrypted_password($password);

		$customer_values = array();
		$customer_values['first_name'] = $first_name;
		$customer_values['last_name'] = $last_name;
		$customer_values['password'] = $encrypted_password;
		$customer_values['added'] = 'NOW()';
		$customer_values['last_logged_in'] = 'NOW()';
		$customer_values['address_id'] = $returned_address_id;
		$customer_values['telephone_number_id'] = $returned_telephone_number_id;
		$customer_values['email_address'] = $email_address;
		$customer_values['customer_region_id'] = $customer_region_id;

		$customer_id = $this->add($customer_values);
		return $customer_id;
	}

	public function
		add_customer (
			$first_name = '',
			$last_name = '',
			$password = '',
			$email_address = '',
			$telephone_number = '',
			$address_post_office_box = '',
			$address_extended_address = '',
			$address_street_address = '',
			$address_locality = '',
			$address_region = '',
			$address_postal_code = '',
			$address_country_name = '',
			$customer_region_id = ''
		)
	{
		//$returned_email_address_id = $this->add_email_address($email_address);
		$returned_telephone_number_id = $this->add_telephone_number($telephone_number);

		if ($customer_region_id == '')
		{
			$customer_region_id = $_SESSION['customer_region_id'];
		}

		$address_values = array();
		$address_values['post_office_box'] = $address_post_office_box;
		$address_values['extended_address'] = $address_extended_address;
		$address_values['street_address'] = $address_street_address;
		$address_values['locality'] = $address_locality;
		$address_values['region'] = $address_region;
		$address_values['postal_code'] = $address_postal_code;
		$address_values['country_name'] = $address_country_name;

		$returned_address_id = $this->add_address($address_values);

		$encrypted_password = hash('sha256', $password);
		//$log_in_manager = LogIn_LogInManager::get_instance();
		//$encrypted_password = $log_in_manager->get_encrypted_password($password);

		$customer_values = array();
		$customer_values['first_name'] = $first_name;
		$customer_values['last_name'] = $last_name;
		$customer_values['password'] = $encrypted_password;
		$customer_values['added'] = 'NOW()';
		$customer_values['last_logged_in'] = 'NOW()';
		$customer_values['address_id'] = $returned_address_id;
		$customer_values['telephone_number_id'] = $returned_telephone_number_id;
		$customer_values['email_address'] = $email_address;
		$customer_values['customer_region_id'] = $customer_region_id;

		$customer_id = $this->add($customer_values);
		return $customer_id;
	}

	public function
		add_address($address_values)
	{
		$database = $this->get_database();
		$addresses_table = $database->get_table('hpi_shop_addresses');

		return $addresses_table->add($address_values);
	}

//        public function
//                add_email_address($email_address)
//        {
//                $database = $this->get_database();
//                $email_addresses_table = $database->get_table('hpi_shop_email_addresses');
//                $email_address_values = array();
//                $email_address_values['email_address'] = $email_address;

//                return $email_addresses_table->add($email_address_values);
//        }

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
		edit_customer (
			$edit_id,
			$first_name,
			$last_name,
			$email_address,
			$telephone_number,
			$address_post_office_box,
			$address_extended_address,
			$address_street_address,
			$address_locality,
			$address_region,
			$address_postal_code,
			$address_country_name,
			$customer_region_id 
		)
	{
		// Clean up first
		// delete telephone_number, email_address and address
		$row_to_be_edited = $this->get_row_by_id($edit_id);
		try
		{
			$row_to_be_edited->delete_telephone_number();
			$row_to_be_edited->delete_address();
		}
		catch (Exception $e)
		{
			print('Problem with deleting old Telephone Number, Email Address and Address');
		}

		// Add Telephone Number, Address and email address
		#$returned_email_address_id = $this->add_email_address($email_address);
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

		$customer_values = array();
		$customer_values['first_name'] = $first_name;
		$customer_values['last_name'] = $last_name;
		$customer_values['address_id'] = $returned_address_id;
		$customer_values['telephone_number_id'] = $returned_telephone_number_id;
		$customer_values['email_address'] = $email_address;
		if ($customer_region_id == '')
		{
			$customer_region_id = $_SESSION['customer_region_id'];
		}
		$customer_values['customer_region_id'] = $customer_region_id;

		return $this->update_by_id($edit_id, $customer_values);
	}

	public function
		delete_customer (
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
