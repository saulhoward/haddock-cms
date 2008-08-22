<?php
/**
 * The HTML body.
 *
 * @copyright Clear Line Web Design, 2006-11-17
 */

$page_manager = PublicHTML_PageManager::get_instance();

echo '<body';
echo ">\n";

require $page_manager->get_filename('body.div.header');
    
#echo "\$http_error: $http_error\n";
//echo "<div id =\"gradient\">\n";
//echo "<span id=\"gradient-left\"></span>";
//echo "<span id=\"gradient-right\"></span>";
//if ($http_error > 0) {
//    $error_file = PROJECT_ROOT
//        . "/haddock/public-html/public-includes/http-errors/$http_error.inc.php";
//    if (file_exists($error_file)) {
//        require $error_file;
//    } else {
//        require $page_manager->get_filename('body.div.error');
//    }
//} else {
    require $page_manager->get_filename('body.div.content');
//}

require $page_manager->get_filename('body.div.navigation');

#echo "</div>\n";
require $page_manager->get_filename('body.div.footer');

echo "</body>\n";
  
?>
