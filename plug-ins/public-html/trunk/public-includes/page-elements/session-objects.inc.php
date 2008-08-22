<?php
/**
 * Classes have to be defined before the session
 * starts if objects of the class are to be saved
 * in a session variable.
 *
 * So that we can be sure that the classes have been
 * define before the session starts, this file
 * includes the definitions of all the classes
 * whose objects are saved in the $_SESSION array.
 *
 * @copyright Clear Line Web Design, 2007-02-17
 */

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

require_once PROJECT_ROOT
    . '/haddock/database/classes/'
    . 'Database_MySQLUserFactory.inc.php';

?>
