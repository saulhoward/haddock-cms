<?php
/*
 * Start Page Widget Class
 * 2008-10-11, SANH
 * Widgets have content HTML and a Title string,
 * exposed through the two abstract classes
 *
 * Widgets are used by Admin_StartPage
 */
abstract class
	Admin_StartPageWidget
{
	abstract protected function
		get_widget_content();

	abstract protected function
		get_widget_title();

	public function
		get_widget_div()
	{
		$div = new HTMLTags_Div();
		$div->set_attribute_str('class', 'StartPageWidget');

		$heading = new HTMLTags_Heading(3, $this->get_widget_title());
		$div->append($heading);

		$div->append($this->get_widget_content());

		return $div;
	}
}
?>
