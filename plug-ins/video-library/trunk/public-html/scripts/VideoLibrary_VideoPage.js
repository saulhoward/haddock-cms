/** 
 * VideoLibrary_VideoPage.js
 * Using JQuery
 */

$(document).ready(function(){

    // var url = "/videos/19/channels/1/15/30";
    // var url = "/videos/19/15/30";

    var channel_start_limit_re = new RegExp("^/videos/([0-9]+)/channels/([0-9]+)/([0-9]+)/([0-9]+)","gi");
    var basic_start_limit_re = new RegExp("^/videos/([0-9]+)/([0-9]+)/([0-9]+)","gi");
    // var basic_re = new RegExp("^/videos/([0-9]+)","gi");

    $('.pager li.next a').each (
		function(intIndex){
        $(this).bind (
            "click",
            function(){
                var url = $(this).attr('href');
                // alert(url);

                var video_id ;
                var provider_id;
                var start;
                var duration;
                var match;
                if (url.match(channel_start_limit_re)) {
                    while (match = channel_start_limit_re.exec(url)) {
                        video_id = match[1];
                        provider_id = match[2];
                        start = match[3];
                        duration = match[4];
                    }
                } else {
                    while (match = basic_start_limit_re.exec(url)) {
                        video_id = match[1];
                        provider_id = false;
                        start = match[2];
                        duration = match[3];
                    }
                }
                // alert( "video = " + video_id + " // provider = " + provider_id + " //start = " + start + " // duration = " + duration );

                var next_thumbnails_url = 
                    '/?oo-page=1&page-class=VideoLibrary_SearchPage&related_videos=1&ajax=1'
                    + '&external_video_id=' + video_id
                    + '&start=' + start
                    + '&duration=' + duration;

                if (provider_id != false) {
                    next_thumbnails_url += '&external_video_provider_id=' + provider_id
                }
                // alert(next_thumbnails_url);
                $.ajax({
                    method: "get",url: next_thumbnails_url,
                    beforeSend: function(){$("#loading").show("fast");}, //show loading just when link is clicked
                    complete: function(){ $("#loading").hide("fast");}, //stop showing loading when the process is complete
                    success: function(html){ //so, if data is retrieved, store it in html
                    $("#thumbnails-wrapper").show("slow"); //animation
                    $("#thumbnails-wrapper").html(html); //show the html inside .content div
                    }
                }); //close $.ajax(

                return false;
            }
        );
    });

}); //close $(

