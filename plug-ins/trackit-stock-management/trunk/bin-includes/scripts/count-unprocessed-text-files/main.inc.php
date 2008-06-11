<?php
/**
 * The main .INC for the count-unprocessed-text-files script.
 *
 * @copyright 2008-04-25, Robert Impey
 */

$unprocessed_text_files_counts
	= TrackitStockManagement_FeedFilesHelper
		::get_unprocessed_text_files_counts();

#print_r($unprocessed_text_files_counts);

$keys = array_keys($unprocessed_text_files_counts);
sort($keys);

foreach ($keys as $key) {
	echo "$key: " . $unprocessed_text_files_counts[$key] . "\n";
}
?>