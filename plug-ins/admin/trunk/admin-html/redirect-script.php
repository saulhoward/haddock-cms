<?php
/**
 * A script that can do something (in an .inc file)
 * and then redirects the browser to the same page as the
 * .inc file.
 * 
 * This is useful if you want to submit something from
 * a form but don't want to resubmit the data if the user
 * hits the refresh button.
 *
 * If an exception is thrown, then the page redirects
 * to the admin error page.
 * 
 * RFI & SANH 2006-11-21
 */

#require_once $_SERVER['DOCUMENT_ROOT'] . '/define-include-paths.inc.php';
#require_once $_SERVER['DOCUMENT_ROOT'] . '/define-debug-constants.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/haddock/public-html/public-html/define-include-paths.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/haddock/public-html/public-html/define-debug-constants.inc.php';

/**
 * Define which module is being asked for.
 */
define('MODULE', isset($_GET['module']) ? $_GET['module'] : 'admin');

/**
 * Define which page we are on.
 */
define('PAGE', isset($_GET['page']) ? $_GET['page'] : 'home');

if (DEBUG) {
    header('Content-Type: text/plain');
    
    echo DEBUG_DELIM_OPEN;
    
    require_once CLWD_CORE_ROOT . '/formatting/classes/Formatting_FileName.inc.php';
    require_once CLWD_CORE_ROOT . '/clwd-projects/classes/CLWDProjects_ExecutionTimer.inc.php';
    
    $file = new Formatting_FileName(__FILE__);
    echo "Entering \n";
    echo $file->get_pretty_name();
    echo "\n";
    
    echo 'print_r($_GET)' . "\n";
    print_r($_GET);
    
    echo 'print_r($_POST)' . "\n";
    print_r($_POST);
    
    $execution_timer = CLWDProjects_ExecutionTimer::get_instance();
    $execution_timer->mark();
    
    echo DEBUG_DELIM_CLOSE;
}

$return_to = '/admin/' . $_GET['module'] . '/' . $_GET['page'] . '.html';

require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_IncFileFinder.inc.php';

$inc_file_finder = Admin_IncFileFinder::get_instance();

try {
    if ($inc_file_finder->is_page($_GET['page'])) {
        require $inc_file_finder->get_filename('redirect-script');
    } else {
        $error_message =
            'No redirect script for ' 
            . $_GET['page']
            . ' in '
            . $_GET['module']
            . '!';
        
        throw new Exception($error_message);
    }
    
} catch (Exception $e) {
    $return_to = '/admin/index.php?module=admin&page=error'
        . '&error_message=' . urlencode($e->getMessage())
        . '&return_to=/admin/' . $_GET['module'] . '/' . $_GET['page'] . '.html';
}

# Set the address to which to redirect the browser.
$host = $_SERVER['HTTP_HOST'];
rtrim($host, '/');

$url = 'http';

if (isset($_SERVER['HTTPS'])) {
    $url .= 's';
}

$url .= '://';

$url .= $host;

$url .= ':';

#$url .= $_SERVER['REMOTE_PORT'];
$url .= $_SERVER['SERVER_PORT'];

$url .= $return_to;

# Redirect the browser to the page.
if (DEBUG) {
    echo "\$url: $url\n";
} else {
    header("Location: $url");
}

if (DEBUG) {
    echo DEBUG_DELIM_OPEN;
    
    $file = new Formatting_FileName(__FILE__);
    echo "Reached the end of:\n";
    echo $file->get_pretty_name();
    echo "\n";
    
    $execution_timer->mark();
    
    echo DEBUG_DELIM_CLOSE;
}
?>
