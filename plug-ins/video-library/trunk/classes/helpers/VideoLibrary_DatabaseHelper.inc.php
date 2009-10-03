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

		$query = '';
		$query .= self::get_select_sql_for_videos();

		$query .= <<<SQL

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
		get_external_videos(
			$external_video_library_id,
			$limit = NULL
		)
	{
		//print_r($external_video_library_id);exit;
		//print_r($external_video_provider_id);exit;

		$dbh = DB::m();
		$external_video_library_id 
			= mysql_real_escape_string($external_video_library_id);

		$query = '';
		$query .= self::get_select_sql_for_videos();
		$query .= <<<SQL
FROM
	hpi_video_library_external_videos,
	hpi_video_library_external_video_providers,
	hpi_video_library_external_video_libraries,
	hpi_video_library_ext_vid_to_ext_vid_lib_links
WHERE
	hpi_video_library_external_video_libraries.id 
	= hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id
AND
	hpi_video_library_external_videos.id 
	= hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id
AND
	hpi_video_library_external_video_libraries.id = '$external_video_library_id'
AND
	hpi_video_library_external_videos.external_video_provider_id 
	= hpi_video_library_external_video_providers.id

SQL;

		if ($limit != NULL) {
			$limit = mysql_real_escape_string($limit);
			$query .= <<<SQL

LIMIT
	0, $limit
SQL;

		}
		//echo $query; exit;

		$result = mysql_query($query, $dbh);

		$videos = array();

		while ($row = mysql_fetch_assoc($result)) {
			$videos[] = $row;
		}   
		//print_r($videos);exit;
		return $videos;
	}

	public static function
		get_external_videos_for_provider_id(
			$external_video_library_id,
			$external_video_provider_id,
			$limit = NULL
		)
	{
		//print_r($external_video_library_id);exit;
		//print_r($external_video_provider_id);exit;

		$dbh = DB::m();
		$external_video_library_id 
			= mysql_real_escape_string($external_video_library_id);
		$external_video_provider_id 
			= mysql_real_escape_string($external_video_provider_id);

		$query = '';
		$query .= self::get_select_sql_for_videos();
		$query .= <<<SQL
FROM
	hpi_video_library_external_videos,
	hpi_video_library_external_video_providers,
	hpi_video_library_external_video_libraries,
	hpi_video_library_ext_vid_to_ext_vid_lib_links
WHERE
	hpi_video_library_external_video_libraries.id 
	= hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id
AND
	hpi_video_library_external_videos.id 
	= hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id
AND
	hpi_video_library_external_video_libraries.id = '$external_video_library_id'
AND
	hpi_video_library_external_videos.external_video_provider_id 
	= hpi_video_library_external_video_providers.id
AND
	hpi_video_library_external_video_providers.id = '$external_video_provider_id'
SQL;

		if ($limit != NULL) {
			$limit = mysql_real_escape_string($limit);
			$query .= <<<SQL

LIMIT
	0, $limit
SQL;

		}
		//echo $query; exit;

		$result = mysql_query($query, $dbh);

		$videos = array();

		while ($row = mysql_fetch_assoc($result)) {
			$videos[] = $row;
		}   
		//print_r($videos);exit;
		return $videos;
	}
	public static function
		get_external_video_libraries()
	{
		$dbh = DB::m();

		//$limit = mysql_real_escape_string($limit);

		$query = <<<SQL
SELECT
	*
FROM
	hpi_video_library_external_video_libraries
WHERE
status = 'display'
ORDER BY
sort_order

SQL;

		//echo $query; exit;

		$result = mysql_query($query, $dbh);

		$libraries = array();

		while ($row = mysql_fetch_assoc($result)) {
			$libraries[] = $row;
		}   
		//print_r($libraries);exit;
		return $libraries;
	}
	public static function
		get_tags_for_external_library_id(
			$library_id,
			$principal = FALSE
		)
	{
		$dbh = DB::m();

		$library_id = mysql_real_escape_string($library_id);

		$query = <<<SQL
SELECT * FROM `hpi_video_library_tags`

WHERE EXISTS ( 
	SELECT * FROM 
	hpi_video_library_tags_to_ext_vid_links
	WHERE 
	hpi_video_library_tags.id = hpi_video_library_tags_to_ext_vid_links.tag_id
	AND EXISTS (
		SELECT * FROM 
		hpi_video_library_external_videos
		WHERE 
		hpi_video_library_tags_to_ext_vid_links.external_video_id = hpi_video_library_external_videos.id
		AND
		hpi_video_library_tags.id = hpi_video_library_tags_to_ext_vid_links.tag_id
		AND EXISTS (
			SELECT * FROM 
			hpi_video_library_ext_vid_to_ext_vid_lib_links
			WHERE
			hpi_video_library_external_videos.id = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id
			AND EXISTS (
				SELECT * FROM
				hpi_video_library_external_video_libraries
				WHERE
				hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id = hpi_video_library_external_video_libraries.id
				AND EXISTS (
					SELECT * FROM
					hpi_video_library_tags_to_ext_vid_links
					WHERE
					hpi_video_library_external_video_libraries.id = $library_id
				)
			)
		)
	)
)

SQL;

		if ($principal) {
			$query .= <<<SQL
WHERE
	principal = 'yes'

SQL;

		}

		//echo $query; exit;

		$result = mysql_query($query, $dbh);

		$tags = array();

		while ($row = mysql_fetch_assoc($result)) {
			$tags[] = $row;
		}   
		//print_r($tags);exit;
		return $tags;
	}
	public static function
		get_tags(
			$principal = FALSE
		)
	{
		$dbh = DB::m();

		//$limit = mysql_real_escape_string($limit);

		$query = <<<SQL
SELECT
	*
FROM
	hpi_video_library_tags

SQL;

		if ($principal) {
			$query .= <<<SQL
WHERE
	principal = 'yes'

SQL;

		}

		//echo $query; exit;

		$result = mysql_query($query, $dbh);

		$tags = array();

		while ($row = mysql_fetch_assoc($result)) {
			$tags[] = $row;
		}   
		//print_r($tags);exit;
		return $tags;
	}

	public static function
		get_external_video_providers_for_external_video_library_id(
			$library_id
		)
	{
		$dbh = DB::m();

		$library_id = mysql_real_escape_string($library_id);
                    
                $query = <<<SQL
SELECT * FROM `hpi_video_library_external_video_providers`

WHERE EXISTS ( 
	SELECT * FROM 
	hpi_video_library_external_videos
	WHERE 
	hpi_video_library_external_videos.external_video_provider_id = hpi_video_library_external_video_providers.id
	AND EXISTS (
		SELECT * FROM 
		hpi_video_library_ext_vid_to_ext_vid_lib_links
		WHERE
		hpi_video_library_external_videos.id = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id
		AND EXISTS (
			SELECT * FROM
			hpi_video_library_external_video_libraries
			WHERE
			hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id = hpi_video_library_external_video_libraries.id
			AND EXISTS (
				SELECT * FROM
				hpi_video_library_tags_to_ext_vid_links
				WHERE
				hpi_video_library_external_video_libraries.id = $library_id
			)
		)
	)
)

SQL;
                    
                //echo $query; exit;
                    
                $result = mysql_query($query, $dbh);

                $providers = array();
                    
                while ($row = mysql_fetch_assoc($result)) {
                        $providers[] = $row;
                }   
		//print_r($videos);exit;
		return $providers;
	}
	public static function
		get_external_video_providers()
	{
		$dbh = DB::m();

		//$limit = mysql_real_escape_string($limit);
                    
                $query = <<<SQL
SELECT
	*
FROM
	hpi_video_library_external_video_providers
SQL;
                    
                //echo $query; exit;
                    
                $result = mysql_query($query, $dbh);

                $providers = array();
                    
                while ($row = mysql_fetch_assoc($result)) {
                        $providers[] = $row;
                }   
		//print_r($videos);exit;
		return $providers;
	}

	public static function
		get_external_videos_for_tag_ids(
			$external_video_library_id,
			$tag_ids,
			$ignore_video_id = NULL,
			$limit = NULL
		)
	{
		$dbh = DB::m();
		$external_video_library_id = mysql_real_escape_string($external_video_library_id);

		$query = '';
		$query .= self::get_select_sql_for_videos();

		$query .= <<<SQL

FROM
	hpi_video_library_external_videos,
	hpi_video_library_external_video_providers,
	hpi_video_library_tags,
	hpi_video_library_tags_to_ext_vid_links,
	hpi_video_library_external_video_libraries,
	hpi_video_library_ext_vid_to_ext_vid_lib_links
WHERE
	hpi_video_library_external_video_libraries.id 
	= hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id
AND
	hpi_video_library_external_videos.id 
	= hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id
AND
	hpi_video_library_external_video_libraries.id = '$external_video_library_id'
AND
	hpi_video_library_external_videos.external_video_provider_id 
	= hpi_video_library_external_video_providers.id
	AND
	hpi_video_library_external_videos.id = hpi_video_library_tags_to_ext_vid_links.external_video_id
	AND
	hpi_video_library_tags.id = hpi_video_library_tags_to_ext_vid_links.tag_id
	AND
	hpi_video_library_external_videos.status = 'display'
	AND

SQL;

		$query .= <<<SQL
(

SQL;


		$i = 1;
		foreach ($tag_ids as $tag_id) {
			$i++;
			$tag_id = mysql_real_escape_string($tag_id);
			if ($i % 2){
				$query .= <<<SQL
	OR

SQL;

			}
			$query .= <<<SQL
	hpi_video_library_tags.id = '$tag_id'

SQL;

		}
		$query .= <<<SQL
)

SQL;


		if ($ignore_video_id > 0) {
			$ignore_video_id = mysql_real_escape_string($ignore_video_id);
			$query .= <<<SQL
	AND
	hpi_video_library_external_videos.id <> $ignore_video_id

SQL;

		}

		$query .= <<<SQL
ORDER BY
	hpi_video_library_external_videos.id
SQL;

                //echo $query; exit;
                    
                $result = mysql_query($query, $dbh);

                $tags = array();
                    
                while ($row = mysql_fetch_assoc($result)) {
                        $tags[] = $row;
                }   
		//print_r($tags);exit;
		return $tags;
	

	}

	public static function
		get_from_sql_for_videos() 
	{
		return <<<SQL
FROM
	hpi_video_library_external_videos,
	hpi_video_library_external_video_providers

SQL;

	}

	public static function
		get_select_sql_for_videos() 
	{
		return <<<SQL
SELECT
	hpi_video_library_external_videos.id AS id,
	hpi_video_library_external_videos.name AS name,
	hpi_video_library_external_videos.providers_internal_id AS providers_internal_id,
	hpi_video_library_external_videos.thumbnail_url AS thumbnail_url,
	hpi_video_library_external_video_providers.haddock_class_name AS haddock_class_name

SQL;

	}


}
?>
