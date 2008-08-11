<?php
/**
 * Database_PageRow
 *
 * @copyright Clear Line Web Design, 2007-08-29
 */

class
	Database_PageRow
extends
    Database_Row
{
    public function
        get_name()
    {
        return $this->get('name');
    }
    
    public function
        get_title()
    {
        return $this->get('title');
    }
    
    public function
        get_keywords()
    {
        return $this->get('keywords');
    }
    
    public function
        get_description()
    {
        return $this->get('description');
    }
    
    public function
        get_html_content()
    {
        return $this->get('html_content');
    }
    
    public function
        get_author()
    {
        $database = $this->get_database();
        
        $users_table = $database->get_table('hc_admin_users');
        
        //try {
            $user_row = $users_table->get_row_by_id($this->get('user_id'));
        //} catch (Database_RowNotFoundException $e) {
        //    /*
        //     * Do something here?
        //     */
        //}
        
        return $user_row->get_real_name();
    }
    
    
    public function
        get_page_url()
    {
        return new HTMLTags_URL('/hc/database/db-pages/' . $this->get_name() . '.html');
    }
}
?>
