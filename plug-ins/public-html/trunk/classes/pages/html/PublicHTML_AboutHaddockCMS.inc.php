<?php
class
	PublicHTML_AboutHaddockCMS
extends
	PublicHTML_HTMLPage
{
	public function
		run_post_session_header_commands()
	{
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		$config_manager = $cmf->get_config_manager('haddock', 'public-html');
		
		if (!$config_manager->is_meta_page_about_haddock_cms_shown()) {
			throw new PublicHTML_PageNotFoundException($_SERVER['REQUEST_URI']);
		}
	}
	
	public function
		content()
	{
		$about_haddock = <<<HDK
Congratulations! You've successfully installed Haddock CMS
on your system.

You now want to set the config variable:

<code>haddock/public-html/locations/default</code>

for this project to something sensible.

You also want to set

<code>haddock/public-html/verbosity/meta-pages/show-about-haddock-cms</code>

for this project to false to stop showing this page.

HDK;

		$ps = HTMLTags_BLSeparatedPFactory::get_ps_from_str($about_haddock);
		
		foreach ($ps as $p) {
			echo $p->get_as_string();
		}
	}
}
?>