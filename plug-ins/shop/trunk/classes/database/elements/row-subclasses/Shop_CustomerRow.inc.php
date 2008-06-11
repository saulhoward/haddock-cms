<?php
/**
 * Shop_CustomerRow
 *
 * @copyright Clear Line Web Design, 2007-03-05
 */

require_once PROJECT_ROOT
. '/haddock/database/classes/elements/'
. 'Database_Row.inc.php';

class
	Shop_CustomerRow
	extends
	Database_Row
{
	public function 
		get_first_name()
	{
		return $this->get('first_name');
	}

	public function 
		get_last_name()
	{
		return $this->get('last_name');
	}

	public function 
		get_added()
	{
		return $this->get('added');
	}

	public function 
		get_customer_region_id()
	{
		return $this->get('customer_region_id');
	}
	public function 
		set_customer_region_id($customer_region_id)
	{
		return $this->set('customer_region_id', $customer_region_id);
	}
	public function 
		get_address_id()
	{
		return $this->get('address_id');
	}

	public function 
		get_telephone_number_id()
	{
		return $this->get('telephone_number_id');
	}

	public function 
		get_email_address()
	{
		return $this->get('email_address');
	}

	public function 
		get_customer_region()
	{
		if ($this->has_customer_region())
		{
			$database = $this->get_database();
			$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
			$customer_region_id = $this->get_customer_region_id();

			return $customer_regions_table->get_row_by_id($customer_region_id);
		}
	}

	public function
		has_customer_region()
	{
		$database = $this->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$conditions = array();
		$conditions['id'] = $this->get_customer_region_id();

		$number_of_customer_regions = 0;
		$number_of_customer_regions += $customer_regions_table->count_rows_where($conditions);

		if ($number_of_customer_regions > 0)
		{
			return TRUE;
		}
		return FALSE;
	}

	public function 
		get_address()
	{
		if ($this->has_address())
		{
			$database = $this->get_database();
			$addresses_table = $database->get_table('hpi_shop_addresses');
			$address_id = $this->get_address_id();

			return $addresses_table->get_row_by_id($address_id);
		}
	}

	public function
		has_telephone_number()
	{
		$database = $this->get_database();
		$telephone_numbers_table = $database->get_table('hpi_shop_telephone_numbers');
		$conditions = array();
		$conditions['id'] = $this->get_telephone_number_id();

		$number_of_telephone_numbers = $telephone_numbers_table->count_rows_where($conditions);

		if ($number_of_telephone_numbers > 0)
		{
			return TRUE;
		}
		return FALSE;
	}

	public function
		has_address()
	{
		$database = $this->get_database();
		$addresses_table = $database->get_table('hpi_shop_addresses');
		$conditions = array();
		$conditions['id'] = $this->get_address_id();

		$number_of_addresses = $addresses_table->count_rows_where($conditions);

		if ($number_of_addresses > 0)
		{
			return TRUE;
		}
		return FALSE;
	}

	public function 
		delete_address()
	{
		$database = $this->get_database();
		$addresses_table = $database->get_table('hpi_shop_addresses');
		$address_id = $this->get_address_id();

		$addresses_table->delete_by_id($address_id);
	}

	public function 
		get_telephone_number()
	{
		if ($this->has_telephone_number())
		{
			$database = $this->get_database();
			$telephone_numbers_table = $database->get_table('hpi_shop_telephone_numbers');
			$telephone_number_id = $this->get_telephone_number_id();

			return $telephone_numbers_table->get_row_by_id($telephone_number_id);
		}
	}

	public function 
		delete_telephone_number()
	{
		$database = $this->get_database();
		$telephone_numbers_table = $database->get_table('hpi_shop_telephone_numbers');
		$telephone_number_id = $this->get_telephone_number_id();

		$telephone_numbers_table->delete_by_id($telephone_number_id);
	}

	//        public function 
	//                get_email_address()
	//        {
	//                $database = $this->get_database();
	//                $email_addresses_table = $database->get_table('hpi_shop_email_addresses');
	//                $email_address_id = $this->get_email_address_id();
	//                
	//                return $email_addresses_table->get_row_by_id($email_address_id);
	//        }

	//        public function 
	//                delete_email_address()
	//        {
	//                $database = $this->get_database();
	//                $email_addresses_table = $database->get_table('hpi_shop_email_addresses');
	//                $email_address_id = $this->get_email_address_id();
	//                
	//                $email_addresses_table->delete_by_id($email_address_id);
	//        }

	public function
		is_supplier()
	{
		$database = $this->get_database();
		$suppliers_table = $database->get_table('hpi_shop_suppliers');

		$suppliers = $suppliers_table->get_all_rows();

		foreach ($suppliers as $supplier)
		{
			if ($supplier->get_email_address_string() == $this->get_email_address())
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	public function
		get_supplier()
	{
		$database = $this->get_database();
		$suppliers_table = $database->get_table('hpi_shop_suppliers');

		$suppliers = $suppliers_table->get_all_rows();

		foreach ($suppliers as $supplier)
		{
			if ($supplier->get_email_address_string() == $this->get_email_address())
			{
					{
						return $supplier;
					}
			}
		}
		return FALSE;
	}

	public function
		get_full_name_and_country_string()
	{
		$address = $this->get_address();

		return $this->get_first_name() 
			.
			'&nbsp;'
			.
			$this->get_last_name() 
			.
			'&nbsp;(' 
			.
			$address->get_locality() 
			.
			',&nbsp;' 
			.
			$address->get_country_name() 
			.
			')';
	}


}
?>
