<?php
/**
 * Admin_NavigationXMLFile
 *
 * @copyright Clear Line Web Design, 2007-08-18
 */

class
	Admin_NavigationXMLFile
extends
	FileSystem_XMLFile
{
	private function
		get_section_elements()
	{
		$dom_document = $this->get_dom_document();
		
		$section_elements = $dom_document->getElementsByTagName('section');
		
		return $section_elements;
	}
	
	private function
		get_section_element($section)
	{
		$section_elements = $this->get_section_elements();
		
		foreach ($section_elements as $section_element) {
			if ($section_element->getAttribute('name') == $section) {
				return $section_element;
			}
		}
		
		throw new Exception("No section called $section!");
	}
	
	public function
		get_sections()
	{
		$sections = array();

		$section_elements = $this->get_section_elements();

		foreach ($section_elements as $section_element) {
#			$section_data = array();
#
#			$section_data['name'] = $section_element->getAttribute('name');
#
#			$section_data['access_level'] 
#			=
#				$section_element->hasAttribute('access_level') 
#				?
#					$section_element->getAttribute('access_level') : NULL;
#
#			$sections[] = $section_data;

			$sections[] = $section_element->getAttribute('name');
		}

		return $sections;
	}

	public function
		get_access_level_for_section($section)
	{
		$section_element = $this->get_section_element($section);

		if ($section_element->hasAttribute('access_level')) {
			return $section_element->getAttribute('access_level');
		}

		return NULL;
	}

	public function
		get_section_title($section)
	{
		$section_element = $this->get_section_element($section);
		
		if ($section_element->hasAttribute('title')) {
			return $section_element->getAttribute('title');
		} else {
			$stlow
				= Formatting_ListOfWordsHelper
					::get_list_of_words_for_string(
						$section_element->getAttribute('name'),
						$separator = '-'
					);
			
			return $stlow->get_words_as_capitalised_string();
		}
	}
	
	private function
		get_page_elements_in_section($section)
	{
		if (($section == 'haddock') || ($section == 'plug-ins')) {
			throw new Exception("Attempt to find pages in $section section!");
		}
		
		$page_elements = array();
		
		$section_element = $this->get_section_element($section);
		
		$all_page_elements = $section_element->getElementsByTagName('page');
		
		foreach ($all_page_elements as $pe) {
			if (!$pe->hasAttribute('enabled') || ($pe->getAttribute('enabled') == 'true')) {
				$page_elements[] = $pe;
			}
		}
		
		return $page_elements;
	}
	
	public function
		get_pages_in_section($section)
	{
		$pages = array();
		
		$page_elements = $this->get_page_elements_in_section($section);
		
		foreach ($page_elements as $page_element) {
			if ($page_element->hasAttribute('name')) {
				$pages[] = $page_element->getAttribute('name');
			} else {
				throw new Exception("name attribute not set for page element in the $section section!");
			}
		}
		
		return $pages;
	}
	
	private function
		get_module_elements_in_section($section)
	{
		if ($section == 'project-specific') {
			throw new Exception("Attempt to find modules in $section section!");
		}
		
		$module_elements = array();
		
		$section_element = $this->get_section_element($section);
		
		$module_elements = $section_element->getElementsByTagName('module');
		
		return $module_elements;
	}
	
	public function
		get_modules_in_section($section)
	{
		$modules = array();
		
		$module_elements = $this->get_module_elements_in_section($section);
		
		foreach ($module_elements as $module_element) {
			if ($module_element->hasAttribute('name')) {
				$modules[] = $module_element->getAttribute('name');
			} else {
				throw new Exception("name attribute not set for module element in the $section section!");
			}
		}
		
		return $modules;
	}
	
	private function
		get_module_element_in_section($module, $section)
	{
		$module_elements = $this->get_module_elements_in_section($section);
		
		foreach ($module_elements as $module_element) {
			if ($module_element->hasAttribute('name')) {
				if ($module_element->getAttribute('name') == $module) {
					return $module_element;
				}
			}
		}
		
		throw new Exception("No module called $module in the $section section!");
	}
	
	private function
		get_page_elements_in_module($module, $section)
	{
		$page_elements = array();
		
		$module_element = $this->get_module_element_in_section($module, $section);
		
		#$page_elements = $module_element->getElementsByTagName('page');
		$all_page_elements = $module_element->getElementsByTagName('page');
		
		foreach ($all_page_elements as $pe) {
			if (!$pe->hasAttribute('enabled') || ($pe->getAttribute('enabled') == 'true')) {
				$page_elements[] = $pe;
			}
		}
		
		return $page_elements;
	}
	
	public function
		get_pages_in_module($module, $section)
	{
		$pages = array();
		
		$page_elements = $this->get_page_elements_in_module($module, $section);
		
		foreach ($page_elements as $page_element) {
			if ($page_element->hasAttribute('name')) {
				$pages[] = $page_element->getAttribute('name');
			} else {
				throw new Exception("name attribute not set in page element in the $module module in the $section section!");
			}
		}
		
		return $pages;
	}
	
	public function
		get_module_title_in_section($module, $section)
	{
		$module_element = $this->get_module_element_in_section($module, $section);
		
		if ($module_element->hasAttribute('title')) {
			return $module_element->getAttribute('title');
		} else {
			if ($module_element->hasAttribute('name')) {
				$mtlow
					= Formatting_ListOfWordsHelper
						::get_list_of_words_for_string(
							$module_element->getAttribute('name'),
							$separator = '-'
						);
				
				return $mtlow->get_words_as_capitalised_string();
			}
		}
		
		throw new Exception("Unable to find the title for the $module module in the $section section!");
	}
	
	public function
		get_title_for_page_in_section($page, $section)
	{
		$title = '';
		
		$page_element = $this->get_page_element_in_section($page, $section);
		
		if ($page_element->hasAttribute('title')) {
			$title = $page_element->getAttribute('title');
		} else {
			$ptlow
				= Formatting_ListOfWordsHelper
					::get_list_of_words_for_string(
						$page_element->getAttribute('name'),
						$separator = '-'
					);
			
			$title = $ptlow->get_words_as_capitalised_string();
		}
		
		return $title;
	}
	
	private function
		get_page_element_in_section($page, $section)
	{
		$page_elements = $this->get_page_elements_in_section($section);
		
		foreach ($page_elements as $pe) {
			if ($pe->hasAttribute('name')) {
				if ($pe->getAttribute('name') == $page) {
					return $pe;
				}
			}
		}
		
		throw new Exception("No page called $page in the $section section!");
	}
	
	private function
		get_page_element_in_module_in_section($page, $module, $section)
	{
		$page_elements = $this->get_page_elements_in_module($module, $section);
		
		foreach ($page_elements as $pe) {
			if ($pe->hasAttribute('name')) {
				if ($pe->getAttribute('name') == $page) {
					return $pe;
				}
			}
		}
		
		throw new Exception("No page called $page in the $module module in the $section section!");
	}
	
	public function
		get_title_for_page_in_module_in_section($page, $module, $section)
	{
		$page_element = $this->get_page_element_in_module_in_section($page, $module, $section);
		
		$title = '';
		
		if ($page_element->hasAttribute('title')) {
			$title = $page_element->getAttribute('title');
		} else {
			$ptlow
				= Formatting_ListOfWordsHelper
					::get_list_of_words_for_string(
							$page_element->getAttribute('name'),
							$separator = '-'
						);
				
			$title = $ptlow->get_words_as_capitalised_string();
		}
		
		return $title;
	}
	
	public function
		get_url_for_page_in_section($page, $section)
	{
		$page_element = $this->get_page_element_in_section($page, $section);
		
		if ($page_element->hasAttribute('url')) {
			$url = new HTMLTags_URL($page_element->getAttribute('url'));
		} else {
			$url = new HTMLTags_URL();
			
			$url->set_file('/');
			
			$url->set_get_variable('section', 'haddock');
			$url->set_get_variable('module', 'admin');
			$url->set_get_variable('page', 'admin-includer');
			$url->set_get_variable('type', 'html');
			
		if (
			$page_element->hasAttribute('special_page') 
			&& 
			$page_element->getAttribute('special_page') == 'db-table-xml'
		) {			
			$url->set_get_variable('admin-section', 'haddock');
			$url->set_get_variable('admin-module', 'database');
			$url->set_get_variable('admin-page', 'table-xml');

			$url->set_get_variable('db-section', $section);
			$url->set_get_variable('db-xml-file', $page);
		} else {
			$url->set_get_variable('admin-section', $section);
			$url->set_get_variable('admin-page', $page);
		}
	   }

		return $url;
	}
	
	public function
		get_url_for_page_in_module_in_section($page, $module, $section)
	{
		$page_element = $this->get_page_element_in_module_in_section($page, $module, $section);
		
		if ($page_element->hasAttribute('url')) {
			$url = new HTMLTags_URL($page_element->getAttribute('url'));
		} else {
			$url = new HTMLTags_URL();
			
			$url->set_file('/');
			
			$url->set_get_variable('section', 'haddock');
			$url->set_get_variable('module', 'admin');
			$url->set_get_variable('page', 'admin-includer');
			$url->set_get_variable('type', 'html');
			
		if (
			$page_element->hasAttribute('special_page') 
			&& 
			$page_element->getAttribute('special_page') == 'db-table-xml'
		) {			
			$url->set_get_variable('admin-section', 'haddock');
			$url->set_get_variable('admin-module', 'database');
			$url->set_get_variable('admin-page', 'table-xml');

			$url->set_get_variable('db-section', $section);
					$url->set_get_variable('db-module', $module);
			$url->set_get_variable('db-xml-file', $page);
		} else {
			$url->set_get_variable('admin-section', $section);
			$url->set_get_variable('admin-module', $module);
			$url->set_get_variable('admin-page', $page);
		}
		}
		
		return $url;
	}

	public function
		has_access_permission_for_section(
			$section,
			$access_level
		)
	{
		#echo "\$access_level: $access_level\n";

		$section_element = $this->get_section_element($section);

		if ($section_element->hasAttribute('access_level')) {
			$access_levels_str = $section_element->getAttribute('access_level');

			$access_levels = preg_split('/\s*,\s*/', $access_levels_str);
			
			#print_r($access_levels); exit;

			if (!in_array($access_level, $access_levels)) {
				return FALSE;
			}
		}

		return TRUE;
	}
	
	public function
		has_access_permission_for_module_in_section(
			$module,
			$section,
			$access_level
		)
	{
		#echo "\$access_level: $access_level\n";

		$module_element = $this->get_module_element_in_section($module, $section);

		if ($module_element->hasAttribute('access_level')) {
			$access_levels_str = $module_element->getAttribute('access_level');

			$access_levels = preg_split('/\s*,\s*/', $access_levels_str);
			
			#print_r($access_levels); exit;

			if (!in_array($access_level, $access_levels)) {
				return FALSE;
			}
		}

		return TRUE;
	}
	
	public function
		has_access_permission_for_page_in_section(
			$page,
			$section,
			$access_level
		)
	{
		#echo "\$access_level: $access_level\n";

		$page_element = $this->get_page_element_in_section($page, $section);

		if ($page_element->hasAttribute('access_level')) {
			$access_levels_str = $page_element->getAttribute('access_level');

			$access_levels = preg_split('/\s*,\s*/', $access_levels_str);
			
			#print_r($access_levels); exit;

			if (!in_array($access_level, $access_levels)) {
				return FALSE;
			}
		}

		return TRUE;
	}
	
	public function
		has_access_permission_for_page_in_module_in_section(
			$page,
			$module,
			$section,
			$access_level
		)
	{
		#echo "\$access_level: $access_level\n";

		$page_element = $this->get_page_element_in_module_in_section($page, $module, $section);

		if ($page_element->hasAttribute('access_level')) {
			$access_levels_str = $page_element->getAttribute('access_level');

			$access_levels = preg_split('/\s*,\s*/', $access_levels_str);
			
			#print_r($access_levels); exit;

			if (!in_array($access_level, $access_levels)) {
				return FALSE;
			}
		}

		return TRUE;
	}

}
?>