<?php
/**
 * Database_PagesTable
 *
 * @copyright Clear Line Web Design, 2007-08-29
 */

class
	Database_PagesTable
extends
    Database_Table
{
    public function
        get_page_by_name($name)
    {
        $condtions['name'] = $name;
        
        $pages = $this->get_rows_where($condtions);
        
        if (count($pages) == 1) {
            return $pages[0];
        } elseif (count($pages) < 1) {
            throw new Exception("No page called '$name' in hc_database_pages!");
        } else {
            throw new Exception("More than one page called '$name' in hc_database_pages!");
        }
    }
	
	public function
		get_pages_viewable_by_currently_logged_in_user()
	{
		return $this->get_all_rows();
	}
}
?>
