<?php
/**
 * HaddockProjectOrganisation_PageDirectory
 *
 * @copyright Clear Line Web Design, 2007-01-24
 */

#require_once PROJECT_ROOT
#    . '/haddock/file-system/classes/'
#    . 'FileSystem_Directory.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_IncludesDirectory.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_PageConfigFile.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/formatting/classes/'
#    . 'Formatting_ListOfWords.inc.php';
    
/**
 * This class and its subclasses represent directories
 * with names like:
 *
 * /<MODULE>/www(-override)?-includes/<TYPE>/<PAGE>
 *
 * These directories contain the .INC files for a page.
 *
 * The directories names should consist of lower-case,
 * hyphen-separated words.
 */
abstract class
    HaddockProjectOrganisation_PageDirectory
extends
    FileSystem_Directory
{   
    private $title;
    
#    private $includes_directory;
    
    public function
        __construct(
            $name
#	    ,
#            HaddockProjectOrganisation_IncludesDirectory $includes_directory
        )
    {
        #$regex = '/^\s*([a-z]+(?:-[a-z]+)*)\s*(?:"([^"]+)")?$/';
        #
        #if (preg_match($regex, $line, $matches)) {
        #    $this->page_directory_name = $matches[1];
        #    
        #    /**
        #     * Has the user overridden the title in the file.
        #     */
        #    if (count($matches) > 2) {
        #        $this->title = $matches[2];
        #    }
        #}
        #
        #$this->navigation_links_file = $navigation_links_file;
        
        parent::__construct($name);
        
#        $this->includes_directory = $includes_directory;
    }
    
    public function
        get_page_name()
    {
        return $this->basename();
    }
    
    private function
        get_page_config_filename()
    {
        $page_config_filename = $this->get_name() . '/page-config.txt';
        
        #echo "HaddockProjectOrganisation_PageDirectory::get_page_config_filename()\n";
        #echo "\$page_config_filename: $page_config_filename\n";
        
        return $page_config_filename;
    }
    
    public function
        has_page_config_file()
    {
        return file_exists($this->get_page_config_filename());
    }
    
    public function
        get_page_config_file()
    {
        if ($this->has_page_config_file()) {
            return new HaddockProjectOrganisation_PageConfigFile(
                $this->get_page_config_filename()
            );
        } else {
            $msg = 'Page configuration file in '
                . $this->get_name()
                . ' requested but no such file exists!';
            
            throw Exception($msg);
        }
    }
    
    public function
        get_title()
    {
        if (isset($this->title)) {
            return $this->title;
        }
        
        if ($this->has_page_config_file()) {
            $page_config_file = $this->get_page_config_file();
            
            if ($page_config_file->has_page_title()) {
                return $page_config_file->get_page_title();
            }
        }
        
        /**
         * Work out the title from the link.
         */
        $title_as_l_o_w
            = Formatting_ListOfWordsHelper
                ::get_list_of_words_for_string(
                    $this->get_page_name(),
                    '-'
                );
        
        return $title_as_l_o_w->get_words_as_capitalised_string();
    }
    
#    public function
#        get_includes_directory()
#    {
#        return $this->includes_directory;
#    }
        
    abstract public function
        get_html_tags_href();
}
?>