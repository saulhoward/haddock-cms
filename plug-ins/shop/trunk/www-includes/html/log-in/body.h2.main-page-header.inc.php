<?php
/**
 * The header of the log in page.
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */

$main_page_header_id = 'login';
$main_page_header_title = 'Customer Login';
$main_page_header_class = 'login';

$main_page_header_h = new HTMLTags_Heading(2);
$main_page_header_h->set_attribute_str('class', $main_page_header_class);
$main_page_header_h->set_attribute_str('id', $main_page_header_id);

$main_page_header_h->append_tag_to_content(new HTMLTags_Span($main_page_header_title));

echo $main_page_header_h->get_as_string();
?>
