<?php
/**
 * Any messages that you want to appear above the products on the product
 * listing page.
 *
 * @copyright Clear Line Web Design, 2007-07-26
 */

/*
 * Create the singleton objects.
 */
$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();

#$cm = $cmf->get_config_manager('plug-ins', 'shop');

$div_welcome_blurb = new HTMLTags_Div();
$div_welcome_blurb->set_attribute_str('class', 'blurb');

#$wecome_txt = <<<TXT
#All of the best Brighton Wok designs from our talented artists. Enjoy!
#TXT;

#$welcome_blurb = $cm->get_products_welcome_blurb();
#
#$div_welcome_blurb->append_tag_to_content(new HTMLTags_P($welcome_blurb));

echo $div_welcome_blurb->get_as_string();

?>
