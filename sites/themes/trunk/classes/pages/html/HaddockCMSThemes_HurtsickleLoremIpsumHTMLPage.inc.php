<?php
/**
 * HaddockCMSThemes_HurtsickleLoremIpsumHTMLPage
 *
 * @copyright 2010-02-08, Robert Impey
 */

class
	HaddockCMSThemes_HurtsickleLoremIpsumHTMLPage
extends
	PublicHTMLHurtsickleTheme_HTMLPage
{
	public function
		content()
	{
		HaddockCMSThemes_LoremIpsumHelper::render_lorem_ipsum_content('Hurtsickle');
	}
	
	protected function
		get_navigation_pages()
	{
		return HaddockCMSThemes_NavigationPagesHelper::get_navigation_pages();
	}
}
?>
