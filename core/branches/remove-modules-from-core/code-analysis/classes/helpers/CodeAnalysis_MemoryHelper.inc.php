<?php
/**
 * CodeAnalysis_MemoryHelper
 *
 * @copyright 2008-05-13, RFI
 */

class
	CodeAnalysis_MemoryHelper
{
	public static function
		cli_print_memory_usage(
			$title = NULL
		)
	{
		fprintf(
			STDERR,
			"----------------------------------------\n"
		);
		
		if (isset($title)) {
			fprintf(
				STDERR,
				"$title\n"
			);
		}
		
		self
			::cli_print_memory_usage_datum(
				'Peak memory usage',
				memory_get_peak_usage()
			);
		
		self
			::cli_print_memory_usage_datum(
				'Real peak memory usage',
				memory_get_peak_usage(TRUE)
			);
		
		self
			::cli_print_memory_usage_datum(
				'Memory usage',
				memory_get_usage()
			);
		
		self
			::cli_print_memory_usage_datum(
				'Real memory usage',
				memory_get_usage(TRUE)
			);
		
		fprintf(
			STDERR,
			"----------------------------------------\n"
		);
	}
	
	private static function
		cli_print_memory_usage_datum(
			$title,
			$bytes
		)
	{
		fprintf(
			STDERR,
			"%-25s%d B\t%.2f MB\n",
			$title,
			$bytes,
			$bytes / pow(2, 20)
		);
	}
}
?>