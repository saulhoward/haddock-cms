<?php
/**
 * Shop_TelephoneNumbersTable
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

class
    Shop_TelephoneNumbersTable
extends
    Database_Table
{
    public function
        add_telephone_number(
		$telephone_number
	)
    {
        $values = array();
        
        $values['telephone_number'] = $telephone_number;
        
        return $this->add($values);
    }
    
    public function
        edit_telephone_number(
            $edit_id,
		$telephone_number
	)
    {
        $values = array();
        
        $values['telephone_number'] = $telephone_number;

	return $this->update_by_id($edit_id, $values);
    }
    
}
?>
