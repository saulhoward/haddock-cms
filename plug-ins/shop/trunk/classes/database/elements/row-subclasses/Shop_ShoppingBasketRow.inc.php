<?php
/**
 * Shop_ShoppingBasketRow
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Row.inc.php';

class
    Shop_ShoppingBasketRow
extends
    Database_Row
{
    public function
        get_session_id()
    {
        return $this->get('session_id');
    }
    
    public function
        get_product_id()
    {
        return $this->get('product_id');
    }

    public function
        get_customer_id()
    {
        return $this->get('customer_id');
    }

    public function
        get_customer_region_id()
    {
        #return $this->get('customer_region_id');
		return 1;
    }

    public function
        set_customer_id($customer_id)
    {
        $this->set('customer_id', $customer_id);
		$this->commit();
    }

    public function
        set_txn_id($txn_id)
    {
        $this->set('txn_id', $txn_id);
		$this->commit();
    }
    public function
        set_customer_region_id($customer_region_id)
    {
        $this->set('customer_region_id', $customer_region_id);
		$this->commit();
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
	    has_customer()
    {
	    if ($this->get_customer_id() == 0)
	    {
		    return FALSE;
	    }
	    return TRUE;
    }

    public function
        get_customer()
    {
	    if ($this->has_customer())
	    {
		    $database = $this->get_database();
		    $customers_table = $database->get_table('hpi_shop_customers');
		    return $customers_table->get_row_by_id($this->get_customer_id());
	    }
    }

    public function
        get_customer_region()
    {
        $database = $this->get_database();
        
        $customer_regions_table = $database->get_table('hpi_shop_customer_regions');
        
        return $customer_regions_table->get_row_by_id($this->get_customer_region_id());
    }

    public function
        get_product()
    {
        $database = $this->get_database();
        
        $products_table = $database->get_table('hpi_shop_products');
        
        return $products_table->get_row_by_id($this->get_product_id());
    }

    public function
		get_sub_total()
    {
		$database = $this->get_database();
		
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		if ($this->has_customer())
		{
			$customer_region_id = $this->get_customer_region_id();
		}
		else
		{
			$customer_region_id = $_SESSION['customer_region_id'];
		}
		
		#echo "\$customer_region_id: $customer_region_id\n"; exit;
		
		$customer_region = $customer_regions_table->get_row_by_id($customer_region_id);
		$currency = $customer_region->get_currency();
		
		$product = $this->get_product();
		
		$product_currency_price = $product->get_product_currency_price($currency->get_id());
		
		$price = $product_currency_price->get_price();
		
		$sub_total = ($price * $this->get_quantity());
		
		return $sub_total;
    }

    public function
		get_shipping_total_for_customer_region()
    {
		$product = $this->get_product();
		if ($this->has_customer())
		{
			$customer_region_id = $this->get_customer_region_id();
		}
		else
		{
			$customer_region_id = $_SESSION['customer_region_id'];
		}
		return $product->get_shipping_price_for_customer_region($this->get_quantity(), $customer_region_id);
    }

    public function
		get_shipping_total_for_current_session()
    {
		$product = $this->get_product();
		return $product->get_shipping_price_for_current_session($this->get_quantity());
		
//                $shipping_total = ($shipping_price * $this->get_quantity());
//                return $shipping_total;
    }
}
?>
