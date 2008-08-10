<?php
/**
 * Admin_NXFPage
 *
 * @copyright 2008-04-29, RFI
 */

class
	Admin_NXFPage
{
	private $page;
	private $module;
	private $section;
	private $url;
	private $special_page;
	private $page_class;

	public function 
		__construct()
	{
		$this->page = NULL;
		$this->module = NULL;
		$this->section = NULL;
		$this->url = NULL;
		$this->special_page = NULL;
		$this->page_class = NULL;
	}

	public function 
		get_page()
	{
		return $this->page;
	}

	public function 
		set_page($page)
	{
		$this->page = $page;
	}

	public function 
		get_module()
	{
		return $this->module;
	}
	
	public function 
		has_module()
	{
		return isset($this->module);
	}

	public function 
		set_module($module)
	{
		$this->module = $module;
	}

	public function 
		get_section()
	{
		return $this->section;
	}

	public function 
		set_section($section)
	{
		$this->section = $section;
	}

	public function 
		get_url()
	{
		if (!isset($this->url)) {
			if ($this->has_page_class()) {
				$this->url
					= PublicHTML_URLHelper
						::get_oo_page_url(
							$this->get_page_class()
						);
			} else {
				$this->url = new HTMLTags_URL();
				
				$this->url->set_file('/');
				
				$this->url->set_get_variable('section', 'haddock');
				$this->url->set_get_variable('module', 'admin');
				$this->url->set_get_variable('page', 'admin-includer');
				$this->url->set_get_variable('type', 'html');
					
				if (
					$this->has_special_page() 
					&& 
					$this->get_special_page()  == 'db-table-xml'
				) {			
					$this->url->set_get_variable('admin-section', 'haddock');
					$this->url->set_get_variable('admin-module', 'database');
					$this->url->set_get_variable('admin-page', 'table-xml');
	
					$this->url->set_get_variable('db-section', $this->get_section());
					$this->url->set_get_variable('db-xml-file', $this->get_page());
					
					if ($this->has_module()) {
						$this
							->url
								->set_get_variable(
									'db-module',
									$this->get_module()
								);
					}
				} else {
					$this->url->set_get_variable('admin-section', $this->get_section());
					$this->url->set_get_variable('admin-page', $this->get_page());
					
					if ($this->has_module()) {
						$this
							->url
								->set_get_variable(
									'admin-module',
									$this->get_module()
								);
					}
				}
			}
		}
		
		return $this->url;
	}

	public function 
		set_url(
			HTMLTags_URL $url
		)
	{
		$this->url = $url;
	}

	public function 
		get_special_page()
	{
		return $this->special_page;
	}

	public function 
		set_special_page($special_page)
	{
		$this->special_page = $special_page;
	}
	
	public function 
		has_special_page()
	{
		return isset($this->special_page);
	}
	
	public function 
		get_page_class()
	{
		return $this->page_class;
	}

	public function 
		set_page_class($page_class)
	{
		$this->page_class = $page_class;
	}
	
	public function 
		has_page_class()
	{
		return isset($this->page_class);
	}
}
?>