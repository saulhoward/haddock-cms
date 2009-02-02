<?php
/**
 * HaddockCMSThemes_NavigationPagesHelper
 *
 * @copyright 2009-02-02, Robert Impey
 */

class
	HaddockCMSThemes_NavigationPagesHelper
{
	public static function
		get_navigation_pages()
	{
		$navigation_pages[] = array(
			'page-class' => 'HaddockCMSThemes_HomeHTMLPage',
			'href' => '/HaddockCMSThemes_HomeHTMLPage',
			'title' => 'Home',
			'text' => 'Home'
		);
		
		$navigation_pages[] = array(
			'page-class' => 'HaddockCMSThemes_ThemesListHTMLPage',
			'href' => '/HaddockCMSThemes_ThemesListHTMLPage',
			'title' => 'Themes',
			'text' => 'Themes'
		);
		
		return $navigation_pages;
	}
}
?>