<?php
/**
 * Admin_NavigationLinksFile
 *
 * @copy Clear Line Web Design, 2007-01-24
 */

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_NavigationLinksFile.inc.php';

class
    Admin_NavigationLinksFile
extends
    HaddockProjectOrganisation_NavigationLinksFile
{
    public function
        get_navigation_links()
    {
        $navigation_links = array();
        
        $lines_without_comments = $this->get_lines_without_comments();
        
        $includes_directory = $this->get_includes_directory();
        
        foreach ($lines_without_comments as $page_directory_basename) {
            $navigation_links[]
                = $includes_directory->get_page_directory($page_directory_basename);
        }
        
        return $navigation_links;
    }
}
?>
