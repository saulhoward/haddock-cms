<?php
/**
 * Template for an error panel in the admin section
 * of a database site.
 *
 * RFI & SANH 2006-09-21
 */
?>
<div class="error">

    <h2>Error!</h2>

    <p>Oops! We were unable to do the requested action.</p>

<?php

if (isset($_GET['error_message'])) {
    echo '<p>Error Message: ' . $_GET['error_message'] . "</p>\n";
}

if (isset($_GET['return_to'])) {
    $return_to = $_GET['return_to'];
} else {
    $return_to = '/admin/';
}

echo "<p>Return to <a href=\"$return_to\">$return_to</a></p>\n";

?>
</div>
