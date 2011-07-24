<?php
/**
 * Shop_TelephoneNumberRow
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

class
    Shop_TelephoneNumberRow
extends
    Database_Row
{
   public function
        get_telephone_number()
    {
        return $this->get('telephone_number');
    }
}
?>
