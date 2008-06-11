<?php
/**
 * Shop_AddressRow
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Row.inc.php';

class
    Shop_AddressRow
extends
    Database_Row
{
	public function
        get_post_office_box()
    {
        return $this->get('post_office_box');
    }

	public function
        has_post_office_box()
    {
	    if ($this->get('post_office_box') != '')
	    {
		    return TRUE;
	    }
	    else
	    {
		    return FALSE;
	    } 
    }

   public function
        get_extended_address()
    {
        return $this->get('extended_address');
    }

	public function
        has_extended_address()
    {
	    if ($this->get('extended_address') != '')
	    {
		    return TRUE;
	    }
	    else
	    {
		    return FALSE;
	    } 
    }


   public function
        get_street_address()
    {
        return $this->get('street_address');
    }


   public function
        get_locality()
    {
        return $this->get('locality');
    }


   public function
        get_region()
    {
        return $this->get('region');
    }


   public function
        get_postal_code()
    {
        return $this->get('postal_code');
    }


   public function
        get_country_name()
    {
        return $this->get('country_name');
    }
}
?>
