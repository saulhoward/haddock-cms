<?php
/**
 * The default post-main section for redirect-scripts.
 *
 * Sends the browser back to wherever it should go.
 *
 * @copyright Clear Line Web Design, 2007-07-17
 */

$page_manager = PublicHTML_PageManager::get_instance();

# Set the address to which to redirect the browser.
$host = $_SERVER['HTTP_HOST'];
rtrim($host, '/');

$url = 'http';

if (isset($_SERVER['HTTPS'])) {
    $url .= 's';
}

$url .= "://$host";

/*
 * Only set the port if it's not the default port for the protocol.
 */
if (
    (
        (
            !isset($_SERVER['HTTPS'])
            &&
            ($_SERVER['SERVER_PORT'] != 80)
        )
        ||
        (
            isset($_SERVER['HTTPS'])
            &&
            ($_SERVER['SERVER_PORT'] != 443)
        )
    )
) {
    $url .= ':' . $_SERVER['SERVER_PORT'];
}

#echo '$_SERVER[\'SERVER_PORT\']: ' . $_SERVER['SERVER_PORT'] . "\n";

#$url .= $return_to;
$return_to_url = $page_manager->get_return_to_url();
#$url .= urlencode($return_to_url->get_as_string());
$url .= $return_to_url->get_as_string();

# Redirect the browser to the page.
#echo "\$url: $url\n";

header("Location: $url");
?>
