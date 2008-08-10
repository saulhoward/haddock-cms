<?php
/**
 * Title div for the header of an admin-includer page.
 *
 * @copyright Clear Line Web Design, 2007-08-23
 */

$gvm = Caching_GlobalVarManager::get_instance();

echo "<h1>\n";
//
//echo "Admin\n";
//
//echo "&nbsp;&gt;&nbsp;\n";

#echo $current_module_directory->get_admin_section_title();

#echo "\n";

#print_r($current_admin_page_directory);

//if (isset($current_admin_page_directory)) {
//    echo "&nbsp;&gt;&nbsp;\n";
//    
//    echo $current_admin_page_directory->get_title();
//    
//    echo "\n";
//}

$page_directory = $gvm->get('current-admin-page-directory');

echo $page_directory->get_title();

echo "</h1>\n";
?>