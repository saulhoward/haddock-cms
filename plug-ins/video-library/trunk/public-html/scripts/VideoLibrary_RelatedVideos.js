/** 
 * VideoLibrary_RelatedVideos.js
 * Using JQuery
 * 
 * This class provides AJAX loading behaviour for the 
 * related videos
 *
 * It requires VideoLibrary_VideoPageURL and
 * VideoLibrary_VideoPageURLHelper
 *
 */

function VideoLibrary_RelatedVideos(options) { 

    this.$container = options.$container;
    this.cur_url = options.cur_url;

    this.construct = function() {

        this.create_loading_div($('#thumbnails', this.$container));
        this.bind_pager();

        this.rewrite_standalone_buttons(); // Create them first
        this.bind_standalone_buttons();

        /*
         * Video Provider AJAX
         */
        this.create_loading_div($('#video-control-wrapper', this.$container));
        this.bind_provider_links();
    };

    this.create_loading_div = function($position) {
        var $loading_div = $('<div/>', {
                class: 'loading',
                text: 'Loading&hellip;'
            });     
        $position.after($loading_div);
        $loading_div.hide();
    };

    this.bind_provider_links = function() {
        var me = this;
        $('a', $('.providers ul')).live(
            "click",
            function(event){
                var clicked_url_string = $(event.target).attr('href');
                url = new VideoLibrary_VideoPageURL(clicked_url_string);
                me.set_related_videos(url, {rewrite_controls: true});
                $(event.target).parent().siblings('.selected').removeClass('selected');
                $(event.target).parent().addClass('selected');
                // me.bind_pager();
                return false;
            });

    };

    this.bind_pager = function() {
        var duration = 0;
        var me = this;
        // Click event on any pager button
        $('.pager a', me.$container).live(
            "click",
            function(event){
                var clicked_url_string = $(event.target).attr('href');
                url = new VideoLibrary_VideoPageURL(clicked_url_string);

                me.set_related_videos(url, {rewrite_controls: false});

                if (url.duration) {
                    duration = url.duration;
                }

                new_pager = me.get_new_pager(
                    $('.pager .last span, .pager .last a').html(),
                    url,
                    duration
                );
                $('.pager ul').replaceWith(new_pager);
                me.rewrite_standalone_buttons();
                return false;
            });
    };

    this.bind_standalone_buttons = function() {
        var me = this;
        $('.next.standalone a', $('#related-videos')).live(
            "click",
            function(){
                $('.pager li.next a').click();
                me.rewrite_standalone_buttons();
                return false;
            }
        );
        $('.prev.standalone a', $('#related-videos')).live(
            "click",
            function(){
                $('.pager li.prev a').click();
                me.rewrite_standalone_buttons();
                return false;
            }
        );
    };

    this.rewrite_standalone_buttons = function() {
        var me = this;
        $('.standalone').remove();
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
    };


    this.get_new_pager = function(
        pages,
        selected_url,
        duration
    ) {
        var me = this;
        // alert(pages + '//' + duration);
        var current_page = (selected_url.start / duration) + 1;
        var pager_html = '';
        var ul_html = '';
        var ellipsis = 0;
        var previous_line_was_ellipsis = false;
        var first = true;

        // pager_html += '<div class="pager">';
        ul_html += '<ul>';
        if (current_page != 1) {
            var prev_video_page_url = VideoLibrary_VideoPageURLHelper.create_video_page_url_string(
                selected_url.video_id,
                selected_url.provider_id,
                ((current_page - 2) * duration),
                duration
            );
            ul_html += '<li class="prev"><a href="' + prev_video_page_url + '">Previous</a></li>';
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
                var li_class = '';
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
                    var video_page_url = VideoLibrary_VideoPageURLHelper.create_video_page_url_string(
                        selected_url.video_id,
                        selected_url.provider_id,
                        (((page - 1) * duration)),
                        duration
                    );
                    li_html += '<li class="' + li_class + '"><a href="' + video_page_url + '">' + page + '</a></li>';
                }
                ul_html += li_html;
                previous_line_was_ellipsis = false;
            } 
            else if ((!(previous_line_was_ellipsis)) && (ellipsis <= 1)){
                ul_html += '<li class="ellipsis"><span>&hellip;</span></li>';
                ellipsis++;
                previous_line_was_ellipsis = true;
            }
        }
        if (current_page != pages) {
            var next_video_page_url = VideoLibrary_VideoPageURLHelper.create_video_page_url_string(
                selected_url.video_id,
                selected_url.provider_id,
                (current_page * duration),
                duration
            );
            ul_html += '<li class="next"><a href="' + next_video_page_url + '">Next</a></li>';
        }
        ul_html += '</ul>';

        pager_html += ul_html;
        // pager_html += '</div>';
        return pager_html;
    };


    this.set_related_videos = function(
        url,
        options
    ) {
        var me = this;
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

        var ajax_success;
        var $loading_div_context;
        if (options.rewrite_controls) {
            next_thumbnails_url += '&rewrite_controls=1';
            $('#video-control-wrapper', this.$container).children().fadeOut('slow');
            $loading_div_context = $('#video-control-wrapper'); 
            ajax_success = function(html){ //so, if data is retrieved, store it in html
                $("#video-control-wrapper", me.$container).children().fadeIn('slow'); //show the html inside .content div
                $("#video-control-wrapper", me.$container).html(html); //show the html inside .content div
                me.rewrite_standalone_buttons();
            }
        } else {
            var thumbnails_div = $('#thumbnails', this.$container);
            thumbnails_div.animate({
                    marginLeft: parseInt(thumbnails_div.css('marginLeft'),10) == 0 ?
                    -thumbnails_div.outerWidth() :
                    0
                });
            $loading_div_context = $('#thumbnails-wrapper'); 
            ajax_success = function(html){ //so, if data is retrieved, store it in html
                thumbnails_div.css('marginLeft', thumbnails_div.outerWidth());
                thumbnails_div.animate({
                        marginLeft: parseInt(thumbnails_div.css('marginLeft'),10) == 0 ?
                        thumbnails_div.outerWidth() :
                        0
                    }); //animation
                $("#thumbnails").html(html); //show the html inside .content div
            }
        }

        $.ajax({
                method: 'get',
                url: next_thumbnails_url,
                beforeSend:function(){$(".loading", $loading_div_context).fadeIn("fast");},
                complete: function(){ $(".loading", $loading_div_context).fadeOut("fast");},
                success: function(html) {
                    ajax_success(html);
                }
            }); 

        // $.ajax({
                // method: "get",url: next_thumbnails_url,
                // beforeSend: function(){$(".loading", $('#thumbnails-wrapper')).fadeIn("fast");}, //show loading just when link is clicked
                // complete: function(){ $(".loading", $('#thumbnails-wrapper')).fadeOut("fast");}, //stop showing loading when the process is complete
                // success: function(html){ //so, if data is retrieved, store it in html
                    // thumbnails_div.css('marginLeft', thumbnails_div.outerWidth());
                    // thumbnails_div.animate({
                            // marginLeft: parseInt(thumbnails_div.css('marginLeft'),10) == 0 ?
                            // thumbnails_div.outerWidth() :
                            // 0
                        // }); //animation
                    // $("#thumbnails").html(html); //show the html inside .content div
                // }
            // }); //close $.ajax
    };

};

