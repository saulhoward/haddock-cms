<?php
/**
 * Database_FieldNotInTableException
 *
 * @copyright Clear Line Web Design, 2006-09-08
 */

/**
 * An exception that is thrown when a field
 * is not in a table.
 */
class
    Database_FieldNotInTableException
extends
    Exception
{
    function __construct($table_name, $field)
    {
        parent::__construct("No field/column in $table_name called \"$field\"!");
    }
}

?>
