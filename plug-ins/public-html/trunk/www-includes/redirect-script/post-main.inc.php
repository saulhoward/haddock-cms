<?php
/**
 * The default post-main section for redirect-scripts.
 *
 * Sends the browser back to wherever it should go.
 *
 * @copyright Clear Line Web Design, 2007-07-17
 */

/*
 * Create the singlton objects.
 */
$page_manager = PublicHTML_PageManager::get_instance();

/*
 * Get the return to URL.
 */
$return_to_url = $page_manager->get_return_to_url();

/*
 * Redirect the browser to the page.
 */
header('Location: ' . $return_to_url->get_as_string());
exit;
?>
