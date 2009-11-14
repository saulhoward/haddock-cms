<?php
/**
 * VideoLibrary_TagsPage
 * 
 * @copyright Clear Line Web Design, 2007-12-10
 *
 * Search Page for the VideoLibrary.com site
 */
class
VideoLibrary_TagsPage
extends
VideoLibrary_ExternalVideoLibraryPage
{
	public function
		content()
	{
		$content_div = $this->get_content_div();
		echo $content_div->get_as_string();
	}

	private function
		get_content_div()
	{
		$content_div = new HTMLTags_Div();
		$content_div->set_attribute_str('class', 'content');
		$content_div->set_attribute_str('id', 'TagsPage');

		//$content_div->append($this->get_advert_div());
		$content_div->append($this->get_tags_navigation_div());

		return $content_div;
	}



}
?>