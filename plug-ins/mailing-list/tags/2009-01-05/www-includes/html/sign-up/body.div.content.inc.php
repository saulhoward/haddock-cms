<?php
/**
 * Content of the mailing list adding page.
 *
 * @copyright Clear Line Web Design, 2007-07-13
 */

/*
 * Create the singleton variables.
 */
$page_manager = PublicHTML_PageManager::get_instance();

/*
 * Create the HTML tags objects.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

$content_div->append_str_to_content(
	$page_manager->get_inc_file_as_string('body.div.email-adding')
);

echo $content_div->get_as_string();
?>
