<?php
/**
 * The content of the page of servers in the server-admin-scripts project.
 *
 * @copyright Clear Line Web Design, 2007-04-25
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';
    
$content_div = new HTMLTags_Div();

$content_div->set_attribute_str('id', 'content');

echo $content_div->get_as_string();
?>