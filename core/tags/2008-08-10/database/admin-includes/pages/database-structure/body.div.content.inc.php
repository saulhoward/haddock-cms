<?php
/**
 * The Database Structure Page.
 *
 * @copyright Clear Line Web Design, 2007-01-36
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Find the 
 */

echo $content_div;
?>
