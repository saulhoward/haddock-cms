<?php
/**
 * Code to do with sessions for the admin section.
 *
 * @copyright Clear Line Web Design, 2007-02-20
 */

if (strlen(session_id()) > 0) {
    session_destroy();
}

if (DEBUG) {    
    echo DEBUG_DELIM_OPEN;
    
    echo 'print_r($_SESSION)' . "\n";
    print_r($_SESSION);
    echo "\n";

    echo DEBUG_DELIM_CLOSE;
}
?>