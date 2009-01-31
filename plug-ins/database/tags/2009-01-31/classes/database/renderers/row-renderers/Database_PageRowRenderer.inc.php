<?php
/**
 * Database_PageRowRenderer
 *
 * @copyright Clear Line Web Design, 2007-08-29
 */

class
	Database_PageRowRenderer
extends
    Database_RowRenderer
{
    public function
        get_title_tag()
    {
        $page = $this->get_element();
        
        $title_tag = new HTMLTags_Title($page->get_title());
        
        return $title_tag;
    }
    
    public function
        get_author_meta_tag()
    {
        $page = $this->get_element();
        
        //$author_meta_tag = new HTMLTags_Meta();
        //
        //$author_meta_tag->set_attribute_str('name', 'author');
        //
        //$author_meta_tag->set_attribute_str('content', $page->get_author());
        
        $author_meta_tag = new HTMLTags_MetaWithNameAndContent('author', $page->get_author());
        
        return $author_meta_tag;
    }
    
    public function
        get_keywords_meta_tag()
    {
        $page = $this->get_element();
        
        $keywords_meta_tag = new HTMLTags_MetaWithNameAndContent('keywords', $page->get_keywords());
        
        return $keywords_meta_tag;
    }
    
    public function
        get_description_meta_tag()
    {
        $page = $this->get_element();
        
        $description_meta_tag = new HTMLTags_MetaWithNameAndContent('description', $page->get_description());
        
        return $description_meta_tag;
    }
    
    public function
        get_admin_page_html_table_tr()
    {
        $page_row = $this->get_element();
        
        $admin_pages_html_table_tr = new HTMLTags_TR();
        
        $name_td = new HTMLTags_TD();
        $name_td->append_str_to_content($page_row->get_name());
        $admin_pages_html_table_tr->append_tag_to_content($name_td);
        
        $author_td = new HTMLTags_TD();
        $author_td->append_str_to_content($page_row->get_author());
        $admin_pages_html_table_tr->append_tag_to_content($author_td);
        
        $title_td = new HTMLTags_TD();
        #$title_td->append_str_to_content($page_row->get_title());
        
        $title_td->append_tag_to_content($this->get_title_a());
        
        $admin_pages_html_table_tr->append_tag_to_content($title_td);
        
        /*
         * The actions
         */
        $confirmation_url_base = new HTMLTags_URL();
        
        $confirmation_url_base->set_file('/');
        
        $confirmation_url_base->set_get_variable('section', 'haddock');
        $confirmation_url_base->set_get_variable('module', 'admin');
        $confirmation_url_base->set_get_variable('page', 'admin-includer');
        $confirmation_url_base->set_get_variable('type', 'html');
        $confirmation_url_base->set_get_variable('admin-section', 'haddock');
        $confirmation_url_base->set_get_variable('admin-module', 'database');
        
        /*
         * Edit the page's details.
         */
        $edit_td = new HTMLTags_TD();
        
        $edit_url = clone $confirmation_url_base;
        $edit_url->set_get_variable('admin-page', 'edit-page');
        $edit_url->set_get_variable('page_id', $page_row->get_id());
        
        $edit_a = new HTMLTags_A('Edit');
        $edit_a->set_href($edit_url);
        
        $edit_td->append_tag_to_content($edit_a);
        
        $admin_pages_html_table_tr->append_tag_to_content($edit_td);
        
        /*
         * Delete the page.
         */
        $delete_td = new HTMLTags_TD();
        
        $delete_url = clone $confirmation_url_base;
        $delete_url->set_get_variable('admin-page', 'delete-page');
        $delete_url->set_get_variable('page_id', $page_row->get_id());
        
        $delete_a = new HTMLTags_A('Delete');
        $delete_a->set_href($delete_url);
        
        $delete_td->append_tag_to_content($delete_a);
        
        $admin_pages_html_table_tr->append_tag_to_content($delete_td);
        
        return $admin_pages_html_table_tr;
    }
    
    public function
        get_title_a()
    {
        $page_row = $this->get_element();
        
        $title_a = new HTMLTags_A($page_row->get_title());
        
        $title_a->set_href($page_row->get_page_url());
        
        $title_a->set_attribute_str('target', '_blank');
        
        return $title_a;
    }
}
?>
