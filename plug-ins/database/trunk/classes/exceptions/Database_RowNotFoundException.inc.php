<?php
/**
 * Database_RowNotFoundException
 *
 * @copyright Clear Line Web Design, 2006-09-23
 */

/**
 * The exception to throw when a row is not found in
 * a table.
 */
class
    Database_RowNotFoundException
extends
    Exception
{
    public function __construct($table_name, $id)
    {
        parent::__construct("No row in $table_name with id = $id!");
    }
}

?>
