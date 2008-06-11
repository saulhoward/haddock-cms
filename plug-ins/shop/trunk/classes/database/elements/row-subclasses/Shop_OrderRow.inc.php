<?php
/**
 * Shop_OrderRow
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

require_once PROJECT_ROOT
. '/haddock/database/classes/elements/'
. 'Database_Row.inc.php';

class
	Shop_OrderRow
	extends
	Database_Row
{
	public function
		get_session_id()
	{
		return $this->get('session_id');
	}
	public function
		get_txn_id()
	{
		return $this->get('txn_id');
	}
	public function
		get_product_id()
	{
		return $this->get('product_id');
	}

	public function
		get_shopping_basket_id()
	{
		return $this->get('shopping_basket_id');
	}

	public function
		get_customer_id()
	{
		return $this->get('customer_id');
	} 

	public function
		get_status()
	{
		return $this->get('status');
	}

	public function
		get_added()
	{
		return $this->get('added');
	}

	public function
		get_quantity()
	{
		return $this->get('quantity');
	}

	public function
		get_product()
	{
		$database = $this->get_database();

		$products_table = $database->get_table('hpi_shop_products');

		return $products_table->get_row_by_id($this->get_product_id());
	}

	public function
		get_shopping_basket()
	{
		$database = $this->get_database();

		$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');

		return $shopping_baskets_table->get_row_by_id($this->get_shopping_basket_id());
	}

	public function
		get_customer()
	{
		$database = $this->get_database();

		$customers_table = $database->get_table('hpi_shop_customers');

		return $customers_table->get_row_by_id($this->get_customer_id());
	}

	public function
		get_sub_total()
	{
		$database = $this->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
		$currency = $customer_region->get_currency();

		$product = $this->get_product();

		$product_currency_price = $product->get_product_currency_price($currency->get_id());


		$price = $product_currency_price->get_price();

		$sub_total = ($price * $this->get_quantity());
		return $sub_total;
	}

	public function
		get_shipping_total_for_current_session()
	{
		$product = $this->get_product();
		$shipping_price = $product->get_shipping_price_for_current_session();

		$shipping_total = ($shipping_price * $this->get_quantity());
		return $shipping_total;
	}

	public function
		email_customer_order_confirmation()
	{
		$customer = $this->get_customer();
		$email = $customer->get_email_address();

		$subject = $this->get_customer_order_confirmation_email_subject();
		$message = $this->get_customer_order_confirmation_email_message();
		$reply_name = $this->get_customer_order_confirmation_email_reply_name();
		$headers = 
			'From: ' 
			. $reply_name . '<' . $this->get_customer_order_confirmation_email_reply_address() . ">\r\n" .
			'Reply-To: '
			. $reply_name . '<' . $this->get_customer_order_confirmation_email_reply_address() . ">\r\n" .
			'X-Mailer: PHP/' . phpversion();

		//echo "\$email: $email\n";
		//echo "\$subject: $subject\n";
		//echo "\$message: $message\n";
		//echo "\$headers: $headers\n";
		//exit;

		mail($email, $subject, $message, $headers);
	}

	protected function
		get_customer_order_confirmation_email_reply_name()
	{
		$shop_config_file = $this->get_shop_module_directory();
		$reply_name = $shop_config_file->
			get_nested_config_variable(
				array(
					'customer-order-confirmation-email-settings', 
					'email-reply-name'
				), 
				$required = TRUE
			);
		return $reply_name;
	}


	protected function
		get_customer_order_confirmation_email_reply_address()
	{
		$shop_config_file = $this->get_shop_module_directory();
		$reply_address = $shop_config_file->
			get_nested_config_variable(
				array(
					'customer-order-confirmation-email-settings', 
					'email-reply-address'
				), 
				$required = TRUE
			);
		return $reply_address;
	}
	
	protected function
		get_customer_order_confirmation_email_subject()
	{
		$shop_config_file = $this->get_shop_module_directory();
		$email_subject = $shop_config_file->
			get_nested_config_variable(
				array('customer-order-confirmation-email-settings', 'email-subject'), $required = TRUE
			);
		return $email_subject;
	}
	
	protected function
		get_customer_order_confirmation_email_message()
	{
		$shop_config_file = $this->get_shop_module_directory();
		
		$order_id = $this->get_id();
		$order_quantity = $this->get_quantity();
//                $product = $this->get_product();
//                $product_name = $product->get_name();
		$customer = $this->get_customer();
		$address = $customer->get_address();
		$customer_address = 
			$address->get_street_address() 
			.
			",\r\n" 
			.
			$address->get_locality() . ' ' . $address->get_postal_code() 
			.
			",\r\n" 
			.
			$address->get_country_name();

		$customer_order_confirmation_email_message
			= $shop_config_file->get_nested_config_variable(
				array(
					'customer-order-confirmation-email-settings',
					'email-message'
				),
				$required = TRUE
			);
		
		$customer_order_confirmation_email_message
			= preg_replace('/(?<!\\\\)\\$order_id/', $order_id, $customer_order_confirmation_email_message);
		$customer_order_confirmation_email_message
			= preg_replace(
				'/(?<!\\\\)\\$order_quantity/', 
				$order_quantity, $customer_order_confirmation_email_message
			);
		$customer_order_confirmation_email_message
			= preg_replace(
				'/(?<!\\\\)\\$product_name/', 
				$product_name, $customer_order_confirmation_email_message
			);
		$customer_order_confirmation_email_message
			= preg_replace(
				'/(?<!\\\\)\\$customer_address/', 
				$customer_address, $customer_order_confirmation_email_message
			);

		$customer_order_confirmation_email_message
			= preg_replace('/(?<!\\\\)\\\\(?=\\$)/', '', $customer_order_confirmation_email_message);
		$customer_order_confirmation_email_message
			= preg_replace('/\\\\\\\\/', '\\', $customer_order_confirmation_email_message);
		
		//echo '$customer_order_confirmation_email_message: ' . "\n";
		//echo "$customer_order_confirmation_email_message\n";
		//exit;
		
		return $customer_order_confirmation_email_message;
	}

	public function
		email_supplier_order_confirmation()
	{
//                $product = $this->get_product();
//                $supplier = $product->get_supplier();
		$email_address = $supplier->get_email_address();
		$email = $email_address->get_email_address();

		$subject = $this->get_supplier_order_confirmation_email_subject();
		$message = $this->get_supplier_order_confirmation_email_message();
		$reply_name = $this->get_supplier_order_confirmation_email_reply_name();
		$headers = 
			'From: ' 
			. $reply_name . '<' . $this->get_customer_order_confirmation_email_reply_address() . ">\r\n" .
			'Reply-To: ' 
			. $reply_name . '<' . $this->get_supplier_order_confirmation_email_reply_address() . ">\r\n" .
			'BCC: ' . $this->get_supplier_order_confirmation_email_bcc_address() . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		//echo "\$email: $email\n";
		//echo "\$subject: $subject\n";
		//echo "\$message: $message\n";
		//echo "\$headers: $headers\n";
		//exit;

		mail($email, $subject, $message, $headers);
	}

	protected function
		get_supplier_order_confirmation_email_reply_name()
	{
		$shop_config_file = $this->get_shop_module_directory();
		$reply_name = $shop_config_file->
			get_nested_config_variable(
				array(
					'supplier-order-confirmation-email-settings', 
					'email-reply-name'
				), 
				$required = TRUE
			);
		return $reply_name;
	}

	protected function
		get_supplier_order_confirmation_email_reply_address()
	{
		$shop_config_file = $this->get_shop_module_directory();
		$reply_address = $shop_config_file->
			get_nested_config_variable(
				array(
					'supplier-order-confirmation-email-settings', 
					'email-reply-address'
				), 
				$required = TRUE
			);
		return $reply_address;
	}
	
	protected function
		get_supplier_order_confirmation_email_bcc_address()
	{
		$shop_config_file = $this->get_shop_module_directory();
		$bcc_address = $shop_config_file->
			get_nested_config_variable(
				array(
					'supplier-order-confirmation-email-settings', 
					'email-bcc-address'
				), 
				$required = TRUE
			);
		return $bcc_address;
	}
	

	protected function
		get_supplier_order_confirmation_email_subject()
	{
		$shop_config_file = $this->get_shop_module_directory();
		$email_subject = $shop_config_file->
			get_nested_config_variable(
				array('supplier-order-confirmation-email-settings', 'email-subject'), $required = TRUE
			);
		return $email_subject;
	}
	
	protected function
		get_supplier_order_confirmation_email_message()
	{
		$shop_config_file = $this->get_shop_module_directory();
		
		$order_id = $this->get_id();
		$order_quantity = $this->get_quantity();
		$product = $this->get_product();
		$supplier = $product->get_supplier();
		$supplier_contact_name = $supplier->get_contact_name();
		$supplier_name = $supplier->get_name();
		$product_name = $product->get_name();
		$customer = $this->get_customer();
		$customer_full_name = $customer->get_first_name() . ' ' . $customer->get_last_name();
		$address = $customer->get_address();
		$customer_address = 
			$address->get_street_address() 
			.
			",\r\n"
			.
			$address->get_locality() . ' ' . $address->get_postal_code() 
			.
			",\r\n"
			.
			$address->get_country_name();

		$supplier_order_confirmation_email_message
			= $shop_config_file->get_nested_config_variable(
				array(
					'supplier-order-confirmation-email-settings',
					'email-message'
				),
				$required = TRUE
			);

		$supplier_order_confirmation_email_message
			= preg_replace(
				'/(?<!\\\\)\\$customer_full_name/', 
				$customer_full_name, $supplier_order_confirmation_email_message
			);
		$supplier_order_confirmation_email_message
			= preg_replace(
				'/(?<!\\\\)\\$supplier_contact_name/', 
				$supplier_contact_name, $supplier_order_confirmation_email_message
			);
		$supplier_order_confirmation_email_message
			= preg_replace('/(?<!\\\\)\\$order_id/', $order_id, $supplier_order_confirmation_email_message);
		$supplier_order_confirmation_email_message
			= preg_replace(
				'/(?<!\\\\)\\$order_quantity/', 
				$order_quantity, $supplier_order_confirmation_email_message
			);
		$supplier_order_confirmation_email_message
			= preg_replace(
				'/(?<!\\\\)\\$supplier_name/', 
				$supplier_name, $supplier_order_confirmation_email_message
			);
		$supplier_order_confirmation_email_message
			= preg_replace(
				'/(?<!\\\\)\\$product_name/', 
				$product_name, $supplier_order_confirmation_email_message
			);
		$supplier_order_confirmation_email_message
			= preg_replace(
				'/(?<!\\\\)\\$customer_address/', 
				$customer_address, $supplier_order_confirmation_email_message
			);

		$supplier_order_confirmation_email_message
			= preg_replace('/(?<!\\\\)\\\\(?=\\$)/', '', $supplier_order_confirmation_email_message);
		$supplier_order_confirmation_email_message
			= preg_replace('/\\\\\\\\/', '\\', $supplier_order_confirmation_email_message);
		
		//echo '$supplier_order_confirmation_email_message: ' . "\n";
		//echo "$supplier_order_confirmation_email_message\n";
		//exit;
		
		return $supplier_order_confirmation_email_message;
	}

	private function
		get_shop_module_directory()
	{
		$pdf =
			HaddockProjectOrganisation_ProjectDirectoryFinder
				::get_instance();
		$pd = $pdf->get_project_directory_for_this_project();
		$smd = $pd->get_plug_in_module_directory('shop');
        
		return $smd;
	}
}
?>
