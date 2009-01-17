<?php
/**
 * Database_SQLClause
 *
 * @copyright 2007-02-20, RFI
 */

/**
 * SQL statements are made up of clauses.
 *
 * They should all extend this class.
 */
abstract class
	Database_SQLClause
{
	abstract public function
		get_as_string();
}
?>