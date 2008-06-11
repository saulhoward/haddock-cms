<?php
/**
 * Shop_AddressesTable
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Table.inc.php';
    
class
    Shop_AddressesTable
extends
    Database_Table
{
    public function
        add_address(
		$post_office_box,
		$extended_address,
		$street_address,
		$locality,
		$region,
		$postal_code,
		$country_name
	)
    {
        $values = array();
        
        $values['post_office_box'] = $post_office_box;
        $values['extended_address'] = $extended_address;
        $values['street_address'] = $street_address;
        $values['locality'] = $locality;
        $values['region'] = $region;
        $values['postal_code'] = $postal_code;
        $values['country_name'] = $country_name;
        
        return $this->add($values);
    }
    
    public function
        edit_address(
            $edit_id,
       		$post_office_box,
		$extended_address,
		$street_address,
		$locality,
		$region,
		$postal_code,
		$country_name
	)
    {
        $values = array();
        
        $values['post_office_box'] = $post_office_box;
        $values['extended_address'] = $extended_address;
        $values['street_address'] = $street_address;
        $values['locality'] = $locality;
        $values['region'] = $region;
        $values['postal_code'] = $postal_code;
        $values['country_name'] = $country_name;

	return $this->update_by_id($edit_id, $values);
    }
    
}
?>
