<?php
/**
 * VideoLibrary_DatabaseHelper
 *
 * @copyright 2009-01-10, SANH
 */

class
	VideoLibrary_DatabaseHelper
{
	public static function
		get_external_video_data($id)
	{
		$dbh = DB::m();

		$id = mysql_real_escape_string($id);
                    
                $query = <<<SQL
SELECT
	hpi_video_library_external_videos.id AS id,
	hpi_video_library_external_videos.providers_internal_id AS providers_internal_id,
	hpi_video_library_external_videos.thumbnail_url AS thumbnail_url,
	hpi_video_library_external_video_providers.haddock_class_name AS haddock_class_name
FROM
        hpi_video_library_external_videos
LEFT JOIN 
	hpi_video_library_external_video_providers
ON
	hpi_video_library_external_videos.external_video_provider_id = hpi_video_library_external_video_providers.id
WHERE
	hpi_video_library_external_videos.id = $id          
SQL;
                    
                #echo $query; exit;
                    
                $result = mysql_query($query, $dbh);

		return mysql_fetch_assoc($result);

                //$news_items = array();
                    
                //while ($row = mysql_fetch_assoc($result)) {
                        //$news_items[] = $row;
                //}   
	}

	public static function
		get_external_videos_data(
			$limit
		)
	{
		$dbh = DB::m();

		$limit = mysql_real_escape_string($limit);
                    
                $query = <<<SQL
SELECT
	hpi_video_library_external_videos.id AS id,
	hpi_video_library_external_videos.providers_internal_id AS providers_internal_id,
	hpi_video_library_external_videos.thumbnail_url AS thumbnail_url,
	hpi_video_library_external_video_providers.haddock_class_name AS haddock_class_name
FROM
        hpi_video_library_external_videos
LEFT JOIN 
	hpi_video_library_external_video_providers
ON
	hpi_video_library_external_videos.external_video_provider_id = hpi_video_library_external_video_providers.id
LIMIT
	0, $limit
SQL;
                    
                //echo $query; exit;
                    
                $result = mysql_query($query, $dbh);

                $videos = array();
                    
                while ($row = mysql_fetch_assoc($result)) {
                        $videos[] = $row;
                }   
		//print_r($videos);exit;
		return $videos;
	}
}
?>
