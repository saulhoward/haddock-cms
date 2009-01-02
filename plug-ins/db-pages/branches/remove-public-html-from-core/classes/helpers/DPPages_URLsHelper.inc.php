<?php
/**
 * DPPages_URLsHelper
 *
 * @copyright 2008-05-07, RFI
 */

class
	DPPages_URLsHelper
{
	public static function
		get_db_page_url($page_name)
	{
		#$ph_cm = Configuration_ConfigManagerHelper
		#	::get_config_manager(
		#		'haddock',
		#		'public-html'
		#	);
		#
		#if ($ph_cm->server_has_mod_rewrite()) {
		if (
			PublicHTML_ServerCapabilitiesHelper
				::has_mod_rewrite()
		) {
			#echo "has mod_rewrite!\n";
			
			$url = new HTMLTags_URL();
			
			$url->set_file("/db-pages/$page_name.html");
		} else {
			$url = PublicHTML_URLHelper::get_base_url();
			
			$url->set_get_variable('oo-page');
			$url->set_get_variable('pcro-factory', 'DBPages_PCROFactory');
			$url->set_get_variable('page', $page_name);
		}
		
		return $url;
	}
}
?>