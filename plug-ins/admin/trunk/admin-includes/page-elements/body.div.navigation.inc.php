<?php
/**
 * The Navigation panel of a page in the admin section.
 *
 * @copy Clear Line Web Design, 2006-09-26
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_UL.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Heading.inc.php';

$navigation_div = new HTMLTags_Div();

$navigation_div->set_attribute_str('id', 'navigation');

if ($current_module_directory->has_admin_section()) {
    /*
     * The Heading.
     */
    $navigation_heading
        = new HTMLTags_Heading(
            3,
            $current_module_directory->get_admin_section_title()
        );
    
    $navigation_div->append_tag_to_content($navigation_heading);
    
    /*
     * The Navigation Links.
     */
    $admin_includes_directory
        = $current_module_directory->get_admin_includes_directory();
    
    if ($admin_includes_directory->has_navigation_links_file()) {
        $navigation_links_file
            = $admin_includes_directory->get_navigation_links_file();
        
        $navigation_links
            = $navigation_links_file->get_navigation_links();
        
        $admin_pages_ul = new HTMLTags_UL();
        
        foreach ($navigation_links as $navigation_link) {
            $admin_page_li = new HTMLTags_LI();
            
            $admin_page_a = new HTMLTags_A($navigation_link->get_title());
            
            $admin_page_href = $navigation_link->get_html_tags_href();
            $admin_page_a->set_href($admin_page_href);
            
            $admin_page_li->append_tag_to_content($admin_page_a);
            
            $admin_pages_ul->add_li($admin_page_li);
        }
        
        $navigation_div->append_tag_to_content($admin_pages_ul);
    }
}

echo $navigation_div;
?>
