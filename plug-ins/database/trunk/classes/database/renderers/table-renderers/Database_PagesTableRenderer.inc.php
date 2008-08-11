<?php
/**
 * Database_PagesTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-08-29
 */

class
	Database_PagesTableRenderer
extends
    Database_TableRenderer
{
    public function
        get_admin_pages_html_table()
    {
        $pages_table = $this->get_element();
        
        $admin_pages_html_table = new HTMLTags_Table();
        $admin_pages_html_table->set_attribute_str('id', 'admin_pages_table');
        
        /*
         * The head
         */
        $thead = new HTMLTags_THead();
        
        $header_tr = new HTMLTags_TR();
        
        $header_tr->append_tag_to_content(new HTMLTags_TH('Name'));
        $header_tr->append_tag_to_content(new HTMLTags_TH('Author'));
        $header_tr->append_tag_to_content(new HTMLTags_TH('Title'));
        
        $actions_th = new HTMLTags_TH('Actions');
        
        $actions_th->set_attribute_str('colspan', 2);
        
        $header_tr->append_tag_to_content($actions_th);
        
        $thead->append_tag_to_content($header_tr);
        
        $admin_pages_html_table->append_tag_to_content($thead);
        
        /*
         * The body.
         */
        $tbody = new HTMLTags_TBody();
        
        $pages = $pages_table->get_pages_viewable_by_currently_logged_in_user();
        
        foreach ($pages as $page) {
            $page_renderer = $page->get_renderer();
            
            $tbody->append_tag_to_content($page_renderer->get_admin_page_html_table_tr());
        }
        
        $admin_pages_html_table->append_tag_to_content($tbody);
        
        return $admin_pages_html_table;
    }
}
?>
