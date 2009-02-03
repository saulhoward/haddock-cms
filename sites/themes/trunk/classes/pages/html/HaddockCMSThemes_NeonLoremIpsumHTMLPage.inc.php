<?php
/**
 * HaddockCMSThemes_NeonLoremIpsumHTMLPage
 *
 * @copyright 2009-02-02, Robert Impey
 */

class
	HaddockCMSThemes_NeonLoremIpsumHTMLPage
extends
	PublicHTMLNeonTheme_HTMLPage
{
	public function
		content()
	{
		HaddockCMSThemes_LoremIpsumHelper::render_lorem_ipsum_content('Neon');
	}
	
	protected function
		get_navigation_pages()
	{
		return HaddockCMSThemes_NavigationPagesHelper::get_navigation_pages();
	}
}
?>
