<?php
/**
 * A header to go over the list of all the products.
 * 
 * @copyright Clear Line Web Design, 2007-07-26
 */

$div_content_header = new HTMLTags_Div();

$div_content_header->set_attribute_str('id', 'content_header');

$h = new HTMLTags_Heading(2, 'Products');
$div_content_header->append_tag_to_content($h);

echo $div_content_header->get_as_string();
?>
