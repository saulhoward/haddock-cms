<?php
/**
 * Template for the Admin Section of a Database Site
 *
 * RFI 2006-09-21
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/define-globals.inc.php';

echo chr(60);
echo chr(63);
echo 'xml version="1.0" encoding="UTF-8"';
echo chr(63);
echo chr(62);
echo "\n";
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <!-- Webpage design by Clear Line Web Design, clearlinewebdesign@gmail.com -->
    <head>
        <title>Database Admin</title>
        <link rel="stylesheet" href="/database/styles.css" type="text/css" />
    </head>
    <body>
        <div id="header" class="top-level-panel">
            <?php include CLWD_CORE_ROOT . '/database/public-html/includes/header.inc.php'; ?>
        </div>
        
        <table id="middle-panels">
            <tr>
                <td id="navigation" class="top-level-panel">
                    <?php include CLWD_CORE_ROOT . '/database/public-html/includes/navigation.inc.php'; ?>
                </td>
                <td id="main" class="top-level-panel">
<?php
include CLWD_CORE_ROOT . '/database/public-html/includes/'
    . (isset($_GET['page']) ? $_GET['page'] : 'home')
    . '.inc.php';
?>
                </td>
            </tr>
        </table>
    </body>
</html>
