<?php
/**
 * VideoLibrary_ExternalVideoLibraryPage
 * 
 * @copyright Clear Line Web Design, 2007-12-10
 *
 * ExternalVideoLibraryPage for the VideoLibrary.com site
 */
abstract class
VideoLibrary_ExternalVideoLibraryPage
extends
VideoLibrary_HTMLPage
{
	private $external_video_library_id;

	private function
		set_external_video_library_id(
			$external_video_library_id
		)
	{
		$this->external_video_library_id 
			= $external_video_library_id;
	}

	private function
		set_external_video_library_id_from_get()
	{ 
		if (isset($_GET['external_video_library_id'])) {
			$this->set_external_video_library_id(
				$_GET['external_video_library_id']
			);
                }
	}
	
        protected function
                get_external_video_library_id()
        {
                if (isset($this->external_video_library_id)) {
                        return $this->external_video_library_id;
                }
                elseif (
                        isset($_GET['external_video_library_id'])
                ) {
                        $this->set_external_video_library_id_from_get();
                        return $this->get_external_video_library_id();
                }
                else {
			$this->set_external_video_library_id(
				VideoLibrary_ExternalLibraryHelper
				::get_default_external_library_id()
			);
                        return $this->get_external_video_library_id();
			//throw new VideoGallery_ExternalVideoLibraryNotSetException();
                }
        }
}
?>
