<?php
/**
 * Additional server info to be printed in a comment on
 * a admin-includer page.
 *
 * @copyright Clear Line Web Design, 2007-09-25
 */

require PROJECT_ROOT
    . '/plug-ins/public-html/www-includes/html/'
    . 'head.comment.server-info.inc.php';

echo "<!--\n";

echo "Additional infomation for an admin-includer page: \n\n";

echo 'admin-section: ' . $_GET['admin-section'] . "\n";

if (isset($_GET['admin-module'])) {
    echo 'admin-module: ' . $_GET['admin-module'] . "\n";
}

echo 'admin-page: ' . $_GET['admin-page'] . "\n";

echo "-->\n";
?>
