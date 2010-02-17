<?php
/**
 * A script that can do something (in an inc file)
 * and then redirects the browser to the same page as the
 * inc file.
 * 
 * This is useful if you want to submit something from
 * a form but don't want to resubmit the data if the user
 * hits the refresh button.
 *
 * If an exception is thrown, then the page redirects
 * to the error page.
 * 
 * @copyright Clear Line Web Design, 2006-11-21
 */

#print_r($_GET);

require_once $_SERVER['DOCUMENT_ROOT'] . '/haddock/public-html/public-html/define-include-paths.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/haddock/public-html/public-html/define-debug-constants.inc.php';

/*
 * Define which page the user is asking for.
 */
define('PAGE', isset($_GET['page']) ? $_GET['page'] : 'home');

define('MODULE', isset($_GET['module']) ? $_GET['module'] : 'project-specific');

if (isset($_GET['return_to'])) {
    $return_to = $_GET['return_to'];
} else {
    $return_to = '/' . $_GET['page'] . '.html';
}

try {
    # TO DO:
    #
    # Is the module in the core or project specific?
    # If neither, throw an exception to redirect
    # to the error page.
    
    /*
     * Not much security (the agent can fake the referer easily)
     * but worth doing to avoid stupid mistakes.
     */
    #echo 'print_r($_SERVER)';
    #print_r($_SERVER);
    # IE 7 doesn't seem to set the HTTP_REFERER field!
    #if (preg_match('{https?://([^:/]+)}', $_SERVER['HTTP_REFERER'], $matches)) {
    #    $referer_domain = $matches[1];
    #    
    #    #echo "\$referer_domain: $referer_domain\n";
    #    #echo '$_SERVER[\'HTTP_HOST\']: ' .  $_SERVER['HTTP_HOST'] . "\n";
    #    
    #    if ($referer_domain != $_SERVER['HTTP_HOST']) {
    #        throw new Exception('The HTTP_REFERER must be the same as HTTP_HOST to use the redirect script!');
    #    }
    #} else {
    #    throw new Exception('Unable to extract the domain from the HTTP_REFERER to protect redirect script.');
    #}
    
    $inc_file = '';
    
    if (MODULE == 'project-specific') {
        $inc_file = PROJECT_ROOT
            . '/project-specific/public-includes/pages/'
            . PAGE
            . '/redirect-script.inc.php';
    } else {
        if (is_dir(PROJECT_ROOT . '/plug-ins/' . MODULE)) {
            $inc_file =
                PROJECT_ROOT
                . '/plug-ins/'
                . MODULE
                . '/public-includes/pages/'
                . PAGE
                . '/redirect-script.inc.php';
        } elseif (is_dir(PROJECT_ROOT . '/haddock/' . MODULE)) {
            $inc_file =
                PROJECT_ROOT
                . '/plug-ins/'
                . MODULE
                . '/public-includes/pages/'
                . $_GET['page'];
        }
    }
    
    #echo "\$inc_file: $inc_file\n";
    
    if (file_exists($inc_file)) {
        require $inc_file;
    } else {
        $error_message =
            'No redirect script for ' 
            . $_GET['page']
            . '!';
        
        throw new Exception($error_message);
    }
    
} catch (Exception $e) {
    $return_to = '/haddock/public-html/public-html/index.php?page=error'
        . '&error_message=' . urlencode($e->getMessage())
        . '&return_to=/' . $_GET['page'] . '.html';
}

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

$url .= $return_to;

# Redirect the browser to the page.
#echo "\$url: $url\n";

header("Location: $url");
?>
