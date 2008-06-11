<?php
/**
 * The main .INC for the count-unprocessed-non-text-files script.
 *
 * @copyright 2008-05-15, Robert Impey
 */

$unprocessed_non_text_files_counts
	= TrackitStockManagement_FeedFilesHelper
		::get_unprocessed_non_text_files_counts();

$keys = array_keys($unprocessed_non_text_files_counts);
sort($keys);

foreach ($keys as $key) {
	echo "$key: " . $unprocessed_non_text_files_counts[$key] . "\n";
}
?>