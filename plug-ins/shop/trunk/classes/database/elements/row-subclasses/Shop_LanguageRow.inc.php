<?php
/**
 * Shop_LanguageRow
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Row.inc.php';

class
    Shop_LanguageRow
extends
    Database_Row
{
    public function
        get_name()
    {
        return $this->get('name');
    }
       
    public function
        get_iso_639_1_code()
    {
        return $this->get('iso_639_1_code');
    }
   }
?>
