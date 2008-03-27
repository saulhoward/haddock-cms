<?php
/**
 * Defines constants that are used when we debugging.
 *
 * @copyright 2006-11-17, RFI
 */

#define('DEBUG', TRUE);

if (!defined('DEBUG')) {
	define('DEBUG', FALSE);
}

define('DEBUG_DELIM_OPEN', "\nDEBUG >>>>>>>>>>>>>>>>\n\n");
define('DEBUG_DELIM_CLOSE', "\nDEBUG <<<<<<<<<<<<<<<<\n\n");

?>