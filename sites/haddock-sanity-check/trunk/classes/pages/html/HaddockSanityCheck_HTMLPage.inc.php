<?php
/**
 * HaddockSanityCheck_HTMLPage
 *
 * @copyright 2008-06-13, Robert Impey
 */

abstract class
	HaddockSanityCheck_HTMLPage
extends
	PublicHTML_HTMLPage
{
    	protected function
		get_navigation_pages()
	{
		$navigation_pages[] = array(
			'page-class' => 'HaddockSanityCheck_HomeHtmlPage',
			'href' => '/HaddockSanityCheck_HomeHtmlPage',
			'title' => 'Home',
			'text' => 'Home'
		);
		
		$navigation_pages[] = array(
			'page-class' => 'MailingList_SignUpPage',
			'href' => '/MailingList_SignUpPage',
			'title' => 'Mailing List Sign up Page',
			'text' => 'Mailing List Sign up Page'
		);
		
		$navigation_pages[] = array(
			'page-class' => 'UserLogin_RegistrationPage',
			'href' => '/UserLogin_RegistrationPage',
			'title' => 'User Login Registration Page',
			'text' => 'User Login Registration Page'
		);
		
		return $navigation_pages;
	}
}
?>