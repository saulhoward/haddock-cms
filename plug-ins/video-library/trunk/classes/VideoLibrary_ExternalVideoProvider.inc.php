<?php
/**
 * VideoLibrary_ExternalVideoProvider
 *
 * @copyright 2009-01-10, SANH
 */

abstract class
	VideoLibrary_ExternalVideoProvider
{
	private $providers_internal_id;

	public function
		set_providers_internal_id($id)
	{
		$this->providers_internal_id = $id;
	}

	public function
		get_providers_internal_id()
	{
		return $this->providers_internal_id;
	}
	
	abstract function
		get_video_embed_code();

	//abstract function
		//get_video_page_url_schema();

}
?>
