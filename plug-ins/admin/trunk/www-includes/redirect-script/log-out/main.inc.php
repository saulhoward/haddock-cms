<?php
/**
 * Redirect script the admin section.
 *
 * @copyright Clear Line Web Design, 2007-08-22
 */

$page_manager = PublicHTML_PageManager::get_instance();

$alm = Admin_LoginManager::get_instance();

$alm->log_out();

/*
 * The user should be taken to the home page.
 */

$page_manager->set_return_to_url(new HTMLTags_URL('/'));
?>
