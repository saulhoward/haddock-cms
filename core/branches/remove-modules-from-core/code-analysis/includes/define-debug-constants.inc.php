<?php
/*
 * Defines the debug constants for the project.
 *
 * @copyright 2009-01-02, Robert Impey
 */

/*
 * To print lots of debug info (perhaps too much!)
 * create a file called
 *
 * 	PROJECT_ROOT . '/DEBUG.inc.php'
 *
 * 	and add the following content:
 *
 * 	<?php define('DEBUG', TRUE); ?>
 *
 * 	If you are using a version control system, it's probably
 * 	a good idea to get the system to ignore the debug toggle file.
 */

$instance_specific_debug_toggle_file_name = PROJECT_ROOT . '/DEBUG.inc.php';

if (file_exists($instance_specific_debug_toggle_file_name)) {
	require_once $instance_specific_debug_toggle_file_name;
}

if (!defined('DEBUG')) {
	define('DEBUG', FALSE);
}

define(
	'DEBUG_DELIM_OPEN',
	PHP_EOL . 'DEBUG >>>>>>>>>>>>>>>>' . PHP_EOL . PHP_EOL
);

define(
	'DEBUG_DELIM_CLOSE',
	PHP_EOL . 'DEBUG <<<<<<<<<<<<<<<<' . PHP_EOL . PHP_EOL
);

?>
