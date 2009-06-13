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
		echo $this->get_last_action_div()->get_as_string();
		echo '<div class="clear">&nbsp;</div>';
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

	private function
		get_last_action_div()
	{
		$div = new HTMLTags_Div();
		$div->set_attribute_str('class', 'last-action-div');
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
			$p = new HTMLTags_P();

			if (isset($_GET['error'])) {
				$div->append('<p><em>Please contact your Website Administrator</em></p>');
				$p->append(urldecode($_GET['error']));
				$div->set_attribute_str('id', 'error');
			} else {

				$p->append(
					'Edited <em>'
					. $_GET['section']
					. '</em> section on <em>'
					. $_GET['page']
					. '</em> page!'
				);
			}
			$div->append($p);
		}
		return $div;
	}
}
?>
