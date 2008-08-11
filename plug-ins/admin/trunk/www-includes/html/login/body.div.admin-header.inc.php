<?php
/**
 * Header div of the login page for the admin section.
 *
 * @copyright Clear Line Web Design, 2007-08-22
 */

$header_div = new HTMLTags_Div();
$header_div->set_attribute_str('id', 'header');

$header_div->append_tag_to_content(new HTMLTags_Heading(1, 'Admin Section Login'));

echo $header_div->get_as_string();
?>
