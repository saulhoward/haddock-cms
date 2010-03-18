/** 
 * VideoLibrary_VideoPage.js
 * Using JQuery
 */

$(document).ready(function(){

    // var url = "/videos/19/channels/1/15/30";
    // var url = "/videos/19/15/30";

    var channel_start_limit_re = new RegExp("^/videos/([0-9]+)/channels/([0-9]+)/([0-9]+)/([0-9]+)","gi");
    var basic_start_limit_re = new RegExp("^/videos/([0-9]+)/([0-9]+)/([0-9]+)","gi");
    var basic_re = new RegExp("^/videos/([0-9]+)","gi");
    // var basic_re = new RegExp("^/videos/([0-9]+)","gi");

    var cur_url = window.location.pathname;

    $('#thumbnails').after('<div id="loading">Loading...</div>');
    $('#loading').hide();

    $('.pager li a').live (
            "click",
            function(){
                if ($(this).parent().hasClass('first')) {
                    $(this).parent().siblings('.prev').remove();
                } else {
                    if (
                        !$(this).parent().hasClass('.prev')
                        &&
                        !$(this).parent().siblings().hasClass('.prev')
                        ) {
                        $(this).parent().siblings('.first').before('<li class="prev"><a href="/">Previous</a></li>');
                    }
                }
                if ($(this).parent().hasClass('last')) {
                    $(this).parent().siblings('.next').remove();
                } else {
                if (
                    !$(this).parent().hasClass('.next')
                    &&
                    !$(this).parent().siblings().hasClass('.next')
                    ) {
                        $(this).parent().siblings('.last').after('<li class="next"><a href="/">Next</a></li>');
                    }
                }

                if ($(this).parent().hasClass('.prev')) {
                    $(this).parent().siblings('.selected').prev().children('a').click();
                }
                else if ($(this).parent().hasClass('.next')) {
                    $(this).parent().siblings('.selected + li').children('a').click();
                } else {
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

                    var next_thumbnails_url = 
                        '/?oo-page=1&page-class=VideoLibrary_SearchXMLPage&related_videos=1&ajax=1'
                        + '&video_id=' + video_id;

                    if (start != false) {
                        next_thumbnails_url += '&start=' + start
                    }
    
                    if (duration != false) {
                        next_thumbnails_url += '&duration=' + duration
                    }
    
                    if (provider_id != false) {
                        next_thumbnails_url += '&external_video_provider_id=' + provider_id
                    }
                    // alert(next_thumbnails_url);
                    $('#thumbnails').slideToggle();
                    $.ajax({
                        method: "get",url: next_thumbnails_url,
                        beforeSend: function(){$("#loading").show("fast");}, //show loading just when link is clicked
                        complete: function(){ $("#loading").hide("fast");}, //stop showing loading when the process is complete
                        success: function(html){ //so, if data is retrieved, store it in html
                        $("#thumbnails").show("slow"); //animation
                        $("#thumbnails").html(html); //show the html inside .content div
                        }
                    }); //close $.ajax(

                    /*
                    * Sort the Pager out
                    */
                    var old_page_text = $(this).parent().siblings('.selected').children('span').html();
                    $(this).parent().siblings('.selected').html('<a href="' + cur_url + '">' + old_page_text + '</a>');
                    $(this).parent().siblings('.selected').removeClass('selected');
                    cur_url = url;

                    $(this).parent().addClass('selected');
                    var text = $(this).html();
                    $(this).replaceWith('<span>' + text + '</span>');

            }
            return false;
        });
    // });

    /*
     * Pager Previous and Next buttons
     */
}); //close $(

