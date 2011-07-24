<?php
/**
 * Shop_EmailAddressesTable
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */
    
class
    Shop_EmailAddressesTable
extends
    Database_Table
{
    public function
        add_email_address(
		$email_address
	)
    {
        $values = array();
        
        $values['email_address'] = $email_address;
        
        return $this->add($values);
    }
    
    public function
        edit_email_address(
            $edit_id,
		$email_address
	)
    {
        $values = array();
        
        $values['email_address'] = $email_address;

	return $this->update_by_id($edit_id, $values);
    }
    
}
?>
