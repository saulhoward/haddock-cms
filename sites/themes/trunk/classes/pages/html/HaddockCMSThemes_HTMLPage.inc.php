<?php
/**
 * HaddockCMSThemes_HTMLPage
 *
 * @copyright 2009-01-17, Robert Impey
 */

abstract class
	HaddockCMSThemes_HTMLPage
extends
	PublicHTML_HTMLPage
{
	protected function
		get_navigation_pages()
	{
		return HaddockCMSThemes_NavigationPagesHelper::get_navigation_pages();
	}
}
?>