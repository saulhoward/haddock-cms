<?php
/**
 * PhotoGallery_Photograph
 *
 * @copyright RFI 2007-12-15
 * @copyright SANH 2008-04-05
 */

/**
 * Holds the data for a event
 */
class
PhotoGallery_Photograph
{
	private $id;
	private $name;
	private $description;
	private $added;
	private $image_url;

	public function
		__construct($id)
	{
		$this->id  = $id;
	}

	public function
		get_id()
	{
		return $this->id;
	}


	public function
		get_name()
	{
		return $this->name;
	}

	public function
		set_name($name)
	{
		$this->name = $name;
	}

	public function
		get_added()
	{
		return $this->added;
	}

	public function
		set_added($name)
	{
		$this->added = $name;
	}
	public function
		get_added_human_readable()
	{
		$date_str = strtotime($this->added);
		return date("F j, Y, g:i a", $date_str);
	}

	public function
		get_image_url()
	{
		return $this->image_url;
	}

	public function
		set_image_url($image_url)
	{
		$this->image_url = $image_url;
	}

	public function
		get_image_img()
	{
		$img = new HTMLTags_IMG();
		$url = new HTMLTags_URL();
		$url->set_file($this->image_url);
		$img->set_src($url);
		$img->set_attribute_str('alt', $this->get_name());
		$img->set_attribute_str('title', $this->get_description());
		return $img;
	}

	public function
		set_description($description)
	{
		$this->description = $description;
	}

	public function
		get_description()
	{
		return $this->description;
	}


	public function
		get_description_html()
	{
		$textile = new Textile_Textile();
		return $textile->TextileThis($this->description);
//                return $this->description;
	}

}
?>
