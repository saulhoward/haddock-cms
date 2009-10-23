<?php
/**
 * VideoLibrary_HomePage
 * 
 * @copyright Clear Line Web Design, 2007-12-10
 */

/**
 * Home Page for the VideoLibrary.com site
 */
class
VideoLibrary_HomePage
extends
VideoLibrary_ThumbnailsPage
{
	protected function
		set_videos()
	{
		$videos = VideoLibrary_DatabaseHelper::get_external_videos(
			$this->get_external_video_library_id()
		);

		$this->videos = $videos;
	
	}
}
?>
