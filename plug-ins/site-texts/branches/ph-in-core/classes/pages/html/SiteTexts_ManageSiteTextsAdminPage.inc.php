<?php
/**
 * SiteTexts_ManageSiteTextsAdminPage
 * 
 * This currently only edits files you've already created
 * on the command line.
 * It also takes the filter function (first line of a site-text file)
 * as read, there's no way to change it
 *
 * @copyright 2009-13-06 SANH
 */

class
SiteTexts_ManageSiteTextsAdminPage
extends
Admin_RestrictedHTMLPage
{
	protected function
		get_body_div_header_heading_content()
	{
		return 'Site Texts';
	}

	public function
		content()
	{
		/*
		 * See if we edited anything
		 */
		if (
			(isset($_GET['edited']))
			&&
			(isset($_GET['page']))
			&&
			(isset($_GET['section']))
		) {
$page = $_GET['page'];
$section = $_GET['section'];
			echo <<<HTML
<div id="last-action-div">
<p>Edited <em>$section</em> section on <em>$page</em> page!</p>
</div>
<div class="clear">&nbsp;</div>
HTML;

		}
		echo '<h2>Edit the Site Texts</h2>';
		/*
		 *First the table to select a particular page and section
		 */
		echo SiteTexts_AdminHelper::get_manage_site_texts_html_table();

		/*
		 *Then the edit boxes for each language
		 */
		if (
			(isset($_GET['page']))
			&&
			(isset($_GET['section']))
		) {
			echo SiteTexts_AdminHelper::
				get_edit_forms_for_section($_GET['page'], $_GET['section']);
		}
	}
}
?>
