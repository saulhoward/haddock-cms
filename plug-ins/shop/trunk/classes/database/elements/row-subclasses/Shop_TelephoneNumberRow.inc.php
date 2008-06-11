<?php
/**
 * Shop_TelephoneNumberRow
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Row.inc.php';

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
