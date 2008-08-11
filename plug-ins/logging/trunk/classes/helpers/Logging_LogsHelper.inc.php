<?php
/**
 * Logging_LogsHelper
 *
 * @copyright 2008-04-24, RFI
 */

class
	Logging_LogsHelper
{
	public static function
		reset_logs()
	{
		Database_TableHelper
			::empty_tables(
				'hc_logging_ignored_hosts hc_logging_referer_domains hc_logging_server_logs'
			);
	}
}
?>