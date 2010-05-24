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

    abstract function
        get_video_embed_code();

    public function
        get_video_dimensions_ratio()
    {
        return array(1,1);
    }

    abstract function
        get_thumbnail_urls();

    // abstract function
        // get_video_page_url_schema();

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

    public function
        get_video_page_url()
    {
        // print_r($this->get_providers_internal_id());exit;
        // print_r($this->get_video_page_url_schema());exit;
        return str_replace(
            '%video_id',
            $this->get_providers_internal_id(),
            $this->get_video_page_url_schema()
        );
    }
}
?>
