<?php
/**
 * Shop_CurrencyRow
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

class
    Shop_CurrencyRow
extends
    Database_Row
{
    public function
        get_name()
    {
        return $this->get('name');
    }
    
    public function
        get_symbol()
    {
        return $this->get('symbol');
    }
    
    public function
        get_iso_4217_code()
    {
        return $this->get('iso_4217_code');
    }
   }
?>
