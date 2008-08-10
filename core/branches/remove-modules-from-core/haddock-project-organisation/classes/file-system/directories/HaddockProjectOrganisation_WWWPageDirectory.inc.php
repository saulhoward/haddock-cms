<?php
/**
 * HaddockProjectOrganisation_WWWPageDirectory
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

class
	HaddockProjectOrganisation_WWWPageDirectory
extends
    HaddockProjectOrganisation_PageDirectory
{
    private $www_includes_directory;
    
    public function
        __construct(
            $name,
            HaddockProjectOrganisation_WWWIncludesDirectory $www_includes_directory
        )
    {
        parent::__construct($name);
        
        $this->www_includes_directory = $www_includes_directory;
    }
    
    public function
        get_www_includes_directory()
    {
        return $this->www_includes_directory;
    }
    
    public function
        get_html_tags_href()
    {
        $html_tags_href = new HTMLTags_URL();
        
        return $html_tags_href;
    }
    
    public function
        get_type()
    {
        $page_name = $this->basename();
        
        $regex = '{([-a-z]+)(?:\\\\|/)' . $page_name . '$}';
        
        #echo "\$regex: $regex\n";
        
        if (preg_match($regex, $this->get_name(), $matches)) {
            return $matches[1];
        } else {
            throw new Exception('Unable to extract the page type from ' . $this->get_name() . '!');
        }
    }
    
    public function
        create_inc_files($copyright_holder)
    {
        if ($this->get_type() == 'html') {
            $body_div_content_inc_filename = $this->get_name() . '/body.div.content.inc.php';
            
            if (file_exists($body_div_content_inc_filename)) {
                #echo "$body_div_content_inc_filename already exists!\n";
            } else {
                $body_div_content_inc_file = new HaddockProjectOrganisation_PHPIncFile($body_div_content_inc_filename);
                
                $body_div_content_inc_file->set_title_line('Content of the "' . $this->get_page_name() . '" page.');
                $body_div_content_inc_file->set_copyright_holder($copyright_holder);
                
                $content_div_content = '';
                
                $content_div_content .= '$content_div = new HTMLTags_Div();' . "\n";
                $content_div_content .= '$content_div->set_attribute_str(\'id\', \'content\');' . "\n";
                
                $content_div_content .= "\n";
    
                $content_div_content .= 'echo $content_div->get_as_string();' . "\n";
                
                $body_div_content_inc_file->set_body($content_div_content);
                
                $body_div_content_inc_file->save();
            }
        } else {
            $main_inc_filename = $this->get_name() . '/main.inc.php';
            
            if (file_exists($main_inc_filename)) {
                #echo "$main_inc_filename already exists!\n";
            } else {
                $main_inc_file = new HaddockProjectOrganisation_PHPIncFile($main_inc_filename);
                
                $main_inc_file->set_title_line('Main code for the "' . $this->get_page_name() . '" page.');
                $main_inc_file->set_copyright_holder($copyright_holder);
                
                $main_inc_file->save();
            }
        }
    }
}
?>
