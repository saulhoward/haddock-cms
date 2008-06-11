<?php
/**
 * Any messages that you want to appear above the products on the product
 * listing page.
 *
 * @copyright Clear Line Web Design, 2007-07-26
 */

$div_welcome_blurb = new HTMLTags_Div();

$wecome_txt = <<<TXT
Products on sale at this shop.
TXT;

$div_welcome_blurb->append_tag_to_content(new HTMLTags_P($wecome_txt));

echo $div_welcome_blurb->get_as_string();
?>
