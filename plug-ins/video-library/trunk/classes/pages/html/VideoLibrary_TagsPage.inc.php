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
		$content_div->append(
			VideoLibrary_DisplayHelper::
				get_tags_page_tags_div(
					$this->get_primary_tags(),
					$this->get_external_video_library_id()
				)
			);

		return $content_div;
	}

	protected function
		get_libraries_navigation_div_base_url()
	{
		return  VideoLibrary_URLHelper
			::get_tags_page_url();
	}




}
?>
