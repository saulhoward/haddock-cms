<?php
/**
 * Redirect to index.php
 *
 * @copyright Clear Line Web Design, 2007-04-06
 */

/*
 * Set the address to which to redirect the browser.
 */
    $host = $_SERVER['HTTP_HOST'];
    rtrim($host, '/');
    
    $url = 'http';
    
    if (isset($_SERVER['HTTPS'])) {
        $url .= 's';
    }
    
    $url .= "://$host";
    
/*
 * Only set the port if it's not the default port for the protocol.
 *
 * e.g. for sites using port based SSL.
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

$url .= '/?type=txt';

foreach (array_keys($_GET) as $get_var_key) {
    $url .= "&$get_var_key=";
    
    $url .= urlencode(urldecode($_GET[$get_var_key]));
}

/*
 * Redirect the browser to the page.
 */

#echo "\$url: $url\n";

header("Location: $url");
?>
