<?php
/**
 * Database_ImagesHelper
 *
 * @copyright 2008-03-19, RFI
 */

class
	Database_ImagesHelper
{

	public static function
		get_img_src($image_id, $file_type = NULL)
	{
		if (
			($file_type)
			&&
			($file_type == 'image/jpeg')
		) {
			$src = '/hc-database-img-cache/' . $image_id . '.jpg';
		} else {

			$mysql_user_factory = Database_MySQLUserFactory::get_instance();
			$mysql_user = $mysql_user_factory->get_for_this_project();
			$database = $mysql_user->get_database();
			$images_table = $database->get_table('hc_database_images');
			$image_row = $images_table->get_row_by_id($image_id);
			$image_renderer = $image_row->get_renderer();

			$url = $image_renderer->get_html_url_in_public_images();
			$src = $url->get_file();
		}
		return $src;
	}
	
	public static function
		get_img($image_id)
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
			
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();
		
		$images_table = $database->get_table('hc_database_images');
		
		$image_row = $images_table->get_row_by_id($image_id);
		
		$image_renderer = $image_row->get_renderer();
		
		$img = $image_renderer->get_img_in_public_images();
		
		return $img;
	}
	
	public static function
		get_img_as_string($image_id)
	{
		#echo __METHOD__ . "\n";
		
		#echo "\$image_id: $image_id\n";
		
		$img = self::get_img($image_id);
		
		$str = $img->get_as_string();
		
		#echo "\$str: $str\n";
		
		return $str;
	}
	
	public static function
		render_img($image_id)
	{
		$img = self::get_img($image_id);
		
		echo $img->get_as_string();
	}
}
?>
