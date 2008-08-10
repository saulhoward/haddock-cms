<?php

echo "<h1>\n";

echo "Admin\n";

echo "&nbsp;&gt;&nbsp;\n";

echo $current_module_directory->get_admin_section_title();

echo "\n";

#print_r($current_admin_page_directory);

if (isset($current_admin_page_directory)) {
    echo "&nbsp;&gt;&nbsp;\n";
    
    echo $current_admin_page_directory->get_title();
    
    echo "\n";
}

echo "</h1>\n";
?>