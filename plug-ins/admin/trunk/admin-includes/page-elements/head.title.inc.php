<?php

echo "<title>\n";

#if (isset($current_admin_includes_directory)) {
#    if ($current_admin_includes_directory->has_module_title_file()) {
#        $module_title_file = $current_admin_includes_directory->get_module_title_file();
#        echo $module_title_file->get_module_title() . ' ';
#    }
#}

echo $current_module_directory->get_admin_section_title();

echo "\n";

if (isset($current_admin_page_directory)) {
    echo "&nbsp;&gt;&nbsp;\n";
    
    echo $current_admin_page_directory->get_title();
    
    echo "\n";
}

echo "</title>\n";
?>
