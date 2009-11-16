<?php
/**
 * VideoLibrary_ExternalVideosFrameGrabbingQueueHelper
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_ExternalVideosFrameGrabbingQueueHelper
{
	public static function
                get_thumbnail_img_str_for_external_video_id($id)
        {

                $video_data = VideoLibrary_DatabaseHelper::
                        get_external_video_data($id);
                return VideoLibrary_DisplayHelper::
                        get_thumbnail_img($video_data['thumbnail_url'])->get_as_string();
        }

	public static function
                get_video_name_for_external_video_id($id)
        {
                $video_data = VideoLibrary_DatabaseHelper::
                        get_external_video_data($id);
                return $video_data['name'];
        }
}
?>
