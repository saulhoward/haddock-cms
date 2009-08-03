<?php
class PhotoGallery_GalleryHelper
{
	public static function
		get_gallery_div()
	{
		return self::get_all_photos_gallery_div();
	}

	public static function
		get_all_photos_gallery_div()
	{
		$images = self::get_all_photographs();
		$content_div = self::get_content_div();
		$content_div->append(self::get_gallery_div_for_images($images));
		return $content_div;
	}

	public static function
		get_album_gallery_div(
			$album_id,
			$description = FALSE
		)
	{
		$images = self::get_all_photographs_for_album_id($album_id);
		$content_div = self::get_content_div();
		if ($description) {
			$content_div->append(self::get_album_description_div($album_id));
		}
		$content_div->append(self::get_gallery_div_for_images($images));
		return $content_div;
	}

	public static function
		get_album_description_div($album_id)
	{
		$album_info = self::get_information_for_album_id($album_id);
		$div = new HTMLTags_Div();
		$div->set_attribute_str('id', 'album-details');
		$div->append('<h2>' . $album_info['title'] . '</h2>');
		//$div->append('<p class="description">' . $album_info['description'] . '</p>');
		return $div;
	}
		
	public static function
		get_content_div()
	{
		$content_div = new HTMLTags_Div();

		$content_div->set_attribute_str('class', 'content');
		$content_div->set_attribute_str('id', 'GalleryPage');
		return $content_div;
	}


	public static function
		get_gallery_div_for_images($images)
	{
		$div = new HTMLTags_Div();
		$div->set_attribute_str('class', 'gallery_div');

		$main_image_div = new HTMLTags_Div();
		$main_image_div->set_attribute_str('id', 'main_image');
		$div->append($main_image_div);

		$ul = new HTMLTags_UL();
		$ul->set_attribute_str('class', 'gallery_demo_unstyled');

		$first = TRUE;

		foreach ($images as $image)
		{
			$li = new HTMLTags_LI();
			if ($first)
			{
				$li->set_attribute_str('class', 'active');
				$first = FALSE;
			}
			$li->append($image->get_image_img());
			$ul->append($li);
		}
		$div->append($ul);

		return $div;
	}

	public static function
		get_widget_content()
	{
		$latest_photo = self::get_latest_photograph();
		$div = new HTMLTags_Div();

		if (isset($latest_photo))
		{
			$img = $latest_photo->get_image_img();
			$img->set_attribute_str('class', 'center');
			$img->set_attribute_str('width', '300px');
			$div->append($img);
			$p = new HTMLTags_P(
				'"' 
				. $latest_photo->get_name() 
				. '" is the latest photo in the gallery.'
			);
		}
		else
		{
			$p = new HTMLTags_P(
				'There are no photos in the gallery yet.'
			);
		}

		$div->append($p);
		return $div;
	}


	/* DB Functions */

	public static function
		get_latest_photograph()
	{
		$dbh = DB::m();

		//                $product_id = mysql_real_escape_string($product_id, $dbh);

		$query = <<<SQL
SELECT
	*
	FROM
	hpi_photo_gallery_photographs
	ORDER BY
	hpi_photo_gallery_photographs.added DESC
	LIMIT 0, 1
SQL;

		#echo $query; exit;

		$result = mysql_query($query, $dbh);

		while ($data = mysql_fetch_assoc($result)) 
		{
			//                        print_r($row);exit;
			$event = new PhotoGallery_Photograph($data['id']);
			$event->set_name($data['name']);
			$event->set_added($data['added']);
			$event->set_description($data['description']);
			$event->set_image_url($data['image_url']);
			$events[] = $event;
		}

		return $event;
	}

	public static function
		get_all_photographs()
	{
		$dbh = DB::m();

		//                $product_id = mysql_real_escape_string($product_id, $dbh);

		$query = <<<SQL
SELECT
	*
	FROM
	hpi_photo_gallery_photographs
	ORDER BY
	hpi_photo_gallery_photographs.sort_order ASC
SQL;

		#echo $query; exit;

		$result = mysql_query($query, $dbh);

		$events = array();
		$datas = array();

		while ($row = mysql_fetch_assoc($result)) 
		{
			$datas[] = $row;
		}
		foreach ($datas as $data)
		{
			//                        print_r($row);exit;
			$event = new PhotoGallery_Photograph($data['id']);
			$event->set_name($data['name']);
			$event->set_added($data['added']);
			$event->set_description($data['description']);
			$event->set_image_url($data['image_url']);
			$events[] = $event;
		}

		return $events;
	}

	public static function
		get_all_photographs_for_album_id($album_id)
	{
		$dbh = DB::m();

		$album_id = mysql_real_escape_string($album_id, $dbh);

		$query = <<<SQL
SELECT
	*
	FROM
	hpi_photo_gallery_photographs
	WHERE
	album_id = $album_id
	ORDER BY
	hpi_photo_gallery_photographs.sort_order ASC
SQL;

		#echo $query; exit;

		$result = mysql_query($query, $dbh);

		$events = array();
		$datas = array();

		while ($row = mysql_fetch_assoc($result)) 
		{
			$datas[] = $row;
		}
		foreach ($datas as $data)
		{
			//                        print_r($row);exit;
			$event = new PhotoGallery_Photograph($data['id']);
			$event->set_name($data['name']);
			$event->set_added($data['added']);
			$event->set_description($data['description']);
			$event->set_image_url($data['image_url']);
			$events[] = $event;
		}

		return $events;
	}

	public static function
		get_information_for_album_id($album_id)
	{
		$dbh = DB::m();

		$album_id = mysql_real_escape_string($album_id, $dbh);

		$query = <<<SQL
SELECT
	*
	FROM
	hpi_photo_gallery_albums
	WHERE
	id = $album_id
SQL;

		//echo $query; exit;

		$result = mysql_query($query, $dbh);

		$datas = array();

		while ($row = mysql_fetch_assoc($result)) 
		{
			$datas[] = $row;
		}
		//print_r($datas);exit;
		return $datas[0];
	}
}
?>
