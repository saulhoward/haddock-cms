<?php
/**
 * Admin_SiteMapUL
 *
 * @copyright Clear Line Web Design, 2007-08-20
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_UL.inc.php';

class
	Admin_SiteMapUL
extends
	HTMLTags_UL
{
	private $anxf;
	private $admin_user_level;
	
	public function
		__construct(
			Admin_NavigationXMLFile $anxf,
			$admin_user_level
		)
	{
		parent::__construct(null);

		$this->set_attribute_str('id', 'site-map');

		$this->anxf = $anxf;

		$this->admin_user_level = $admin_user_level;
	}
    
        public function
        append_str_to_content($str)
    {
        $msg = <<<MSG
Attempt to append a string to the content of a Admin_SiteMapUL!
MSG;

        throw new Exception($msg);
    }
    
    public function
        append_tag_to_content(HTMLTags_Tag $tag)
    {
        $msg = <<<MSG
Attempt to append a tag to the content of a Admin_SiteMapUL!
MSG;

        throw new Exception($msg);
    }
    
    public function
        get_content()
    {
	$content = new HTMLTags_TagContent();
	
        foreach ($this->anxf->get_sections() as $section) {
		if ($this->anxf->has_access_permission_for_section($section, $this->admin_user_level)) {
            $section_li = new HTMLTags_LI();
            
            $section_title = $this->anxf->get_section_title($section);
            
            $section_title_h3 = new HTMLTags_Heading(3, $section_title);
            $section_title_h3->set_attribute_str('id', 'section-title');
            
            $section_li->append_tag_to_content($section_title_h3);
            
            if ($section == 'project-specific') {
                $pages = $this->anxf->get_pages_in_section($section);
                
                $section_ul = new HTMLTags_UL();
                $section_ul->set_attribute_str('class', 'section-pages-list');
                
                foreach ($pages as $page) {
			if ($this->anxf->has_access_permission_for_page_in_section($page, $section, $this->admin_user_level)) {
				$page_li = new HTMLTags_LI();

#$page_li->append_str_to_content($page);

				$page_title = $this->anxf->get_title_for_page_in_section($page, $section);

				$page_a = new HTMLTags_A($page_title);

				$page_url = $this->anxf->get_url_for_page_in_section($page, $section);
				$page_a->set_href($page_url);

				$page_li->append_tag_to_content($page_a);

				$section_ul->add_li($page_li);
			}
                }
                
                $section_li->append_tag_to_content($section_ul);
            } else {
                $modules = $this->anxf->get_modules_in_section($section);
                
                $section_ul = new HTMLTags_UL();
                
                foreach ($modules as $module) {
			if ($this->anxf->has_access_permission_for_module_in_section($module, $section, $this->admin_user_level)) {

                    $module_li = new HTMLTags_LI();
                    
                    $module_title = $this->anxf->get_module_title_in_section($module, $section);
                    
                    #$module_li->append_str_to_content($module);
                    $module_title_h4 = new HTMLTags_Heading(4, $module_title);
                    $module_title_h4->set_attribute_str('id', 'module-title');
                    
                    $module_li->append_tag_to_content($module_title_h4);
                    
                    $module_ul = new HTMLTags_UL();
                    $module_ul->set_attribute_str('class', 'module-pages-list');
                    
                    $pages = $this->anxf->get_pages_in_module($module, $section);
                    
                    #echo 'count($pages): ' . count(\$pages) . "\n";
                    
				foreach ($pages as $page) {
					if (
						$this->anxf->has_access_permission_for_page_in_module_in_section(
							$page,
							$module, 
							$section, 
							$this->admin_user_level
						)
					) {
						$page_li = new HTMLTags_LI();

						$page_title = $this->anxf->get_title_for_page_in_module_in_section($page, $module, $section);

						$page_a = new HTMLTags_A($page_title);

						$page_url = $this->anxf->get_url_for_page_in_module_in_section($page, $module, $section);
						$page_a->set_href($page_url);

						$page_li->append_tag_to_content($page_a);

						$module_ul->add_li($page_li);
					}
				}
                    
                    $module_li->append_tag_to_content($module_ul);
                    
                    $section_ul->add_li($module_li);

		    	}
                }
                
                $section_li->append_tag_to_content($section_ul);
            }
            
            $content->append_tag($section_li);
        }
	
	}

        return $content;
    }
}
?>
