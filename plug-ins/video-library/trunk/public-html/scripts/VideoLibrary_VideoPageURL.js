/** 
 * VideoLibrary_VideoPageURL.js
 * Using JQuery
 * 
 * This class represents video page URLs
 * /videos/69/video-name-here
 * /videos/69/channels/1/15/15
 */

function VideoLibrary_VideoPageURL(url) {
        // var url = "/videos/19/channels/1/15/30";
        // var url = "/videos/19/15/30";

        var channel_start_limit_re = new RegExp("^/videos/([0-9]+)/channels/([0-9]+)/([0-9]+)/([0-9]+)","gi");
        var channel_re = new RegExp("^/videos/([0-9]+)/channels/([0-9]+)","gi");
        var basic_start_limit_re = new RegExp("^/videos/([0-9]+)/([0-9]+)/([0-9]+)","gi");
        var basic_re = new RegExp("^/videos/([0-9]+)","gi");
        // var basic_re = new RegExp("^/videos/([0-9]+)","gi");


        // var url = link.attr('href');
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
        } else if (url.match(channel_re)) {
            while (match = channel_re.exec(url)) {
                video_id = match[1];
                provider_id = match[2];
                start = false;
                duration = false;
            }
        } else if (url.match(basic_start_limit_re)) {
            while (match = basic_start_limit_re.exec(url)) {
                video_id = match[1];
                provider_id = false;
                start = match[2];
                duration = match[3];
            }
        } else {
            while (match = basic_re.exec(url)) {
                video_id = match[1];
                provider_id = false;
                start = false;
                duration = false;
            }
        }
        // alert( "video = " + video_id + " // provider = " + provider_id + " //start = " + start + " // duration = " + duration );
        this.video_id = video_id ;
        this.provider_id = provider_id;
        this.start = start;
        this.duration = duration;
};

