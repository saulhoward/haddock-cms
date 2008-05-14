<?php
/**
 * Database_ModifyingStatementHelper
 *
 * @copyright 2008-04-01, RFI
 */

class
	Database_ModifyingStatementHelper
{
	/**
	 * Applies the modifying statement to the database.
	 *
	 * If the statement is a Database_SQLInsertStatement object or subclass,
	 * the insert ID is returned.
	 *
	 * Otherwise, the number of affected rows is returned.
	 */
	public static function
		apply_statement(
			Database_SQLStatement $statement
		)
	{
		echo __METHOD__ . "\n";
		
		#print_r($statement);
		#exit;
		
		$statement_as_string = $statement->get_as_string();
		
		#echo "\$statement_as_string:\n$statement_as_string\n";
		#echo 'strlen($statement_as_string): ' . strlen($statement_as_string) . "\n";
		#exit;
		
		$dbh = DB::m();
		
		mysql_query(
			$statement_as_string,
			$dbh
		);
		
		if (mysql_errno($dbh)) {
			throw new Database_MySQLException($dbh);
		}
		
		if ($statement instanceof Database_SQLInsertStatement) {
			return mysql_insert_id($dbh);
		} else {
			return mysql_affected_rows($dbh);
		}
	}
}
?>