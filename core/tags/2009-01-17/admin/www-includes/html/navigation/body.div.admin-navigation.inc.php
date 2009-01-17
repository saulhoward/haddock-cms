<?php
/**
 * the navigation div on the navigation page.
 *
 * @copyright Clear Line Web Design, 2007-08-19
 */
$navigation_div = new HTMLTags_Div();
$navigation_div->set_attribute_str('id', 'navigation');

ob_start();
require PROJECT_ROOT
	. '/haddock/admin/www-includes/html/'
	. 'body.div.nav-or-error-msg.inc.php';
$str = ob_get_clean();
$navigation_div->append_str_to_content($str);

echo $navigation_div->get_as_string();
?>
