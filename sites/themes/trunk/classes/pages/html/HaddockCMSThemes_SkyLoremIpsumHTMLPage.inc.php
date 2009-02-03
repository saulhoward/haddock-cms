<?php
/**
 * HaddockCMSThemes_SkyLoremIpsumHTMLPage
 *
 * @copyright 2009-02-03, Robert Impey
 */

class
	HaddockCMSThemes_SkyLoremIpsumHTMLPage
extends
	PublicHTMLSkyTheme_HTMLPage
{
	public function
		content()
	{
		HaddockCMSThemes_LoremIpsumHelper::render_lorem_ipsum_content('Sky');
	}
	
	protected function
		get_navigation_pages()
	{
		return HaddockCMSThemes_NavigationPagesHelper::get_navigation_pages();
	}
}
?>
