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
}
?>