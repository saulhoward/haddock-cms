<?php
/**
 * Shop_CurrenciesTable
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */
    
class
    Shop_CurrenciesTable
extends
    Database_Table
{
    public function
        add_currency(
            $name,
            $iso_4217_code,
            $symbol
        )
    {
        $values = array();
        
        $values['name'] = $name;
        $values['iso_4217_code'] = $iso_4217_code;
        $values['symbol'] = $symbol;
        
        return $this->add($values);
    }
    
    public function
        edit_currency(
            $edit_id,
            $name,
            $iso_4217_code,
            $symbol
       )
    {
        $values = array();
        
        $values['name'] = $name;
        $values['iso_4217_code'] = $iso_4217_code;
        $values['symbol'] = $symbol;
       
        return $this->update_by_id($edit_id, $values);
    }
    
}
?>
