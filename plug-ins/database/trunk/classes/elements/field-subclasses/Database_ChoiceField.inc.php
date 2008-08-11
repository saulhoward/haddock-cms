<?php
/**
 * Database_ChoiceField
 *
 * @copyright Clear Line Web Design, 2006-09-21
 */

/**
 * Define the necessary classes.
 */
require_once PROJECT_ROOT . '/haddock/database/classes/elements/Database_Field.inc.php';

/**
 * A class to represent a field in a database table
 * where there is some sort of finite choice.
 * 
 * e.g. ENUMs, foreign keys.
 */
interface
    Database_ChoiceField
{   
    public function
        get_options();
}
?>
