<?php
/**
 * Shop_OrdersTable
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

class
	Shop_OrdersTable
extends
	Database_Table
{
//        public function check_for_product_in_current_session($product_id, $session_id)
//        {
//                $conditions['product_id'] = $product_id;
//                $conditions['session_id'] = "'" . $session_id . "'";
//                $conditions['deleted'] = 'no';
//                $conditions['moved_to_orders'] = 'no';

//                $product_row = $this->get_rows_where($conditions);

//                if (count($product_row) > 0)
//                {
//                        return TRUE;
//                }
//                else
//                {
//                        return FALSE;
//                }
//        }
	public function get_orders_for_customer(Shop_CustomerRow $customer, $order_by = NULL)
	{
		$conditions = array();
		$conditions['customer_id'] = $customer->get_id();
		$conditions['deleted'] = 'no';

		if ($order_by)
		{
			return $this->get_rows_where($conditions, $order_by, 'DESC');
		}
		
		return $this->get_rows_where($conditions);
	}

	public function check_for_customer_in_orders(Shop_CustomerRow $customer)
	{
		$conditions = array();
		$conditions['customer_id'] = $customer->get_id();
		$conditions['deleted'] = 'no';
		$number_of_customers = $this->count_rows_where($conditions);

		if ($number_of_customers > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function get_orders_for_supplier(Shop_SupplierRow $supplier, $order_by = NULL)
	{
		$products = $supplier->get_products();
		$orders  = array();

		foreach ($products as $product)
		{
			$conditions = array();
			$conditions['product_id'] = $product->get_id();
			$conditions['deleted'] = 'no';

			if ($order_by)
			{
				$orders = array_merge($orders, $this->get_rows_where($conditions, $order_by, 'DESC'));
			}
			else
			{
				$orders = array_merge($orders, $this->get_rows_where($conditions));
			}
		}

		//print_r($orders);
		return $orders;
	}

	public function check_for_supplier_in_orders(Shop_SupplierRow $supplier)
	{
		$products = $supplier->get_products();
		$number_of_orders = 0;

		foreach ($products as $product)
		{
			$conditions = array();
			$conditions['product_id'] = $product->get_id();
			$conditions['deleted'] = 'no';
			$number_of_orders += $this->count_rows_where($conditions);
		}

		if ($number_of_orders > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

//        public function
//                add_orders_with_shipping_address(
//                        $name,
//                        $email_address,
//                        $telephone_number,
//                        $post_office_box,
//                        $extended_address,
//                        $street_address,
//                        $locality,
//                        $region,
//                        $postal_code,
//                        $country_name,
//                        $customer_region_id
//                )
//        {
//                $database = $this->get_database();
//                $customers_table = $database->get_table('hpi_shop_customers');
//                $shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');

//                $customer_id = $customers_table->add_customer(
//                        $name,
//                        $email_address,
//                        $telephone_number,
//                        $post_office_box,
//                        $extended_address,
//                        $street_address,
//                        $locality,
//                        $region,
//                        $postal_code,
//                        $country_name,
//                        $customer_region_id
//                );

//                $shopping_baskets_for_current_session = 
//                        $shopping_baskets_table->get_shopping_baskets_for_current_session();

//                foreach ($shopping_baskets_for_current_session as $shopping_basket_for_current_session)
//                {
//                        $this->add_order_from_shopping_basket($shopping_basket_for_current_session, $customer_id);
//                }

//        }

	public function
		add_order(
			$session_id,
			$shopping_basket_id,
			$customer_id,
			$status,
			$product_id,
			$quantity
		)
	{
		$log_file_name = $_SERVER['DOCUMENT_ROOT'] . '/../logs/ipn-post.txt';

		if ($fh = fopen($log_file_name, 'a'))
		{
			fwrite ($fh, "\n---- ADD ORDER REACHED... ----");
			fclose($fh);
		}

		$database = $this->get_database();
		$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
		$products_table = $database->get_table('hpi_shop_products');

		$updated_shopping_basket_values['moved_to_orders'] = 'yes';
		$shopping_baskets_table->update_by_id($shopping_basket_id, $updated_shopping_basket_values);

		if ($fh = fopen($log_file_name, 'a'))
		{
			fwrite ($fh, "\n---- SHOPPING BASKET UPDATED... ----");
			fclose($fh);
		}

		$product = $products_table->get_row_by_id($product_id);
		$product->remove_quantity_from_stock($quantity);

		if ($fh = fopen($log_file_name, 'a'))
		{
			fwrite ($fh, "\n---- STOCK LEVEL UPDATED... ----");
			fclose($fh);
		}

		$order_values = array();
		$order_values['added'] = 'NOW()';
		$order_values['session_id'] = "'" . $session_id . "'";
		$order_values['shopping_basket_id'] = $shopping_basket_id;
		$order_values['customer_id'] = $customer_id;
		$order_values['status'] = $status;
		$order_values['product_id'] = $product_id;
		$order_values['quantity'] = $quantity;
		$order_values['deleted'] = 'no';

		if ($fh = fopen($log_file_name, 'a'))
		{
			fwrite ($fh, "\n---- ORDER VALUES CREATED... ----");
			fclose($fh);
		}

		$order_id = $this->add($order_values);

		$order = $this->get_row_by_id($order_id);
		$order->email_customer_order_confirmation();
		$order->email_supplier_order_confirmation();

		if ($fh = fopen($log_file_name, 'a'))
		{
			fwrite ($fh, "\n---- EMAILED CUSTOMER & SUPPLIER... ----");
			fclose($fh);
		}

		return $order_id;
	}

	public function
		add_order_with_txn_id(
			$session_id,
			$customer_id,
			$status,
			$txn_id
		)
	{
		$order_values = array();
		$order_values['added'] = 'NOW()';
		$order_values['session_id'] = "'" . $session_id . "'";
		$order_values['customer_id'] = $customer_id;
		$order_values['status'] = $status;
		$order_values['deleted'] = 'no';
		$order_values['txn_id'] = $txn_id;

		$order_id = $this->add($order_values);

//                print_r('order_id');exit;

		$order = $this->get_row_by_id($order_id);
//                $order->email_customer_order_confirmation();
//                $order->email_supplier_order_confirmation();

		return $order_id;
	}

	public function
		add_order_from_shopping_basket(
			Shop_ShoppingBasketRow $shopping_basket,
			$customer_id
		)
	{
		$database = $this->get_database();
		$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');

		$values = array();

		$values['added'] = 'NOW()';
		$values['session_id'] = "'" . $shopping_basket->get_session_id() . "'";
		$values['product_id'] = $shopping_basket->get_product_id();
		$values['quantity'] = $shopping_basket->get_quantity();
		$values['customer_id'] = $customer_id;

		$added_order_id = $this->add($values);

		$updated_shopping_basket_values['moved_to_orders'] = 'yes';

		$shopping_baskets_table->update_by_id($shopping_basket->get_id(), $updated_shopping_basket_values);

		return $added_order_id;
	}

	public function
		edit_order(
			$edit_id,
			$status
		)
	{
		$values = array();
		$values['status'] = $status;

		return $this->update_by_id($edit_id, $values);
	}

	public function get_orders_for_current_session()
	{
		$session_id = session_id();

		$conditions = array();
		//            print_r($session_id);
		$conditions['session_id'] = "'" . $session_id . "'";
		$conditions['deleted'] = 'no';
		$order_rows = $this->get_rows_where($conditions, 'added', 'DESC', 0, 0);

		return $order_rows;
	}

	public function get_sub_total_for_current_session()
	{
		$order_rows = $this->get_orders_for_current_session();

		$sub_total = 0;

		foreach($order_rows as $order_row)
		{
			$sub_total += $order_row->get_sub_total();
		}
		return $sub_total;
	}

	public function
		delete_order (
			$delete_id
		)
	{
		$values = array();
		$values['deleted'] = 'yes';

		return $this->update_by_id($delete_id, $values);
		//                $this->delete_by_id($delete_id);

	}

	public function
		get_shipping_total_for_current_session()
	{
		$order_rows = $this->get_orders_for_current_session();

		$shipping_total = 0;

		foreach($order_rows as $order_row)
		{
			$shipping_total += $order_row->get_shipping_total_for_current_session();
		}
		return $shipping_total;
	}

	public function
		get_total_for_current_session($shipping_location)
	{
		$total = 0;

		$total += $this->get_sub_total_for_current_session();
		$total += $this->get_shipping_total_for_current_session($shipping_location);

		return $total;
	}

	public function
		delete_illegal_orders_for_current_customer_region()
	{
		$order_rows = $this->get_orders_for_current_session();

		foreach ($order_rows as $order_row)
		{
			$product = $order_row->get_product();
			if (!$product->is_active())
			{
				$this->delete_order($order_row->get_id());
			}
		}

		return TRUE;
	}

	public function
		count_orders()
	{
		return $this->count_all_rows();    
	}

	public function
		count_orders_for_status($status)
	{
		$conditions = array();
		$conditions['status'] = $status;
		return $this->count_rows_where($conditions);    
	}
}
?>
