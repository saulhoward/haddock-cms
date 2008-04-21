<?php
/**
 * PublicHTML_URLHelper
 * 
 * @copyright Clear Line Web Design, 2008-02-05
 */

class
	PublicHTML_URLHelper
{
	/**
	 * NOT DEPRECATED!
	 *
	 * Use PublicHTML_URLFactory::make_local_url instead.
	 *
	 * In fact, ignore that warning.
	 *
	 * Use this class for now.
	 *
	 * The URL factories will probably work in a more OO way and be
	 * objects that are returned by a URL factory factory.
	 */
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
		
		return PublicHTML_URLFactory::make_local_url($page_class, $get_variables);
	}
	
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
}
?>