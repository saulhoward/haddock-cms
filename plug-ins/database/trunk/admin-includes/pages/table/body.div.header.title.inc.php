<?php
/**
 * The Title that goes at the top of the page for a table in database admin.
 *
 * RFI & SANH 2007-01-05
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Heading.inc.php';

$header_title = new HTMLTags_Heading(1, 'Database Admin &gt; table');

if (isset($table)) {
    $header_title->append_str_to_content(' &gt; ' . $table->get_name());
}

echo $header_title->get_as_string();
?>