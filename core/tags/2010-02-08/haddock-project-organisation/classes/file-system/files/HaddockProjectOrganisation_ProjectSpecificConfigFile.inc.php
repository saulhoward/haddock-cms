<?php
/**
 * HaddockProjectOrganisation_ProjectSpecificConfigFile
 *
 * @copyright 2008-05-30, RFI
 */

class
	HaddockProjectOrganisation_ProjectSpecificConfigFile
extends
	FileSystem_XMLFile
{
    protected function
        get_project_tag()
    {
        $dom_document = $this->get_dom_document();
        
        $project_tags = $dom_document->getElementsByTagName('project');
        
        $project_tag = $project_tags->item(0);
        
        if (isset($project_tag)) {
            return $project_tag;
        } else {
            throw new Exception('The project name must be set in config.xml!');
        }
    }
    
    public function
        get_project_name()
    {
        $project_tag = $this->get_project_tag();
        
        $project_name = $project_tag->getAttribute('name');
        
        return $project_name;
    }
    
    public function
        get_project_title()
    {
        $project_title = '';
        
        $project_tag = $this->get_project_tag();
        
        if ($project_tag->hasAttribute('title')) {
            $project_title = $project_tag->getAttribute('title');
        } else {
            $project_name = $this->get_project_name();
            
            $pn_low = Formatting_ListOfWordsHelper::get_list_of_words_for_string($project_name, '-');
            
            $project_title = $pn_low->get_words_as_capitalised_string();
        }
        
        return $project_title;
    }
    
    public function
        get_copyright_holder()
    {
        $copyright_holder = '';
        
        $project_tag = $this->get_project_tag();
        
        if ($project_tag->hasAttribute('copyright_holder')) {
            $copyright_holder = $project_tag->getAttribute('copyright_holder');
        }
        
        return $copyright_holder;
    }
    
    public function
        get_version_code()
    {
        $version_code = '';
        
        $project_tag = $this->get_project_tag();
        
        if ($project_tag->hasAttribute('version_code')) {
            $version_code = $project_tag->getAttribute('version_code');
        }
        
        return $version_code;
    }
    
    public function
        get_camel_case_root()
    {
        $project_title = '';
        
        $project_tag = $this->get_project_tag();
        
        if ($project_tag->hasAttribute('camel_case_root')) {
            $project_title = $project_tag->getAttribute('camel_case_root');
        } else {
            $project_name = $this->get_project_name();
            
            $pn_low = Formatting_ListOfWordsHelper::get_list_of_words_for_string($project_name, '-');
            
            $project_title = $pn_low->get_words_as_camel_case_string();
        }
        
        return $project_title;
    }
}
?>