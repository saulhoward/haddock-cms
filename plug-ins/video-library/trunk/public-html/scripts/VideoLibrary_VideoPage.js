/** 
 * VideoLibrary_VideoPage.js
 * Using JQuery
 * 
 * This script provides AJAX loading behaviour for the 
 * related videos section
 */

$(document).ready(
    function(){
        /*
         * Get the current window url.
         * Script only works if it's of the form
         * videos/11/15/30 or similar
         */
        var cur_url = window.location.pathname;

        /*
         * Set up the loading div,
         * and hide it.
         */
        $('#thumbnails').after('<div id="loading">Loading...</div>');
        $('#loading').hide();

        /*
         * Click event on any pager button
         */
        $('a', $('.pager')).live(
            "click",
            function(event){
                if ($(event.target).parent().hasClass('.prev')) {
                    $(event.target).parent().siblings('.selected').prev().children('a').click();
                } else if ($(event.target).parent().hasClass('.next')) {
                    $(event.target).parent().siblings('.selected + li').children('a').click();
                } else {
                    var clicked_url_string = $(event.target).attr('href');
                    url = new video_page_url(clicked_url_string);

                    set_related_videos(url);

                    new_pager = get_new_pager(
                        $('.pager .last a').html(),
                        (url.start / url.duration) + 1,
                        url
                    );
                    // $('.pager ul').replaceWith(new_pager);
                }
                return false;
        });


    /*
     * Add special Pager Previous and Next buttons (at the sides)
     */
    if ($('.pager li.prev').length) { 
        $('#thumbnails-wrapper').before('<div class="prev standalone"><a href="#">Previous</a></div>');
    } else {
        $('#thumbnails-wrapper').before('<div class="prev standalone"><span>Previous</span></div>');
    }
    if ($('.pager li.next').length) { 
        $('#thumbnails-wrapper').after('<div class="next standalone"><a href="#">Next</a></div>');
    } else {
        $('#thumbnails-wrapper').after('<div class="next standalone"><span>Next</span></div>');
    }

    $('#related-videos .next.standalone a').live(
        "click",
        function(){
            $('.pager li.next a').click();
            return false;
        }
    );
    $('#related-videos .prev.standalone a').live(
        "click",
        function(){
            $('.pager li.prev a').click();
            return false;
        }
    );


}); //close $

function get_new_pager(
    pages,
    current_page,
    selected_url
)
{
    var pager_html = '';
    var ul_html = '';
    var ellipsis = 0;
    var previous_line_was_ellipsis = false;
    var first = true;

    // pager_html += '<div class="pager">';
    ul_html += '<ul>';
    if (current_page != 1) {
        ul_html += '<li class="prev"><a href="#">Previous</a></li>';
    }
    for (var page = 1; page <= pages; page++) {
        if (
            (pages <= 9) 
            ||
            (page == 1) || (page == 2)
            ||
            (page == current_page)
            ||
            (page == (pages -1)) || (page == pages)
            ||
            (page == (current_page - 1)) || (page == (current_page + 1))
        ) {
            var li_html = '';
            var li_class = "";
            if (first) {
                li_class += 'first ';
                first = false;
            } else if (page == pages) {
                li_class += 'last ';
            }
            if (page == current_page) {
                li_class += 'selected ';
                li_html += '<li class="' + li_class + '"><span>' + page + '</span></li>';
            } else {
                video_page_url = create_video_page_url_string(
                    selected_url.video_id,
                    selected_url.provider_id,
                    (((page - 1) * selected_url.duration)),
                    selected_url.duration
                );
                li_html += '<li class="' + li_class + '"><a href="' + video_page_url + '">' + page + '</a></li>';
            }
            ul_html += li_html;
            previous_line_was_ellipsis = false;
        } else if ((!(previous_line_was_ellipsis)) && (ellipsis <= 1)){
            ul_html += '<li class="ellipsis"><span>...</span></li>';
            ellipsis++;
            previous_line_was_ellipsis = true;
        }
    }
    if (current_page != pages) {
        ul_html += '<li class="next"><a href="#">Next</a></li>';
    }
    ul_html += '</ul>';

    pager_html += ul_html;
    // pager_html += '</div>';
    return pager_html;
}

function create_video_page_url_string(
    video_id,
    provider_id,
    start,
    duration
)
{
    var url_string = '/videos/' + video_id;

    if (provider_id != false) {
        url_string += '/channels/' + provider_id;
    }

    if (start != false) {
        url_string += '/' + start;
    }

    if (url.duration != false) {
        url_string += '/' + duration;
    }

    return url_string;
}

function video_page_url(url)
{
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
}

function set_related_videos(url)
{
    var next_thumbnails_url = 
        '/?oo-page=1&page-class=VideoLibrary_VideoXMLPage&related_videos=1&ajax=1'
    + '&video_id=' + url.video_id;

    if (url.start != false) {
        next_thumbnails_url += '&start=' + url.start
    }

    if (url.duration != false) {
        next_thumbnails_url += '&duration=' + url.duration
    }

    if (url.provider_id != false) {
        next_thumbnails_url += '&external_video_provider_id=' + url.provider_id
    }
    // alert(next_thumbnails_url);

    var thumbnails_div = $('#thumbnails');
    thumbnails_div.animate({
            marginLeft: parseInt(thumbnails_div.css('marginLeft'),10) == 0 ?
            -thumbnails_div.outerWidth() :
            0
        });
    $.ajax({
            method: "get",url: next_thumbnails_url,
            beforeSend: function(){$("#loading").fadeIn("fast");}, //show loading just when link is clicked
            complete: function(){ $("#loading").fadeOut("fast");}, //stop showing loading when the process is complete
            success: function(html){ //so, if data is retrieved, store it in html
                thumbnails_div.css('marginLeft', thumbnails_div.outerWidth());
                thumbnails_div.animate({
                        marginLeft: parseInt(thumbnails_div.css('marginLeft'),10) == 0 ?
                        thumbnails_div.outerWidth() :
                        0
                    }); //animation
                $("#thumbnails").html(html); //show the html inside .content div
            }
        }); //close $.ajax
}
