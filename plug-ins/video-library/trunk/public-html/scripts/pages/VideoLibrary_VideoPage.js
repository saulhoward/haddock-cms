/** 
 * VideoLibrary_VideoPage.js
 * Using JQuery
 * 
 */

$(document).ready(
    function(){

        var $related_videos_div = $('#related-videos');
        var cur_url = window.location.pathname;

        var related_videos = new VideoLibrary_RelatedVideos({
                $container: $related_videos_div,
                cur_url: cur_url
            });

        related_videos.construct();

    }); //close $


