<?php
/**
 * VideoLibrary_SearchHelper
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_SearchHelper
{
	public static function
		get_external_videos_for_search_string(
                                $external_video_library_id,
                                $search_string,
                                $start,
                                $duration
		)
	{

                /*
                 *Prepare the string
                 */
                $search_string = strtolower($search_string);

                /*
                 * Search Names of the videos
                 */
                $videos = VideoLibrary_DatabaseHelper::
                        get_external_videos_by_searching_in_video_names(
                                $external_video_library_id,
                                $search_string,
                                $start,
                                $duration
                        );

                return $videos;
	}

	public static function
		get_external_videos_count_for_search_string(
                                $external_video_library_id,
                                $search_string
		)
	{

                /*
                 *Prepare the string
                 */
                $search_string = strtolower($search_string);

                /*
                 * Search Names of the videos
                 */
                $videos = VideoLibrary_DatabaseHelper::
                        get_external_videos_by_searching_in_video_names_count(
                                $external_video_library_id,
                                $search_string
                        );

                return $videos;
	}
}
?>
