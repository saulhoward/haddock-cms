<?php
/**
 * Database_DBHandleTests
 *
 * @copyright 2008-05-28, RFI
 */

class
	Database_DBHandleTests
extends
	UnitTests_UnitTests
{
	public static function
		test_dbh_is_pingable()
	{
		$dbh = DB::m();
		
		return mysql_ping($dbh);
	}
}
?>