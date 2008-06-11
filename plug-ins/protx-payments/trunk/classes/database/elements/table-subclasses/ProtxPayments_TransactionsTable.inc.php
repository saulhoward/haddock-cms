<?php
/**
 * ProtxPayments_TransactionsTable
 *
 * @copyright Clear Line Web Design, 2007-10-01
 */

class
ProtxPayments_TransactionsTable
extends
Database_Table
{
	public function
		add_transaction(
			$session_id,
			$status,
			$status_detail,
			$vendor_tx_code,
			$vps_tx_id,
			$tx_auth_no,
			$amount,
			$avscv2,
			$address_result,
			$postcode_result,
			$cv2_result,
			$gift_aid,
			$threedee_secure_status,
			$cavv
		)
	{

		$database = $this->get_database();
		$orders_table = $database->get_table('hpi_shop_orders');
		$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
		$customers_table = $database->get_table('hpi_shop_customers');
		$orders_table = $database->get_table('hpi_shop_orders');

		# Find the shopping baskets that correspond to this transaction
		$conditions = array();
		$conditions['txn_id'] = "'" . $vendor_tx_code . "'";
		$conditions['moved_to_orders'] = 'no';
		$conditions['deleted'] = 'no';
		$shopping_baskets = $shopping_baskets_table->get_rows_where($conditions);

//                print_r($shopping_baskets);exit;
		$customer_id = $shopping_baskets[0]->get_customer_id(); 

		# IF status==ok
		if ($status == 'OK')
		{
			// Update the shopping_baskets
			foreach ($shopping_baskets as $shopping_basket)
			{
				$updated_shopping_basket_values['moved_to_orders'] = 'yes';
				$shopping_baskets_table->update_by_id(
					$shopping_basket->get_id(), $updated_shopping_basket_values);

				// And the product
				/*
				 * Don't do this yet.
				 *
				 * Wait until the order has been confirmed and do this
				 * with the track it admin.
				 */
				$products_table = $database->get_table('hpi_shop_products');
				$product = $shopping_basket->get_product();
				#$product->remove_quantity_from_stock($shopping_basket->get_quantity());
			}

			# Add most of this to the Orders table
			//                add_order_with_txn_id(
			//                        $session_id,
			//                        $customer_id,
			//                        $status,
			//                        $txn_id
			//                )
			$order_id = $orders_table->add_order_with_txn_id(
				$session_id,		#$session_id,
				$customer_id,		#$customer_id,
				'paid',			#$status,
				$vendor_tx_code		#$txn_id
			);
		}
		

		# Add the rest to this table
//                        $session_id,
//                        $status,
//                        $status_detail,
//                        $vendor_tx_code,
//                        $vps_tx_id,
//                        $tx_auth_no,
//                        $amount,
//                        $avscv2,
//                        $address_result,
//                        $postcode_result,
//                        $cv2_result,
//                        $gift_aid,
//                        $threedee_secure_status,
//                        $cavv
		$values = array();
		$values['added'] = 'NOW()';
		$values['session_id'] = "'" . $session_id . "'";
		$values['status'] = $status;
		$values['status_detail'] = $status_detail;
		$values['vendor_tx_code'] = "'" . $vendor_tx_code . "'";
		$values['vps_tx_id'] = "'" . $vps_tx_id . "'";
		$values['tx_auth_no'] = "'" . $tx_auth_no . "'";
		$values['amount'] = $amount;
		$values['AVSCV2'] = $avscv2;
		$values['address_result'] = $address_result;
		$values['postcode_result'] = $postcode_result;
		$values['CV2_result'] = $cv2_result;
		$values['gift_aid'] = $gift_aid;
		$values['3D_secure_status'] = $threedee_secure_status;
		$values['CAVV'] = $cavv;

		return $this->add($values);
	}

	public function
		txn_id_is_new($txn_id)
	{
		$conditions = array();
		$conditions['vendor_tx_code'] = $txn_id;

		$number_of_transactions = $this->count_rows_where($conditions);

		if ($number_of_transactions >= 1)
		{
			return FALSE;
		}
		return TRUE;
	}

	public function
		check_payments_against_shopping_baskets(
			$session_id, 
			$payment_amount_to_be_checked, 
			$payment_currency_to_be_checked
		)
	{
		$database = $this->get_database();
		$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');

		$shopping_baskets = $shopping_baskets_table->get_shopping_baskets_for_session($session_id);

		$customer_region = $shopping_baskets[0]->get_customer_region();

		$payment_currency = $customer_region->get_currency();
		$payment_amount_unformatted = $shopping_baskets_table->get_total_for_session($session_id);
		$payment_amount = new Shop_SumOfMoney($payment_amount_unformatted, $payment_currency);
		if (
			$payment_amount_to_be_checked == $payment_amount->get_as_string(FALSE)
			&&
			$payment_currency_to_be_checked == $payment_currency->get_iso_4217_code()
		)
		{
			return TRUE;
		}
		return FALSE;
	}
}
?>
