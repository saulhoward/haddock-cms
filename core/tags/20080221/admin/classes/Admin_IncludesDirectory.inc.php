<?php
/**
 * Admin_IncludesDirectory
 *
 * @copyright Clear Line Web Design, 2007-01-16
 */

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/'
    . 'HaddockProjectOrganisation_IncludesDirectory.inc.php';

require_once PROJECT_ROOT
    . '/haddock/admin/classes/'
    . 'Admin_NavigationLinksFile.inc.php';

require_once PROJECT_ROOT
    . '/haddock/admin/classes/'
    . 'Admin_PageDirectory.inc.php';

class
    Admin_IncludesDirectory
extends
    HaddockProjectOrganisation_IncludesDirectory
{
    /*
     * Methods to do with the navigation links file.
     */
    private function
        get_navigation_links_filename()
    {
        return $this->get_name() . '/pages/navigation-links.txt';
    }
    
    public function
        has_navigation_links_file()
    {
        return file_exists($this->get_navigation_links_filename());
    }
    
    public function
        get_navigation_links_file()
    {
        if ($this->has_navigation_links_file()) {
            return new Admin_NavigationLinksFile(
                $this->get_navigation_links_filename(),
                $this
            );
        } else {
            $msg = 'Navigation links file requested for '
                . $this->get_name()
                . ' but no such file exists!';
                
            throw new Exception($msg);
        }
    }
    
    /*
     * Methods to do with the page directories.
     */
    private function
        get_page_directory_name($page_directory_basename)
    {
        return $this->get_name() . "/pages/$page_directory_basename";
    }
    
    public function
        has_page_directory($page_directory_basename)
    {
        return is_dir(
            $this->get_page_directory_name($page_directory_basename)
        );
    }
    
    public function
        create_page_directory($page_directory_basename)
    {
        if ($this->has_page_directory($page_directory_basename)) {
            #echo "$pages_directory_name already exists!\n";
        } else {
            #echo "Creating $page_directory_basename\n";
            
            $pages_directory_name = $this->get_name() . '/pages';
            
            if (is_dir($pages_directory_name)) {
                #echo "$pages_directory_name already exists!\n";
            } else {
                mkdir($pages_directory_name);
            }
            
            $page_directory_name = $this->get_page_directory_name($page_directory_basename);
            
            if (is_dir($page_directory_name)) {
                #echo "$page_directory_name already exists!\n";
            } else {
                #echo "Creating $page_directory_name\n";
                
                mkdir($page_directory_name);
            }
        }
    }
    
    public function
        get_page_directory($page_directory_basename)
    {
        if ($this->has_page_directory($page_directory_basename)) {
            return new Admin_PageDirectory(
                $this->get_page_directory_name($page_directory_basename)
#		,
#                $this->get_pages_directory()
            );
        } else {
            $msg = 'Page directory "'
                . $page_directory_basename
                . '" requested but no such directory exists!';
                
            throw new Exception($msg);
        }
    }
    
    public function
        get_pages_directory()
    {
        if ($this->has_pages_directory()) {
            return new Admin_PagesDirectory(
                $this->get_pages_directory_name(),
                $this
            );
        } else {
            throw new Exception('No pages directory!');
        }
    }
}
?>
