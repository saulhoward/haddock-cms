<?php
/**
 * ProtxPayments_TransactionRow
 *
 * @copyright Clear Line Web Design, 2007-10-01
 */

class
	ProtxPayments_TransactionRow
extends
	Database_Row
{
	public function
		get_vendor_tx_code()
	{
		return $this->get('vendor_tx_code');
	}

//        public function
//                get_order_id()
//        {
//                return $this->get('order_id');
//        }

//        public function
//                get_order()
//        {
//                $database = $this->get_database();
//                $orders_table = $database->get_table('hpi_shop_orders');
//                $order_id = $this->get_order_id();

//                return $orders_table->get_row_by_id($order_id);
//        }
}
?>
