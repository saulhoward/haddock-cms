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
        get_thumbnail_url_for_external_video(
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
        return $instance->get_thumbnail_url();
    }

    public static function
        download_html_page(
            $page_url
        )
    {
        /*
         *Download the page
         */
        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL, $page_url);
        ////curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        curl_setopt ($curl_handle, CURLOPT_FOLLOWLOCATION, 1);
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        //print_r($buffer);exit;

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
        ////curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        curl_setopt ($curl_handle, CURLOPT_FOLLOWLOCATION, 1);

        $local_destination 
            .= (substr($save_dir,-1) != DIRECTORY_SEPARATOR) ? DIRECTORY_SEPARATOR : "";
        $fp = fopen($local_destination . $local_filename, 'w');
        curl_setopt($curl_handle, CURLOPT_FILE, $fp);

        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        fclose($fp);
        //print_r($buffer);exit;

        if (empty($buffer)) {
            throw new VideoLibrary_DownloadUnsuccessfulException();
        } else {

        }
        return $local_destination . $local_filename;
    }

    public static function 
        resize_image(
            $original_filename,
            $width,
            $height,
            $save_dir,
            $save_name
        )
    {
        $save_dir .= (substr($save_dir,-1) != DIRECTORY_SEPARATOR) ? DIRECTORY_SEPARATOR : "";
        $gis        = getimagesize($original_filename);
        $type        = $gis[2];
        switch($type)
        {
        case "1": $imorig = imagecreatefromgif($original_filename); break;
        case "2": $imorig = imagecreatefromjpeg($original_filename);break;
        case "3": $imorig = imagecreatefrompng($original_filename); break;
        default:  $imorig = imagecreatefromjpeg($original_filename);
        }

        $x = imagesx($imorig);
        $y = imagesy($imorig);

        $maxisheight = 0;
        $woh = (!$maxisheight)? $gis[0] : $gis[1] ;    

        if($woh <= $width) {
            $aw = $x;
            $ah = $y;
        } else {
            if(!$maxisheight){
                $aw = $width;
                $ah = $width * $y / $x;
            } else {
                $aw = $width * $x / $y;
                $ah = $width;
            }
        }   
        $im = imagecreatetruecolor($width,$height);
        if (imagecopyresampled($im,$imorig , 0,0,0,0,$aw,$ah,$x,$y))
            if (imagejpeg($im, $save_dir.$save_name))
                return $save_dir.$save_name;
            else
                throw new VideoLibrary_FailedToCreateImageException();
    }
}
?>
