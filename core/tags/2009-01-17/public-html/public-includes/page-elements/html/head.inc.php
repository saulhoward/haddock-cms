<?php
/**
 * The HTML head.
 *
 * @copyright Clear Line Web Design, 2006-11-17
 */

#echo '$_SERVER[\'SCRIPT_NAME\']: ' . $_SERVER['SCRIPT_NAME'] . "\n";
#echo '__FILE__: ' . __FILE__ . "\n";

echo "<head>\n";

$page_manager = PublicHTML_PageManager::get_instance();

require $page_manager->get_filename('head.title');
require $page_manager->get_filename('head.meta.author');
require $page_manager->get_filename('head.meta.keywords');
require $page_manager->get_filename('head.meta.description');

$head_link_styles_inc_filename = $page_manager->get_filename('head.link.styles');
#echo "\$head_link_styles_inc_filename: $head_link_styles_inc_filename\n";
require $head_link_styles_inc_filename;

require $page_manager->get_filename('head.link.favicon');
require $page_manager->get_filename('head.script');
require $page_manager->get_filename('head.comment.written-by');
require $page_manager->get_filename('head.comment.server-info');

echo "</head>\n";

?>
