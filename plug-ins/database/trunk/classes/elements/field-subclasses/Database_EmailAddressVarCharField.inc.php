<?php
/**
 * Database_EmailAddressVarCharField
 *
 * @copyright Clear Line Web Design, 2007-07-18
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/elements/field-subclasses/'
#    . 'Database_VarCharField.inc.php';

/**
 * A class to represent an email address using a varchar in the database.
 *
 * Used by the mailing-list module.
 */
class
    Database_EmailAddressVarCharField
extends
    Database_VarCharField
{
    public function
        validate_value($value)
    {
        if (!preg_match('/^[a-z0-9._-]+(?:\+.*)?@[a-z0-9-]+(?:\.[a-z0-9-]+)*\.[a-z]{2,6}$/i', $value)) {
            throw new Exception("$value is not a valid email address!");
        }
        
        return TRUE;
    }
}
?>
