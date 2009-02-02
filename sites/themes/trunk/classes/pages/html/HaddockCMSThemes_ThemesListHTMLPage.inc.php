<?php
/**
 * HaddockCMSThemes_ThemesListHTMLPage
 *
 * @copyright 2009-01-17, Robert Impey
 */

class
	HaddockCMSThemes_ThemesListHTMLPage
extends
	HaddockCMSThemes_HTMLPage
{
	public function
		content()
	{
		$textile_content = <<<TXT
h2. Themes for Haddock CMS

* "Neon Lorem Ipsum":/HaddockCMSThemes_NeonLoremIpsumHTMLPage
TXT;

		$textile = new Textile_Textile();
		echo $textile->TextileThis($textile_content);
	}
}
?>
