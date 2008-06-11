<?php
/**
 * Shop_TextRow
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Row.inc.php';

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
