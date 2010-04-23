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
        $('.pager li a').live (
            "click",
            function(){
                /*
                 * Sort out removing or putting back the 'Previous' button
                 */
                // if ($(this).parent().hasClass('first')) {
                    // $(this).parent().siblings('.prev').remove();
                    // $('#related-videos .prev.standalone').html('<span>Previous</span>');
                // } else if (
                    // !$(this).parent().hasClass('.prev')
                    // &&
                    // !$(this).parent().siblings().hasClass('.prev')
                // ) {
                    // $(this).parent().siblings('.first').before('<li class="prev"><a href="/">Previous</a></li>');
                    // $('#related-videos .prev.standalone').html('<a href="#">Previous</a>');
                // }

                /*
                 * And the 'Next' button
                 */
                // if ($(this).parent().hasClass('last')) {
                    // $(this).parent().siblings('.next').remove();
                    // $('#related-videos .next.standalone').html('<span>Next</span>');
                // } else if (
                    // !$(this).parent().hasClass('.next')
                    // &&
                    // !$(this).parent().siblings().hasClass('.next')
                // ) {
                    // $(this).parent().siblings('.last').after('<li class="next"><a href="/">Next</a></li>');
                    // $('#related-videos .next.standalone').html('<a href="#">Next</a>');
                // }

                /*
                 * Now what to do with the click
                 */

                /*
                 * Create the video_page_url object for the clicked button
                 */
                var clicked_url_string = $(this).attr('href');
                url = new video_page_url(clicked_url_string);
                // alert(url);

                /*
                 * if a sibling is '...', then sort that out
                 */
                // if ($(this).parent().next().hasClass('ellipsis')) {
                    // var subsequent_url_string = create_subsequent_url_string(url);
                    // var subsequent_line_number = parseInt($(this).html()) + 1;
                    // var subsequent_line = '<li><a href="' + subsequent_url_string + '">' + subsequent_line_number + '</a></li>';
                    // $(this).parent().after(subsequent_line);
                // }
                // if ($(this).parent().prev().hasClass('ellipsis')) {
                    // var preceeding_url_string = create_preceeding_url_string(url);
                    // var preceeding_line_number = parseInt($(this).html()) - 1;
                    // var preceeding_line = '<li><a href="' + preceeding_url_string + '">' + preceeding_line_number + '</a></li>';
                    // $(this).parent().before(preceeding_line);
                // }

                /*
                 * Do the actual click,
                 * if its a prev or next button, simulate the click on
                 * the indented target, otherwise run the click and redo
                 * the pager
                 */
                if ($(this).parent().hasClass('.prev')) {
                    $(this).parent().siblings('.selected').prev().children('a').click();
                } else if ($(this).parent().hasClass('.next')) {
                    $(this).parent().siblings('.selected + li').children('a').click();
                } else {

                    /*
                     * AJAX function to get the videos
                     */
                    set_related_videos(url);

                    /*
                     * Sort the Pager out
                     */
                    // var old_page_text = $(this).parent().siblings('.selected').children('span').html();
                    // $(this).parent().siblings('.selected').html('<a href="' + cur_url + '">' + old_page_text + '</a>');
                    // $(this).parent().siblings('.selected').removeClass('selected');
                    // cur_url = clicked_url_string;

                    // $(this).parent().addClass('selected');
                    // var text = $(this).html();
                    // $(this).replaceWith('<span>' + text + '</span>');

                    // setup_pager($('.pager'));

                    var new_pager = get_new_pager(
                        $(this).parent().siblings('.last').children('a').html(),
                        (url.start / url.duration) + 1,
                        url
                    )
                    $('.pager').html(new_pager);
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
                    (((page - 1)* selected_url.duration)),
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

function setup_pager(pager)
{
    /*
     * If there are too many line numbers, delete some
     * if necessary, insert '...'
     */
    var total_number_of_pages = pager.children('.last').children('a').html();
    if (total_number_of_pages > 9) {
        var preceeding_was_ellipsis = false;
        var preceeding_line_number = false;
        var selected_line_number = pager.children('.selected').children('span').html();
        pager.children('li').each(function(index) {
                var replacement_html = false;
                var delete_line = false;
                if (
                    $(this).hasClass('prev')
                    ||
                    (!($(this).hasClass('ellipsis')))
                ) {
                    var this_line_number = $(this).children('a').html();
                } else if ($(this).hasClass('selected')) {
                    var this_line_number = $(this).children('span').html();
                } else {
                    var this_line_number = false;
                }


                if (
                    (
                        (!($(this).hasClass('ellipsis')))
                        &&
                        (!(preceeding_was_ellipsis))
                    )
                    &&
                    (
                        (
                            (this_line_number == (selected_line_number + 2))
                            &&
                            (this_line_number < (total_number_of_pages - 1))
                        )
                        ||
                        (
                            (this_line_number == (selected_line_number - 2))
                            &&
                            (this_line_number > 2)
                        )
                    )
                ) {
                    replacement_html = '<li class="ellipsis"><span>...</span></li>';
                    preceeding_was_ellipsis = true;
                }


                /*
                 * Remove more than one ellipses
                 */
                if ($(this).hasClass('ellipsis')) {
                    if (preceeding_was_ellipsis) {
                        delete_line = true;
                    }
                    preceeding_was_ellipsis = true;
                } else {
                    preceeding_was_ellipsis = false;
                }

                if (this_line_number) {
                    preceeding_line_number = this_line_number;
                }

                if (
                    (this_line_number)
                    &&
                    (preceeding_line_number > this_line_number)
                ) {
                    $(this).prev().remove();
                    delete_line = true;
                }

                if (delete_line) {
                    $(this).remove();
                    // $(this).replaceWith('Deleted!');
                } else if (replacement_html) {
                    $(this).replaceWith(replacement_html);
                }

            });
    }
}

function create_subsequent_url_string(url)
{
    var url_string = '/videos/' + url.video_id;
    if (url.provider_id != false) {
        url_string += '/channels/' + url.provider_id;
    }
    if (url.start != false) {
        url_string += '/' + (parseInt(url.start) + parseInt(url.duration));
    }
    if (url.duration != false) {
        url_string += '/' + url.duration;
    }

    return url_string;
}
function create_preceeding_url_string(url)
{
    var url_string = '/videos/' + url.video_id;

    if (url.provider_id != false) {
        url_string += '/channels/' + url.provider_id;
    }

    if (url.start != false) {
        url_string += '/' + (parseInt(url.start) - parseInt(url.duration));
    }

    if (url.duration != false) {
        url_string += '/' + url.duration;
    }

    return url_string;
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
