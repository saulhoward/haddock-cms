<?php
/**
 * Exception handling for the admin includer page.
 *
 * @copyright Clear Line Web Design, 2007-09-14
 */

/*
 * Set local debug variables.
 */
$debug = FALSE;
#$debug = TRUE;

$page_manager = PublicHTML_PageManager::get_instance();
$gvm = Caching_GlobalVarManager::get_instance();

$e = $gvm->get('exception');

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
       !(
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

$url .= '/?section=haddock&module=public-html&page=error&type=html';

$_SESSION['exception'] = $e;

$url .= '&error_message='
    . urlencode($e->getMessage());

#$return_to_url = $page_manager->get_return_to_url();

#$return_to_url = $gvm->get('current_page_admin_url');

#$url .= '&return_to=' . urlencode($return_to_url->get_as_string());

/*
 * Redirect the browser to the page.
 */

if ($debug) {
   echo "\$url: $url\n";
} else {
   header("Location: $url");
   exit;
}
?>
