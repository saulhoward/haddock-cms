<?php
/**
 * Database_TableHelper
 *
 * @copyright 2008-04-17, RFI
 */

class
	Database_TableHelper
{
	/**
	 * Returns the row from the table searching by ID.
	 *
	 * The fields that are found can be limited.
	 */
	public static function
		get_hash_by_id(
			$id,
			$table_name,
			$fields_str = '*',
			$id_field_name = 'id'
		)
	{
		#$hash = array();
		$hash = NULL;
		
		$dbh = DB::m();
		
		$query = 'SELECT ';
		
		if ($fields_str == '*') {
			$query .= $fields_str;
		} else {
			$fields = explode(' ', $fields_str);
			
			for ($i = 0; $i < count($fields); $i++) {
				if ($i > 0) {
					$query .= ' , ';
				}
				
				$query .= ' ' . $fields[$i] . ' ';
			}
		}
		
		$table_name = mysql_real_escape_string($table_name, $dbh);
		
		$query .= " FROM $table_name ";
		
		$id_field_name = mysql_real_escape_string($id_field_name, $dbh);
		$id = mysql_real_escape_string($id, $dbh);
		
		$query .= " WHERE $id_field_name = $id";
		
		#echo $query; exit;
		
		$result = mysql_query($query, $dbh);
		
		if ($err = mysql_errno($dbh)) {
			throw new Database_MySQLException($dbh);
		}
		
		if ($row = mysql_fetch_assoc($result)) {
			$hash = $row;
		}
		
		return $hash;
	}
	
	public static function
		is_row(
			$id,
			$table_name
		)
	{
		$dbh = DB::m();
		
		$id = mysql_real_escape_string($id, $dbh);
		$table_name = mysql_real_escape_string($table_name, $dbh);
		
		$query = <<<SQL
SELECT
	*
FROM
	$table_name
WHERE
	id = $id
SQL;

		$result = mysql_query($query, $dbh);
		
		return mysql_num_rows($result) == 1;
	}
	
	public static function
		delete_row(
			$id,
			$table_name
		)
	{
		$dbh = DB::m();
		
		$id = mysql_real_escape_string($id, $dbh);
		$table_name = mysql_real_escape_string($table_name, $dbh);
		
		$stmt = <<<SQL
DELETE
FROM
	$table_name
WHERE
	id = $id
SQL;

		mysql_query($stmt, $dbh);
		
		if (mysql_error($dbh)) {
			throw new Database_MySQLException($dbh);
		} else {
			return TRUE;
		}
	}
	
	public static function
		empty_table($table_name)
	{
		$dbh = DB::m();
		
		mysql_query("TRUNCATE TABLE $table_name", $dbh);
	}
	
	/**
	 * Empties a space separated list of tables.
	 *
	 * The optional second argument changes the separator.
	 */
	public static function
		empty_tables(
			$table_names_str,
			$separator = ' '
		)
	{
		foreach (
			explode($separator, $table_names_str)
			as
			$table_name
		) {
			self::empty_table($table_name);
		}
	}
}
?>