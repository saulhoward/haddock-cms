<?php
/**
 * Shop_ShoppingBasketsTable
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

class
	Shop_ShoppingBasketsTable
extends
	Database_Table
{
	public function
		check_for_product_in_current_session($product_id, $session_id, $size=NULL, $colour=NULL)
	{
//                if (!isset($size) || !isset($colour))
//                {
//                        throw new Exception('Size or Colour not set when checking for product in current session');
//                }
		$conditions['product_id'] = $product_id;
		$conditions['session_id'] = "'" . $session_id . "'";
		$conditions['deleted'] = 'no';
		if (isset($size))
		{
			$conditions['size'] = $size;
		}
		if (isset($colour))
		{
			$conditions['colour'] = $colour;
		}
		$conditions['moved_to_orders'] = 'no';

		$product_row = $this->get_rows_where($conditions);

		if (count($product_row) > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function
		check_for_current_session_in_shopping_baskets()
	{
		$conditions['session_id'] = "'" . session_id() . "'";
		$conditions['deleted'] = 'no';
		$conditions['moved_to_orders'] = 'no';
		$number_of_baskets = $this->count_rows_where($conditions);

		if ($number_of_baskets > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function
		add_shopping_basket(
			$product_id,
			$session_id,
			$quantity,
			$size,
			$colour
		)
	{
		$shopping_basket_already_exists = 
			$this->check_for_product_in_current_session($product_id, $session_id, $size, $colour);

		$log_in_manager = Shop_LogInManager::get_instance();
		if ($log_in_manager->is_logged_in()) {
			$customer = $log_in_manager->get_user();
			$customer_id = $customer->get_id();
		} else {
			$customer_id = 0;
		}

		if ($shopping_basket_already_exists) {
			$conditions['product_id'] = $product_id;
			$conditions['size'] = $size;
			$conditions['colour'] = $colour;
			$conditions['session_id'] = "'" . $session_id . "'";
			$conditions['deleted'] = 'no';
			$conditions['moved_to_orders'] = 'no';
			$shopping_basket_row = $this->get_rows_where($conditions);

//                        echo count($shopping_basket_row);

			$previous_quantity = $shopping_basket_row[0]->get_quantity();
			$new_quantity = ($previous_quantity + $quantity);

			$values = array();
			$values['quantity'] = $new_quantity;
			$values['customer_region_id'] = $_SESSION['customer_region_id'];
			$values['customer_id'] = $customer_id;

			return $this->update_by_id($shopping_basket_row[0]->get_id(), $values);
		} else {
			$values = array();

			$values['added'] = 'NOW()';
			$values['session_id'] = "'" . $session_id . "'";
			$values['customer_region_id'] = $_SESSION['customer_region_id'];
			$values['product_id'] = $product_id;
			$values['size'] = $size;
			$values['colour'] = $colour;
			$values['quantity'] = $quantity;
			$values['customer_id'] = $customer_id;

			return $this->add($values);
		}
	}
	
	/**
	 * Changes the quantity of a product in the shopping basket.
	 *
	 * Checks that there is enough of the product first.
	 */
	public function
		edit_shopping_basket(
			$edit_id,
			$quantity
		)
	{
		$log_in_manager = Shop_LogInManager::get_instance();
		if ($log_in_manager->is_logged_in())
		{
			$customer = $log_in_manager->get_user();
			$customer_id = $customer->get_id();
		}
		else
		{
			$customer_id = 0;
		}
		
		$shopping_basket_item = $this->get_row_by_id($edit_id);
		
		$variation = array();
		
		$variation['size'] = $shopping_basket_item->get('size');
		$variation['colour'] = $shopping_basket_item->get('colour');
		
		$available_stock_level
			= Shop_StockLevelsHelper
				::get_available_stock_level(
					$shopping_basket_item->get_product_id(),
					$variation
				);
		
		if ($available_stock_level >= $quantity) {
			$values = array();
			
			$values['quantity'] = $quantity;
			$values['customer_region_id'] = $_SESSION['customer_region_id'];
			$values['customer_id'] = $customer_id;
			
			return $this->update_by_id($edit_id, $values);
		} else {
			throw new Shop_StockNotAvailableException($edit_id, $quantity, $available_stock_level);
		}
	}

	public function get_shopping_baskets_for_current_session()
	{
//                $session_id = session_id();

//                $conditions = array();
//                $conditions['session_id'] = "'" . $session_id . "'";
//                $conditions['deleted'] = 'no';
//                $conditions['moved_to_orders'] = 'no';
//                $shopping_basket_rows = $this->get_rows_where($conditions, 'added', 'DESC', 0, 0);

		return $this->get_shopping_baskets_for_session(session_id());
	}

	public function
		get_shopping_baskets_for_session($session_id)
	{
		$conditions = array();
		//            print_r($session_id);
		$conditions['session_id'] = "'" . $session_id . "'";
		$conditions['deleted'] = 'no';
		$conditions['moved_to_orders'] = 'no';
		$shopping_basket_rows = $this->get_rows_where($conditions, 'added', 'DESC', 0, 0);

		return $shopping_basket_rows;
	}

	public function
		convert_shopping_baskets_for_current_session_to_new_customer_region()
	{
		$shopping_baskets = $this->get_shopping_baskets_for_current_session();

		foreach ($shopping_baskets as $shopping_basket)
		{
			if ($shopping_basket->get_customer_region_id() != $_SESSION['customer_region_id'])
			{
				$shopping_basket->set_customer_region_id($_SESSION['customer_region_id']);
			}
		}
	}

	public function
		convert_shopping_baskets_for_current_session_to_new_customer($customer_id)
	{
		$shopping_baskets = $this->get_shopping_baskets_for_current_session();

		foreach ($shopping_baskets as $shopping_basket)
		{
			if ($shopping_basket->get_customer_id() != $customer_id)
			{
				$shopping_basket->set_customer_id($customer_id);
			}
		}
	}

	public function get_sub_total_for_session($session_id)
	{
		$shopping_basket_rows = $this->get_shopping_baskets_for_session($session_id);

		$sub_total = 0;

		foreach($shopping_basket_rows as $shopping_basket_row)
		{
			$sub_total += $shopping_basket_row->get_sub_total();
		}
		return $sub_total;
	}

	public function get_sub_total_for_current_session()
	{
		$shopping_basket_rows = $this->get_shopping_baskets_for_current_session();

		$sub_total = 0;

		foreach($shopping_basket_rows as $shopping_basket_row)
		{
			$sub_total += $shopping_basket_row->get_sub_total();
		}
		return $sub_total;
	}

	public function
		delete_shopping_basket (
			$delete_id
		)
	{
		$values = array();
		$values['deleted'] = 'yes';

		return $this->update_by_id($delete_id, $values);
		//                $this->delete_by_id($delete_id);

	}

	public function
		get_shipping_total_for_session($session_id, $customer_region_id)
	{
//                $shopping_basket_rows = $this->get_shopping_baskets_for_session($session_id);

//                $shipping_total = 0;

//                foreach($shopping_basket_rows as $shopping_basket_row)
//                {
//                        $shipping_total += $shopping_basket_row->get_shipping_total_for_customer_region();
//                }
//                return $shipping_total;
		$sub_total = $this->get_sub_total_for_session($session_id);
		if ($customer_region_id == 1) // United Kingdom
		{
			if ($sub_total < 5000)
			{
				return 450;
			}
			if ($sub_total >= 5000)
			{
				return 0;
			}
		}
		elseif ($customer_region_id == 2) // International
		{
			if ($sub_total < 5000)
			{
				return 1000;
			}
			if ($sub_total >= 5000)
			{
				return 1500;
			}
		}
	}


	public function
		get_shipping_total_for_current_session($customer_region_id)
	{
//                $shopping_basket_rows = $this->get_shopping_baskets_for_current_session();

//                $shipping_total = 0;

//                foreach($shopping_basket_rows as $shopping_basket_row)
//                {
//                        $shipping_total += $shopping_basket_row->get_shipping_total_for_current_session();
//                }
//                return $shipping_total;

		$sub_total = $this->get_sub_total_for_current_session();
//                print_r($sub_total);exit;
		if ($customer_region_id == 1) // United Kingdom
		{
			if ($sub_total < 5000)
			{
				return 450;
			}
			if ($sub_total >= 5000)
			{
				return 0;
			}
		}
		elseif ($customer_region_id == 2) // International
		{
			if ($sub_total < 5000)
			{
				return 1000;
			}
			if ($sub_total >= 5000)
			{
				return 1500;
			}
		}
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
		get_total_for_session($session_id)
	{
		$total = 0;

		$total += $this->get_sub_total_for_session($session_id);
		$total += $this->get_shipping_total_for_session($session_id);

		return $total;
	}

	public function
		delete_illegal_shopping_baskets_for_current_customer_region()
	{
		$shopping_basket_rows = $this->get_shopping_baskets_for_current_session();

		foreach ($shopping_basket_rows as $shopping_basket_row)
		{
			$product = $shopping_basket_row->get_product();
			if (!$product->is_active())
			{
				$this->delete_shopping_basket($shopping_basket_row->get_id());
			}
		}

		return TRUE;
	}

	/**
	 * Returns the URL for the redirect script that changes the
	 * shopping basket quantities and other actions.
	 */
	public static function
		get_public_redirect_script_url()
	{
		$location = new HTMLTags_URL();

		$location->set_file('/');

		$location->set_get_variable('section', 'plug-ins');
		$location->set_get_variable('module', 'shop');
		$location->set_get_variable('page', 'shopping-basket');
		$location->set_get_variable('type', 'redirect-script');

		return $location;
	}

	public static function
		get_restore_shopping_basket_item_url($sbid)
	{
		$undo_location = Shop_ShoppingBasketsTable::get_public_redirect_script_url();
		$undo_location->set_get_variable('restore_shopping_basket_id', $sbid);
		return $undo_location;
	}

	public static function
		get_product_name_for_sbid($shopping_basket_id)
	{
		$dbh = DB::m();

		$query = <<<SQL
SELECT
	hpi_shop_products.name
FROM
	hpi_shop_products
		INNER JOIN hpi_shop_shopping_baskets
			ON hpi_shop_products.id = hpi_shop_shopping_baskets.product_id
WHERE
	hpi_shop_shopping_baskets.id = $shopping_basket_id
SQL;

		$result = mysql_query($query, $dbh);

		if (
			$result
			&&
			$row = mysql_fetch_assoc($result)
		) {
			return $row['name'];
		}else {
			throw new Exception("Unable to find the name of the product for the shopping basket with ID $shopping_basket_id!");
		}
	}

	public static function
		restore_shopping_basket($sbid)
	{
		$dbh = DB::m();

		$stmt = <<<SQL
UPDATE
	hpi_shop_shopping_baskets
SET
	deleted = 'no'
WHERE
	id = $sbid
SQL;

		mysql_query($stmt, $dbh);
	}

}
?>
