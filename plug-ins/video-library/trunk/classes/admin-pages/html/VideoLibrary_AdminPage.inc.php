<?php
/**
 * VideoLibrary_AdminPage.inc.php
 * @copyright 2010-06-18 SANH
 */

abstract class
VideoLibrary_AdminPage
extends
Admin_RestrictedHTMLPage
{
	public function
		content()
	{
// print_r('well?');exit;
		echo $this->get_last_action_div()->get_as_string();
		echo '<div class="clear">&nbsp;</div>';
        echo $this->get_admin_content_div()->get_as_string();
    }
	
	public abstract function
		get_admin_content_div();

	protected function
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
			(isset($_GET['message']))
		) {
			$p = new HTMLTags_P();

			if (isset($_GET['error'])) {
				$div->append('<p><em>Please contact your Website Administrator</em></p>');
				$p->append(urldecode($_GET['error']));
				$div->set_attribute_str('id', 'error');
			} else {
				$p->append(
                    $_GET['message']
				);
			}
			$div->append($p);
		}
		return $div;
	}
}
?>
