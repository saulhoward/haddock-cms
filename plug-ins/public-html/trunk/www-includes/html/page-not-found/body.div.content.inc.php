<?php
/**
 * Content div of the page to explain that the page requested
 * does not exist.
 *
 * @copyright Clear Line Web Design, 2007-08-03
 */

#<div
#    id="content"
#>
#    <p
#       class="error"
#    >
#        Sorry, the page you requested does not exist.
#    </p>
#</div>

/*
 * Create the singleton objects.
 */
$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
$cm = $cmf->get_config_manager('haddock', 'public-html');

/*
 * Create the HTML objects.
 */
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

$error_p = new HTMLTags_P();
$error_p->set_attribute_str('class', 'error');

$error_p->append_str_to_content($cm->get_error_message_page_not_found());

$content_div->append_tag_to_content($error_p);

echo $content_div->get_as_string();
?>
