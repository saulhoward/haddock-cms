/** 
 * VideoLibrary_VideoPageURLHelper.js
 * Using JQuery
 * 
 * This namespace contaqnis helper functions for working with
 * video page URLs
 * /videos/69/video-name-here
 * /videos/69/channels/1/15/15
 */

var VideoLibrary_VideoPageURLHelper = {};

VideoLibrary_VideoPageURLHelper.create_video_page_url_string = function (
    video_id,
    provider_id,
    start,
    duration
) {
    var url_string = '/videos/' + video_id;

    if (provider_id != false) {
        url_string += '/channels/' + provider_id;
    }

    if (start != false) {
        url_string += '/' + start;
    } else if (start == 0) {
        url_string += '/0';
    }

    if (duration != false) {
        url_string += '/' + duration;
    }

    return url_string;
};

