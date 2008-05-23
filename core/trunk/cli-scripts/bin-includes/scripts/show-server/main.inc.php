<?php
/**
 * The main .INC for the show-server script.
 * @copyright Clear Line Web Design, 2007-07-31
 */

/*
 * DEPRECATED!
 *
 * Use CLIScripts_ShowServerCLIScript instead.
 */

print_r($_SERVER);

/*
 * Require a user response before exiting.
 */
echo "Press \"ENTER\" to exit.\n";
$reply = trim(fgets(STDIN));
?>
