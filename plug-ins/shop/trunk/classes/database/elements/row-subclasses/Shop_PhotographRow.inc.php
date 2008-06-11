<?php
/**
 * Shop_PhotographRow
 *
 * @copyright Clear Line Web Design, 2007-03-05
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Row.inc.php';

class
	Shop_PhotographRow
extends
    Database_Row
{
	private $tags;
	
	public function 
		get_name()
	{
		return $this->get('name');
	}
        
	public function 
		get_added()
	{
		return $this->get('added');
	}
        
	public function 
		set_name($name)
	{
		$this->set_name('$name');
	}

	public function 
		get_full_size_image_id()
	{
		return $this->get('full_size_image_id');
	}
	
	public function 
		get_full_size_image()
	{
		$database = $this->get_database();
		
		#$images_table = $database->get_table('hpi_shop_images');
		$images_table = $database->get_table('hc_database_images');
        
		$full_size_image_id = $this->get_full_size_image_id();
		
		return $images_table->get_row_by_id($full_size_image_id);
	}

	public function 
		get_medium_size_image_id()
	{
		return $this->get('medium_size_image_id');
	}
	
	public function 
		get_medium_size_image()
	{
		$database = $this->get_database();
		$images_table = $database->get_table('hc_database_images');
		$medium_size_image_id = $this->get_medium_size_image_id();
		return $images_table->get_row_by_id($medium_size_image_id);
	}

	public function 
		get_thumbnail_image()
	{
		$database = $this->get_database();
		#$images_table = $database->get_table('hpi_shop_images');
		$images_table = $database->get_table('hc_database_images');
		$thumbnail_image_id = $this->get_thumbnail_image_id();
		
		return $images_table->get_row_by_id($thumbnail_image_id);
	}

	public function 
		set_full_size_image_id($full_size_image_id)
	{
		$this->set_full_size_image_id('$full_size_image_id');
	}

	public function 
		get_thumbnail_image_id()
	{
		return $this->get('thumbnail_image_id');
	}

	public function 
		set_thumbnail_image_id($thumbnail_image_id)
	{
		$this->set_thumbnail_image_id('$thumbnail_image_id');
	}
    
    public function
        get_thumbnail_image_row()
    {
        $database = $this->get_database();
		
        #$images_table = $database->get_table('hpi_shop_images');
		$images_table = $database->get_table('hc_database_images');
        
        return $images_table->get_row_by_id($this->get_thumbnail_image_id());
    }
}
?>
