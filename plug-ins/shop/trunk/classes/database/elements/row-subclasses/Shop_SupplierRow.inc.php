<?php
/**
 * Shop_SupplierRow
 *
 * @copyright Clear Line Web Design, 2007-03-05
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Row.inc.php';

class
	Shop_SupplierRow
extends
    Database_Row
{
	public function 
		get_name()
	{
		return $this->get('name');
	}

	public function 
		get_contact_name()
	{
		return $this->get('contact_name');
	}
 
	public function 
		get_notes()
	{
		return $this->get('notes');
	}

	public function 
		get_currency_id()
	{
		return $this->get('currency_id');
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
		get_email_address_id()
	{
		return $this->get('email_address_id');
	}
			
	public function 
		get_currency()
	{
		$database = $this->get_database();
		$currencies_table = $database->get_table('hpi_shop_currencies');
		$currency_id = $this->get_currency_id();
		
		return $currencies_table->get_row_by_id($currency_id);
	}

	public function 
		get_address()
	{
		$database = $this->get_database();
		$addresses_table = $database->get_table('hpi_shop_addresses');
		$address_id = $this->get_address_id();
		
		return $addresses_table->get_row_by_id($address_id);
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
		$database = $this->get_database();
		$telephone_numbers_table = $database->get_table('hpi_shop_telephone_numbers');
		$telephone_number_id = $this->get_telephone_number_id();
		
		return $telephone_numbers_table->get_row_by_id($telephone_number_id);
	}

	public function 
		delete_telephone_number()
	{
		$database = $this->get_database();
		$telephone_numbers_table = $database->get_table('hpi_shop_telephone_numbers');
		$telephone_number_id = $this->get_telephone_number_id();
		
		$telephone_numbers_table->delete_by_id($telephone_number_id);
	}

	public function 
		get_email_address()
	{
		$database = $this->get_database();
		$email_addresses_table = $database->get_table('hpi_shop_email_addresses');
		$email_address_id = $this->get_email_address_id();
		
		return $email_addresses_table->get_row_by_id($email_address_id);
	}

	public function
		get_email_address_string()
	{
		$email_address = $this->get_email_address();
		return $email_address->get_email_address();
	}

	public function 
		delete_email_address()
	{
		$database = $this->get_database();
		$email_addresses_table = $database->get_table('hpi_shop_email_addresses');
		$email_address_id = $this->get_email_address_id();
		
		$email_addresses_table->delete_by_id($email_address_id);
	}

	public function
		get_products()
	{
		$database = $this->get_database();
		$products_table = $database->get_table('hpi_shop_products');

		$conditions = array();
		$conditions['supplier_id'] = $this->get_id();

		return $products_table->get_rows_where($conditions);
	}

	public function
		get_active_products()
	{
		$database = $this->get_database();
		$products_table = $database->get_table('hpi_shop_products');

		$conditions = array();
		$conditions['supplier_id'] = $this->get_id();
		$conditions['status'] = 'display';

		$products = $products_table->get_rows_where($conditions);
		#print_r($products);

		return $products;
	}

	public function
		get_active_products_for_product_category($product_category_id)
	{
		$database = $this->get_database();
		$products_table = $database->get_table('hpi_shop_products');

		$conditions = array();
		$conditions['supplier_id'] = $this->get_id();
		$conditions['status'] = 'display';
		$conditions['product_category_id'] = $product_category_id;

		$products = $products_table->get_rows_where($conditions);
		#print_r($products);

		return $products;
	}
}
?>
