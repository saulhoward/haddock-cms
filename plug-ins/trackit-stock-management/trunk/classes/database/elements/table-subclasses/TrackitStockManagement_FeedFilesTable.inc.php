<?php
/**
 * TrackitStockManagement_FeedFilesTable
 *
 * @copyright 2007-11-21, RFI
 */

class
	TrackitStockManagement_FeedFilesTable
extends
	Database_Table
{
	public function
		get_file_names()
	{
		$dbh = $this->get_database_handle();

		$query = <<<SQL
SELECT
	name
FROM
	hpi_trackit_stock_management_feed_files
ORDER BY
	name ASC
SQL;

		$result = mysql_query($query, $dbh);

		$names = array();

		while ($row = mysql_fetch_array($result)) {
			$names[] = $row['name'];
		}

		return $names;
	}

	public function
		add_new_feed_file(
			$new_file_name
		)
	{
		/*
		 * Parse the file name for the file type.
		 */
		if (preg_match('/\.(\w+)$/', $new_file_name, $matches)) {
			$file_type = $matches[1];
			$file_type = strtoupper($file_type);
			
			/*
			 * Record the new file name in the database.
			 */
			$values = array();

			$values['detected'] = 'NOW()';
			$values['name'] = $new_file_name;
			if ($file_type == 'TXT') {
				$values['file_type'] = 'TXT';
				
				/*
				 * Extract the creation date from the file name.
				 */
				if (preg_match('/^[^_]+_(\d{14})/', $new_file_name, $matches)) {
					$created = $matches[1];
	
					/*
					 * Extract the time stamp from the file name.
					 */
					$Y = substr($created, 0, 4);
					$m = substr($created, 4, 2);
					$d = substr($created, 6, 2);
					$H = substr($created, 8, 2);
					$M = substr($created, 10, 2);
					$S = substr($created, 12, 2);
	
					$created = "$Y-$m-$d $H:$M:$S";
	
					#echo "\$created: $created\n";
					
					$values['created'] = $created;
				}
			} else {
				$values['file_type'] = 'OTHER';
			}
			
			return $this->add($values);
		} else {
			throw
				new Exception(
					"Unable to extract the file type from $new_file_name!"
				);
		}
	}

	public function
		get_non_text_files_to_download()
	{
		$query = <<<SQL
SELECT
	*
FROM
	hpi_trackit_stock_management_feed_files
WHERE
	file_type = 'OTHER'
	AND
	downloaded IS NULL
ORDER BY
	detected ASC
SQL;

		return $this->get_rows_for_select($query);
	}

	public function
		get_text_files_to_download()
	{
		$query = <<<SQL
SELECT
	*
FROM
	hpi_trackit_stock_management_feed_files
WHERE
	file_type = 'TXT'
	AND
	downloaded IS NULL
ORDER BY
	detected ASC
SQL;

		return $this->get_rows_for_select($query);
	}

	public function
		get_product_text_files_to_parse()
	{
		$query = <<<SQL
SELECT
	*
FROM
	hpi_trackit_stock_management_feed_files
WHERE
	file_type = 'TXT'
	AND
	downloaded IS NOT NULL
	AND
	processed IS NULL
	AND
	name LIKE 'prd_%'
ORDER BY
	created ASC
SQL;

		return $this->get_rows_for_select($query);
	}

	public function
		record_download(
				$file_name,
				$md5
			)
	{
		$dbh = $this->get_database_handle();

		$query = <<<SQL
UPDATE
	hpi_trackit_stock_management_feed_files
SET
	downloaded = NOW(),
	md5 = '$md5'
WHERE
	name = '$file_name'
SQL;

		#echo "\$query: $query\n";

		mysql_query($query, $dbh);
	}

	public function
		record_process(
			$file_name
		)
	{
		$dbh = $this->get_database_handle();

		$query = <<<SQL
UPDATE
	hpi_trackit_stock_management_feed_files
SET
	processed = NOW()
WHERE
	name = '$file_name'
SQL;

		#echo "\$query: $query\n";

		mysql_query($query, $dbh);
	}

	public function
		get_photographs_to_process()
	{
		$query = <<<SQL
SELECT
	*
FROM
	hpi_trackit_stock_management_feed_files
WHERE
	file_type = 'OTHER'
	AND
	downloaded IS NOT NULL
	AND
	processed IS NULL
ORDER BY
	detected ASC
SQL;

		return $this->get_rows_for_select($query);
	}
	
	public function
		get_stock_text_files_to_process()
	{
		$query = <<<SQL
SELECT
	*
FROM
	hpi_trackit_stock_management_feed_files
WHERE
	file_type = 'TXT'
	AND
	downloaded IS NOT NULL
	AND
	processed IS NULL
	AND
	name LIKE 'stk_%'
ORDER BY
	created ASC
SQL;

		return $this->get_rows_for_select($query);
	}
}
?>