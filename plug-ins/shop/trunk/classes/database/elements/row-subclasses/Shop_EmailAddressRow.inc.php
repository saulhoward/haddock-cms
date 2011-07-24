<?php
/**
 * Shop_EmailAddressRow
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

class
    Shop_EmailAddressRow
extends
    Database_Row
{
   public function
        get_email_address()
    {
        return $this->get('email_address');
    }
}
?>
