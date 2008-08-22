<?php
/**
 * The default pre-main section for redirect-scripts.
 *
 * @copyright Clear Line Web Design, 2007-07-17
 */

#echo '__FILE__: ' . __FILE__ . "\n";

$page_manager = PublicHTML_PageManager::get_instance();

if (isset($_GET['return_to'])) {
    $return_to = new HTMLTags_URL();
    
    $return_to->parse_url($_GET['return_to']);
    
    $page_manager->set_return_to_url($return_to);
} else {
    $return_to_url = $page_manager->get_return_to_url();
    
    $return_to_url->set_get_variable('type', 'html');
    
    $page_manager->set_return_to_url($return_to_url);
}

?>
