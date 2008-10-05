<?php
class PhotoGallery_GalleryHelper
{
	public static function
		get_gallery_div()
	{
		$content_div = new HTMLTags_Div();

		$content_div->set_attribute_str('class', 'content');
		$content_div->set_attribute_str('id', 'GalleryPage');

		$div = new HTMLTags_Div();
		$div->set_attribute_str('class', 'gallery_div');

		$main_image_div = new HTMLTags_Div();
		$main_image_div->set_attribute_str('id', 'main_image');
		$div->append($main_image_div);

		$ul = new HTMLTags_UL();
		$ul->set_attribute_str('class', 'gallery_demo_unstyled');

		$first = TRUE;

		foreach (self::get_all_photographs() as $image)
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

		$content_div->append_tag_to_content($div);
		return $content_div;
	}


	/* DB Functions */

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
	hpi_photo_gallery_photographs.added DESC
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
}
?>
