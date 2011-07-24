<?php
/**
 * Shop_TextRow
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

class
    Shop_TextRow
extends
    Database_Row
{
   public function
        get_text()
    {
        return $this->get('text');
    }
}
?>
