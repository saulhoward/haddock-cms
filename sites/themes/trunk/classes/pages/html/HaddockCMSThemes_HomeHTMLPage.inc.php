<?php
/**
 * HaddockCMSThemes_HomeHTMLPage
 *
 * @copyright 2009-01-17, Robert Impey
 */

class
	HaddockCMSThemes_HomeHTMLPage
extends
	HaddockCMSThemes_HTMLPage
{
	public function
		content()
	{
		$textile_content = <<<TXT
h2. Testing the Themes for Haddock CMS

This page is a simple test site for the various HTML themes that have
been created for various Haddock CMS projects.

You can start by browsing the "themes list page.":/HaddockCMSThemes_ThemesListHTMLPage
TXT;

		$textile = new Textile_Textile();
		echo $textile->TextileThis($textile_content);
	}
}
?>
