<?php
/**
 * Shop_StockNotAvailableException
 *
 * @copyright Clear Line Web Design, 2008-02-25
 */

class
    Shop_StockNotAvailableException
extends
    Shop_Exception
{
    public function
        __construct(
            $product_id,
            $requested_quantity,
            $available_stock_level
        )
    {
        parent::__construct("$requested_quantity items of product $product requested but only $available_stock_level available!");
    }
}
?>