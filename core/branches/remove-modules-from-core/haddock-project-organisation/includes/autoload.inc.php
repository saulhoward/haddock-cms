<?php
/**
 * Included in both the CLI runner and the server index file.
 *
 * @copyright 2008-03-20, RFI
 */

if (DEBUG) {
	echo DEBUG_DELIM_OPEN;
	
	echo 'File: ' . __FILE__ . PHP_EOL;
	
	echo DEBUG_DELIM_CLOSE;
}

$autoload_filename = PROJECT_ROOT
	. '/project-specific/haddock-project-organisation/'
	. 'autoload.inc.php';
	
if (file_exists($autoload_filename)) {
	require $autoload_filename;
} else {
	/*
	 * Use the slow, default autoload function
	 */
	require PROJECT_ROOT
		. '/haddock/haddock-project-organisation/includes/'
		. 'autoload-search-function.inc.php';
}
?>
