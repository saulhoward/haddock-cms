<?php
/**
 * Content Div of the Navigation page for the admin back-end.
 *
 * @copyright Clear Line Web Design, 2007-08-19
 */

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

//ob_start();
//require PROJECT_ROOT
//        . '/haddock/admin/www-includes/html/'
//        . 'body.div.nav-or-error-msg.inc.php';
//$str = ob_get_clean();
//$content_div->append_str_to_content($str);

echo $content_div->get_as_string();
?>
