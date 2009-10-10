<?php
/**
 * Database_FetchingHelper
 *
 * @copyright 2008-03-21, RFI
 */

class
	Database_FetchingHelper
{
	public static function
		get_rows_for_query(
			Database_SQLSelectQuery $query
		)
	{
		$rows = array();
		
		$dbh = DB::m();
		
		$str_query = $query->get_as_string();
		
		#echo "\$str_query: $str_query\n";
		#exit;
		
		$result = mysql_query($str_query, $dbh);
		
		while ($row = mysql_fetch_assoc($result)) {
			$rows[] = $row;
		}
		
		#print_r($rows);
		
		return $rows;
	}
	
	public static function
		get_all_rows_in_table(
			$table_name,
			$order_by = NULL,
			$sort_direction = NULL,
			$offset = NULL,
			$limit = NULL
		)
	{
		$query = new Database_SQLSelectQuery();
		
		$query->set_from_clause_table_name($table_name);
		
		if (
			isset($order_by)
			&&
			isset($sort_direction)
		) {
			$query
				->add_order_by_clause_field(
					$order_by,
					$sort_direction
				);
		}
		
		if (
			isset($offset)
			&&
			isset($limit)
		) {
			$query
				->set_offset_and_limit(
					$offset,
					$limit
				);
		}
		
		return self::get_rows_for_query($query);
	}
}
?>