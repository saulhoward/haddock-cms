<?php
/**
 * PublicHTML_URLFactory
 *
 * @copyright Clear Line Web Design, 2008-02-08
 */

class
	PublicHTML_URLFactory
{
	/**
	 * Makes a local URL.
	 *
	 * Assumes that you want an OO page.
	 *
	 * DEPREACATED!!
	 */
	public static function
		make_local_url(
			$page_class,
			$get_variables = NULL
		)
	{
		#$url = new HTMLTags_URL();
		
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
		#$url->set_file('/');
		#
		#$url->set_get_variable('oo-page');
		#$url->set_get_variable('page-class', $page_class);
		#
		#if (isset($get_variables)) {
		#	foreach ($get_variables as $k => $v) {
		#		$url->set_get_variable($k, urlencode($v));
		#	}
		#}
		#
		#return $url;
		
		return PublicHTML_URLHelper
			::get_oo_page_url(
				$page_class,
				$get_variables
			);
	}
}
?>