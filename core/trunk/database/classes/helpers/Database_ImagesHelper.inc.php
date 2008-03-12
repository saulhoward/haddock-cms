<?php
class
	Database_ImagesHelper
{
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
		render_img($image_id)
	{
		$img = self::get_img($image_id);
		
		echo $img->get_as_string();
	}
}
?>