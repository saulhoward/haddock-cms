<?php
/**
 * PublicHTML_URLHelper
 * 
 * @copyright Clear Line Web Design, 2008-02-05
 */

class
	PublicHTML_URLHelper
{
	public static function
		get_current_url()
	{
		$url
			= HTMLTags_URL
				::parse_and_make_url(
					$_SERVER['REQUEST_URI']
				);
		
		$url->make_absolute_for_current_server();
		
		return $url;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with making Haddock style URLs.
	 * ----------------------------------------
	 */
	
	public static function
		get_base_url()
	{
		$url = new HTMLTags_URL();
		
		$ph_cm = Configuration_ConfigManagerHelper
			::get_config_manager(
				'haddock',
				'public-html'
			);
		
		if ($ph_cm->server_has_mod_rewrite()) {
			$url->set_file('/');
		} else {
			$url->set_file('/haddock/public-html/public-html/index.php');
		}
		
		return $url;
	}
	
	public static function
		get_oo_page_url(
			$page_class,
			$get_variables = NULL
		)
	{
		#$url = new HTMLTags_URL();
		#
		##$url->set_file('/haddock/public-html/public-html/index.php');
		#
		##print_r($get_variables);
		#
		#if (isset($get_variables)) {
		#	$url->set_file('/');
		#	
		#	$url->set_get_variable('oo-page');
		#	$url->set_get_variable('page-class', $page_class);
		#	
		#	foreach ($get_variables as $k => $v) {
		#		$url->set_get_variable($k, $v);
		#	}
		#} else {
		#	$url->set_file("/$page_class");
		#}
		#
		#return $url;
		
		#return PublicHTML_URLFactory::make_local_url($page_class, $get_variables);
		
		$url = self::get_base_url();
		
		$url->set_get_variable('oo-page');
		$url->set_get_variable('page-class', $page_class);
		
		if (isset($get_variables)) {
			foreach ($get_variables as $k => $v) {
				$url->set_get_variable($k, urlencode($v));
			}
		}
		
		return $url;
	}
	
	public static function
		get_pm_page_url(
				$page,
				$type = 'html',
				$section = 'project-specific',
				$module = NULL
			)
	{
		$url = self::get_base_url();
		
		$url->set_get_variable('page', $page);
		$url->set_get_variable('type', $type);
		$url->set_get_variable('section', $section);
		
		if (isset($module)) {
			$url->set_get_variable('module', $module);
		}
		
		return $url;
	}
}
?>