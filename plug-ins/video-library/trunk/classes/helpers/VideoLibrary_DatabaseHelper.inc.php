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
        hpi_video_library_external_videos,
        hpi_video_library_external_video_libraries,
        hpi_video_library_ext_vid_to_ext_vid_lib_links,
        hpi_video_library_external_video_providers
WHERE
        hpi_video_library_external_videos.external_video_provider_id = hpi_video_library_external_video_providers
.id
AND
        hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id = hpi_video_library_external_videos.id
AND
        hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id = hpi_video_library_external_video_libraries.id
AND
        hpi_video_library_external_videos.id = $id

SQL;

		#echo $query; exit;

		$result = mysql_query($query, $dbh);

		$video_data = mysql_fetch_assoc($result);
		$video_data['tags'] 
			= self::get_tags_for_external_video_id($video_data['id']);
		//print_r($video_data);exit;
		return $video_data;
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
		get_external_video_libraries_for_ids(
			$library_ids,
			$ignore_status = FALSE
		)
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
AND

SQL;

		$i = 0;
		foreach ($library_ids as $library_id) {
			$library_id = mysql_real_escape_string($library_id);
			if ($i != 0) {

				$query .= <<<SQL
OR

SQL;

			}
			$i++;
			$query .= <<<SQL
id = $library_id

SQL;

		}
		$query .= <<<SQL

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
		get_external_video_libraries(
			$ignore_status = FALSE
		)
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
AND
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
		get_tags_for_external_video_id(
			$video_id,
			$principal = FALSE
		)
	{
		$dbh = DB::m();

		$video_id = mysql_real_escape_string($video_id);

		$query = <<<SQL

SELECT 
	hpi_video_library_tags.id as id,
	hpi_video_library_tags.tag as tag,
	hpi_video_library_tags.principal as principal
FROM 
	`hpi_video_library_tags`,
	hpi_video_library_tags_to_ext_vid_links,
	hpi_video_library_external_videos
WHERE 
	hpi_video_library_tags.id = hpi_video_library_tags_to_ext_vid_links.tag_id
AND 
	hpi_video_library_external_videos.id 
	= hpi_video_library_tags_to_ext_vid_links.external_video_id
AND
	hpi_video_library_external_videos.id = $video_id

SQL;

		if ($principal) {
			$query .= <<<SQL
AND
	hpi_video_library_tags.principal = 'yes'

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
		get_tags_for_tag_ids(
			$tag_ids
		)
	{
		$dbh = DB::m();

		//$limit = mysql_real_escape_string($limit);

		$query = <<<SQL
SELECT
	*
FROM
	hpi_video_library_tags
WHERE

SQL;

		$i = 0;
		foreach ($tag_ids as $tag_id) {
			$tag_id = mysql_real_escape_string($tag_id);
			if ($i != 0){
				$query .= <<<SQL
	OR

SQL;

			}
			$i++;
			$query .= <<<SQL
	hpi_video_library_tags.id = '$tag_id'

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
		get_external_video_provider_for_id($id)
	{
		$dbh = DB::m();

		$id = mysql_real_escape_string($id);
                    
                $query = <<<SQL
SELECT
	*
FROM
	hpi_video_library_external_video_providers
WHERE
	id = '$id'
SQL;
                    
                //echo $query; exit;
                    
                $result = mysql_query($query, $dbh);

		$provider = mysql_fetch_assoc($result);
		//print_r($videos);exit;
		return $provider;
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
		get_related_videos_div_for_external_video_data(
			$external_video_library_id,
			$video_data,
			$limit = NULL
		)
	{
		/*
		 * TODO:
		 *        Surely a better way of extracting this data?
		 */
		$tag_ids = array();
		foreach ($video_data['tags'] as $tag) {
			$tag_ids[] = $tag['id'];
		}

		/******
		 * TODO:
		 *        This should
		 *        1) Get vids with all matching tags (DONE)
		 *        2) Get vids with some matching tags
		 *        3) Get any vids
		 *
		 *        Until it's got the limit
		 * 	  Also gonna need support for getting infinte related vids using  an
		 *	  offset and limit
		 */
		return self::get_external_videos_for_tag_ids(
			$external_video_library_id,
			$tag_ids,
			$video_data['id'],
			$limit
		);
	}

	public static function
		get_all_external_videos_for_tag_ids_on_admin_page(
			$tag_ids,
			$ignore_video_id = NULL,
			$limit = NULL
		)
	{
		$dbh = DB::m();


		$query = <<<SQL
SELECT
	hpi_video_library_external_videos.id AS id,
	hpi_video_library_external_videos.name AS name,
	hpi_video_library_external_videos.thumbnail_url AS thumbnail_url,
	hpi_video_library_external_videos.length_seconds AS length_seconds

FROM
	hpi_video_library_external_videos,
	hpi_video_library_tags,
	hpi_video_library_tags_to_ext_vid_links
WHERE
	hpi_video_library_external_videos.id = hpi_video_library_tags_to_ext_vid_links.external_video_id
	AND
	hpi_video_library_tags.id = hpi_video_library_tags_to_ext_vid_links.tag_id

SQL;

		if (count($tag_ids) > 0) {
			$query .= <<<SQL
	AND
(

SQL;


			$i = 0;
			foreach ($tag_ids as $tag_id) {
				$tag_id = mysql_real_escape_string($tag_id);
				if ($i != 0){
					$query .= <<<SQL
	OR

SQL;

				}
				$i++;
				$query .= <<<SQL
	hpi_video_library_tags.id = '$tag_id'

SQL;

			}
			$query .= <<<SQL
)

SQL;
		}


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

SQL;

		if (count($tag_ids) > 0) {
			$query .= <<<SQL
	AND
(

SQL;


			$i = 0;
			foreach ($tag_ids as $tag_id) {
				$tag_id = mysql_real_escape_string($tag_id);
				if ($i != 0){
					$query .= <<<SQL
	OR

SQL;

				}
				$i++;
				$query .= <<<SQL
	hpi_video_library_tags.id = '$tag_id'

SQL;

			}
			$query .= <<<SQL
)

SQL;
		}


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
		get_enum_values(
			$table_name,
			$enum_name
		)
	{
		$dbh = DB::m();
		$table_name = mysql_real_escape_string($table_name);
		$enum_name = mysql_real_escape_string($enum_name);

		$query = <<<SQL
SHOW COLUMNS 
FROM 
$table_name LIKE '$enum_name'

SQL;
                //echo $query; exit;
                    
                $result = mysql_query($query, $dbh);

		if(mysql_num_rows($result)>0){
			$row=mysql_fetch_row($result);
			$options=explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2",$row[1]));
		}

		return $options;
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
	hpi_video_library_external_videos.thumbnail_url AS thumbnail_url,
	hpi_video_library_external_videos.length_seconds AS length_seconds,
	hpi_video_library_external_videos.providers_internal_id AS providers_internal_id,
	hpi_video_library_external_video_libraries.id AS external_video_library_id,
	hpi_video_library_external_video_providers.haddock_class_name AS haddock_class_name

SQL;

	}

	public static function
		get_external_video_provider_name_for_id($id)
	{
		$dbh = DB::m();

		$id = mysql_real_escape_string($id);

		$query = <<<SQL
SELECT
	name
FROM
	hpi_video_library_external_video_providers
WHERE
id = $id

SQL;

		//echo $query; exit;

		$result = mysql_query($query, $dbh);

		$row = mysql_fetch_assoc($result);
		return $row['name'];

		//$libraries = array();
		//while ($row = mysql_fetch_assoc($result)) {
			//$libraries[] = $row;
		//}   
		////print_r($libraries);exit;
		//return $libraries;
	}

	public static function
		get_tag_id_for_tag_string($tag)
	{
		$dbh = DB::m();

		$tag = mysql_real_escape_string($tag);

		$query = <<<SQL
SELECT
	hpi_video_library_tags.id
FROM
	hpi_video_library_tags
WHERE
hpi_video_library_tags.tag = '$tag'

SQL;

		//echo $query; exit;

		$result = mysql_query($query, $dbh);

		$row = mysql_fetch_assoc($result);
		return $row['id'];

	}

	public static function
		get_external_video_library_id_for_external_video_id($id)
	{
		$dbh = DB::m();

		$id = mysql_real_escape_string($id);

		$query = <<<SQL
SELECT
	hpi_video_library_external_video_libraries.id
FROM
	hpi_video_library_external_videos,
hpi_video_library_external_video_libraries,
hpi_video_library_ext_vid_to_ext_vid_lib_links
WHERE
hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id = $id
AND
hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id = hpi_video_library_external_video_libraries.id

SQL;

		//echo $query; exit;

		$result = mysql_query($query, $dbh);

		$row = mysql_fetch_assoc($result);
		return $row['id'];

	}
	public static function
		get_external_video_library_name_for_external_video_id($id)
	{
		$dbh = DB::m();

		$id = mysql_real_escape_string($id);

		$query = <<<SQL
SELECT
	hpi_video_library_external_video_libraries.name
FROM
	hpi_video_library_external_videos,
hpi_video_library_external_video_libraries,
hpi_video_library_ext_vid_to_ext_vid_lib_links
WHERE
hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id = $id
AND
hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id = hpi_video_library_external_video_libraries.id

SQL;

		//echo $query; exit;

		$result = mysql_query($query, $dbh);

		$row = mysql_fetch_assoc($result);
		return $row['name'];

	}

	public static function
		delete_orphaned_tags($include_principal_tags = FALSE)
	{
		$dbh = DB::m();
		$query = <<<SQL
DELETE FROM
    hpi_video_library_tags
WHERE
    hpi_video_library_tags.id
NOT IN (
    SELECT DISTINCT (
	hpi_video_library_tags_to_ext_vid_links.tag_id
    )
    FROM
    hpi_video_library_tags_to_ext_vid_links
)

SQL;

		if ($include_principal_tags == FALSE) {
			$query .= <<<SQL
AND
	hpi_video_library_tags.principal = 'no'

SQL;

		}

		return mysql_query($query, $dbh);
	}

        public function
                get_external_videos_count_for_tag_id($id)
        {
		$dbh = DB::m();
		$id = mysql_real_escape_string($id);
                $query = <<<SQL
SELECT
    count(distinct(hpi_video_library_external_videos.id)) AS 'video_count'
FROM
    hpi_video_library_external_videos,
    hpi_video_library_tags,
    hpi_video_library_tags_to_ext_vid_links
WHERE
    hpi_video_library_tags_to_ext_vid_links.external_video_id = hpi_video_library_external_videos.id
    AND
    hpi_video_library_tags_to_ext_vid_links.tag_id = hpi_video_library_tags.id
    AND
    hpi_video_library_tags.id = '$id' 
GROUP BY
    hpi_video_library_tags.id

SQL;

//print_r($query);exit;

		$result = mysql_query($query, $dbh);
		$row = mysql_fetch_assoc($result);
		if ( $row['video_count'] == '' ) $row['video_count'] = 0;
		return $row['video_count'];
        }

        public function
                get_tags_with_counts(
                        $order_by = 'product_count',
                        $direction = 'DESC'
                )
        {
                $query = <<<SQL
SELECT
    count(distinct(hpi_shop_products.id)) AS 'product_count',
    hpi_shop_product_tags.*
FROM
    hpi_shop_products,
    hpi_shop_product_tags,
    hpi_shop_product_tag_links
WHERE
    hpi_shop_product_tag_links.product_id = hpi_shop_products.id
    AND
    hpi_shop_product_tag_links.product_tag_id = hpi_shop_product_tags.id
GROUP BY
    hpi_shop_product_tags.id
ORDER BY
    $order_by $direction
SQL;

                #$tags_table = $this->get_element();

                return $this->get_rows_for_select($query);      
        }

}
?>
