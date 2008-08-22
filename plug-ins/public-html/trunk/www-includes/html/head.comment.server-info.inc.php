<?php
/**
 * An HTML comment that shows the request uri of this page.
 *
 * @copyright Clear Line Web Design, 2007-03-12
 */

echo '<!-- REQUEST_URI: ' . $_SERVER['REQUEST_URI'] . " -->\n";
echo '<!-- HTTP_REFERER: ' . $_SERVER['HTTP_REFERER'] . " -->\n";

echo "<!--\n";

echo "Page info: \n\n";

echo 'section: ' . $_GET['section'] . "\n";

if (isset($_GET['module'])) {
    echo 'module: ' . $_GET['module'] . "\n";
}

echo 'page: ' . $_GET['page'] . "\n";
echo 'type: ' . $_GET['type'] . "\n";

echo "-->\n";
?>
