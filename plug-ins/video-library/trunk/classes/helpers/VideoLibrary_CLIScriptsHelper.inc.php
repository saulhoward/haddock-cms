<?php
/**
 * VideoLibrary_CLIScriptsHelper
 *
 * @copyright 2009-11-10, SANH
 */

class
VideoLibrary_CLIScriptsHelper
{
    public static function
        get_thumbnails_original_directory()
    {
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        $config_manager = 
            $cmf->get_config_manager('plug-ins', 'video-library');
        $dir = $config_manager->get_thumbnails_original_directory();
        if (file_exists($dir)) {
            return $dir;
        } else {
            throw new VideoLibrary_ThumbnailsDirectoryNotFoundException();
        }
    }

    public static function
        get_thumbnails_medium_directory()
    {
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        $config_manager = 
            $cmf->get_config_manager('plug-ins', 'video-library');
        $dir = $config_manager->get_thumbnails_medium_directory();
        if (file_exists($dir)) {
            return $dir;
        } else {
            throw new VideoLibrary_ThumbnailsDirectoryNotFoundException();
        }
    }

    public static function
        get_thumbnails_medium_web_directory()
    {
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        $config_manager = 
            $cmf->get_config_manager('plug-ins', 'video-library');
        $dir = $config_manager->get_thumbnails_medium_web_directory();
        return $dir;

        ////Can't check for this cos of mod_rewrite
        //if (file_exists(PROJECT_ROOT . '/' . $dir)) {
        //return $dir;
        //} else {
        //throw new VideoLibrary_ThumbnailsDirectoryNotFoundException();
        //}
    }

    public static function
        get_thumbnails_medium_width()
    {
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        $config_manager = 
            $cmf->get_config_manager('plug-ins', 'video-library');
        $size = $config_manager->get_thumbnails_medium_width();
        return $size;
    }

    public static function
        get_thumbnails_medium_height()
    {
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        $config_manager = 
            $cmf->get_config_manager('plug-ins', 'video-library');
        $size = $config_manager->get_thumbnails_medium_height();
        return $size;
    }

    public static function
        get_video_download_url_for_external_video(
            $video_data
        )
    {
        /**
         * Creates an instance of the provider class named in the video data,
         * Gets the url schema and inserts the correct providers id
         */
        $provider_class_str = trim($video_data['haddock_class_name']);
        $instance = new $provider_class_str();
        //$instance->set_providers_internal_id($video_data['providers_internal_id']);
        return str_replace(
            '%video_id',
            $video_data['providers_internal_id'],
            $instance->get_video_download_url_schema()
        );
    }

    public static function
        get_thumbnail_urls_for_external_video(
            $video_data
        )
    {
        /**
         * Creates an instance of the provider class named in the video data,
         * Gets the url schema and inserts the correct providers id
         */
        $provider_class_str =
            trim($video_data['haddock_class_name']);
        $instance = new $provider_class_str();
        $instance->set_providers_internal_id(
            $video_data['providers_internal_id']
        );
        return $instance->get_thumbnail_urls();
    }

    public static function
        download_html_page(
            $page_url
        )
    {
        /*
         *Download the page
         */
        $cookie = tempnam ("/tmp", "CURLCOOKIE");
        $timeout = 5;
        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL, $page_url);
        ////curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);


        curl_setopt( $curl_handle, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt( $curl_handle, CURLOPT_COOKIEJAR, $cookie );
        curl_setopt( $curl_handle, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt( $curl_handle, CURLOPT_ENCODING, "" );
        curl_setopt( $curl_handle, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl_handle, CURLOPT_AUTOREFERER, true );
        curl_setopt( $curl_handle, CURLOPT_CONNECTTIMEOUT, $timeout );
        curl_setopt( $curl_handle, CURLOPT_TIMEOUT, $timeout );
        curl_setopt( $curl_handle, CURLOPT_MAXREDIRS, 10 );


        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        // print_r($page_url);exit;
        // print_r($buffer);exit;


        if (empty($buffer)) {
            throw new VideoLibrary_DownloadUnsuccessfulException();
        } else {
            return $buffer;
        }
    }

    public static function
        download_file(
            $remote_url,
            $local_destination,
            $local_filename
        )
    {
        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL, $remote_url);
        //curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        curl_setopt ($curl_handle, CURLOPT_FOLLOWLOCATION, 1);

        // This is now done in the Config Manager before dirs are passed out
        // $local_destination 
            // .= (substr($local_destination,-1) != DIRECTORY_SEPARATOR) ? DIRECTORY_SEPARATOR : "";

        $fp = fopen($local_destination . $local_filename, 'w');
        curl_setopt($curl_handle, CURLOPT_FILE, $fp);

        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        fclose($fp);
        // print_r($buffer);exit;

        if (empty($buffer)) {
            throw new VideoLibrary_DownloadUnsuccessfulException();
        } else {

        }
        // print_r($local_destination . ' :: ' . $local_filename);exit;
        return $local_destination . $local_filename;
    }

    public static function 
        resize_image(
            $original_filename = NULL,
            $width,
            $height,
            $save_dir,
            $save_name
        )
    {
        // print_r($original_filename);
        // print_r($save_dir . $save_name);exit;
        if (is_null($original_filename) || !is_file($original_filename) || !(getimagesize($original_filename))) {
            throw new VideoLibrary_FailedToCreateImageException();
        }
        $gis        = getimagesize($original_filename);
        $type        = $gis[2];

        // print_r($gis);exit;
        
        if (self::resize_proportional_image($original_filename, $save_dir.$save_name, $width, $height, TRUE))
            return $save_dir.$save_name;
        else
            throw new VideoLibrary_FailedToCreateImageException();
    }

    public static function 
        resize_proportional_image($filename, $destination, $th_width, $th_height, $forcefill)
    {    
        list($width, $height) = getimagesize($filename);

        $source = imagecreatefromjpeg($filename);

        if($width > $th_width || $height > $th_height){
            $a = $th_width/$th_height;
            $b = $width/$height;

            if(($a > $b)^$forcefill)
            {
                $src_rect_width  = $a * $height;
                $src_rect_height = $height;
                if(!$forcefill)
                {
                    $src_rect_width = $width;
                    $th_width = $th_height/$height*$width;
                }
            }
            else
            {
                $src_rect_height = $width/$a;
                $src_rect_width  = $width;
                if(!$forcefill)
                {
                    $src_rect_height = $height;
                    $th_height = $th_width/$width*$height;
                }
            }

            $src_rect_xoffset = ($width - $src_rect_width)/2*intval($forcefill);
            $src_rect_yoffset = ($height - $src_rect_height)/2*intval($forcefill);

            $thumb  = imagecreatetruecolor($th_width, $th_height);
            imagecopyresampled($thumb, $source, 0, 0, $src_rect_xoffset, $src_rect_yoffset, $th_width, $th_height, $src_rect_width, $src_rect_height);

            imagejpeg($thumb,$destination);
            return TRUE;
        }
        /*
         * Image is already the thumb size`
         */
        imagejpeg($source,$destination);
        return TRUE;
    }
}
?>
