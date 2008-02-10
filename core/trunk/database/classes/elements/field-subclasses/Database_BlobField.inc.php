<?php
/**
 * Database_BlobField
 *
 * @copyright Clear Line Web Design, 2006-11-18
 */

/*
 * Define the necessary classes.
 */
require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/field-subclasses/'
    . 'Database_StringField.inc.php';


/**
 * A class to represent a field of type blob in a database table.
 */
class
    Database_BlobField
extends
    Database_StringField
{
    public function
        process_value($value)
    {
        #return stripslashes($value);
        return $value;
    }
}
?>
