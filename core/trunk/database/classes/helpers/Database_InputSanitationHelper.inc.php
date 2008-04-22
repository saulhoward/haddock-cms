<?php
/**
 * Database_InputSanitationHelper
 *
 * @copyright 2008-04-22, Clear Line Web Design
 */

class
	Database_InputSanitationHelper
{
	public static function
		sanitise($input)
	{
		$dbh = DB::m();
		
		return mysql_real_escape_string($input, $dbh);
	}
}
?>