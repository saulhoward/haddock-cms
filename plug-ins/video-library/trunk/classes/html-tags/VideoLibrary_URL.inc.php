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
                        $search_page = VideoLibrary_URLHelper::
                                get_search_page_class_name();
                        $tags_page = 'VideoLibrary_TagsPage';

                        $append_url = NULL;

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
                        case $search_page:
                            $url = '/search';
                            if (isset($get_variables['external_video_library_id'])) {
                                $url .= '/libraries/' 
                                    . $get_variables['external_video_library_id'];
                            }
                            if (isset($get_variables['external_video_provider_id'])) {
                                $url .= '/channels/' 
                                    . $get_variables['external_video_provider_id'];
                            }             
                            if (isset($get_variables['tag_ids'])) {
                                $url .= '/tags/' 
                                    . $get_variables['tag_ids'];
                            }             
                            if (isset($get_variables['q'])) {
                                $append_url .= '?q=' 
                                    . $get_variables['q'];
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

                        /*
                         * If its the video page, stick the name on the end
                         */
                        if (
                            ($get_variables['page-class'] == $video_page)
                            &&
                            (isset($get_variables['video_name']))
                        ) {
                                $url .= '/' . $get_variables['video_name'];
                        }

                        if (isset($append_url)) {
                            $url = $url . '/' . $append_url;
                        }

                        return $url;
                } else {
                        return parent::get_as_string();
                }
        }

}
?>
