<?php
/**
 * VideoLibrary_URL
 *
 * @copyright 2006-11-29, RFI
 */

class
VideoLibrary_URL
extends
HTMLTags_URL
{
        public function
                get_as_string()
        {
                $pretty_urls = 1;
                //$pretty_urls = 0;

                if ($pretty_urls) {
                        $get_variables = $this->get_get_variables();
                        //print_r($get_variables);exit;
                        $video_page = VideoLibrary_URLHelper::
                                get_video_page_class_name();
                        $tags_page = 'VideoLibrary_TagsPage';

                        switch ($get_variables['page-class']) {
                        case $video_page:
                                $url = '/videos/';
                                $url .= $get_variables['video_id']; 
                                if (isset($get_variables['external_video_provider_id'])) {
                                        $url .= '/channels/' 
                                                . $get_variables['external_video_provider_id'];
                                }
                                break;
                        case $tags_page:
                            $url = '/tags/';
                            if (isset($get_variables['external_video_library_id'])) {
                                $url .= 'libraries/' 
                                    . $get_variables['external_video_library_id'];
                            }
                            break;
                        default:
                            return parent::get_as_string();
                        }
                        if (isset($get_variables['start'])) {
                                $url .= '/' . $get_variables['start'];
                        }
                        if (isset($get_variables['duration'])) {
                                $url .= '/' . $get_variables['duration'];
                        }
                        return $url;
                } else {
                        return parent::get_as_string();
                }
        }
}
?>
