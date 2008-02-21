<?php
/**
 * The default pre-main section for redirect-scripts.
 *
 * @copyright Clear Line Web Design, 2007-07-17
 */

//echo '__FILE__: ' . __FILE__ . "\n";
//exit;

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();

/*
 * This is the old fashioned way of doing this.
 */
if (isset($_GET['return_to'])) {
    $return_to = new HTMLTags_URL();
    
    $return_to->parse_url($_GET['return_to']);
    
    $page_manager->set_return_to_url($return_to);
} else {
    #$return_to_url = $page_manager->get_return_to_url();
    $rm = new PublicHTML_RedirectionManager();
    
    $return_to_url = $rm->get_current_url();
    
    $return_to_url->set_get_variable('type', 'html');
    
    $page_manager->set_return_to_url($return_to_url);
}

/*
 * See check-get-vars.inc.php for the newer way.
 */

?>
