/** 
 * VideoLibrary_Thumbnails.js
 * Using JQuery
 * 
 * This class provides animated thumbnail
 * 
 */

function VideoLibrary_Thumbnails(options) { 

    this.$thumbnails = options.$thumbnails;
    this.interval = 0;

    this.bind = function() {
        var me = this;
        me.bind_thumbnails();
    };

    this.bind_thumbnails = function() {
        var me = this;
        // var interval;

        $('img.thumbnail', me.$thumbnails).live('mouseover mouseout', function(event) {
                if (event.type == 'mouseover') {
                    // do something on mouseover
                    var $cur_img = event.target;

                    me.interval = setInterval( 
                        function() {
                            me.advance_image($cur_img);
                        } ,
                        300
                    );

                } else {
                    // do something on mouseout
                    clearInterval(me.interval);
                }

            });
    };

    this.advance_image = function($cur_img) {
        var me = this;
        var cur_img_url = $cur_img.src;

        /*
         * I don't know how it returns to the first img url when it runs out, but it does...
         */
        var next_img_url = this.get_next_image_url(cur_img_url); 
        me.change_image($cur_img, next_img_url);
    };

    this.change_image = function($img, url) {
        $($img).addClass('loading');
        var img = new Image();

        // wrap our new image in jQuery, then:
        $(img)
        // once the image has loaded, execute this code
        .load(function () {
                $($img).removeClass('loading');
                $($img).attr('src', url);
            })

        // if there was an error loading the image, react accordingly
        .error(function () {
                // notify the user that the image could not be loaded
            })
        .attr('src', url);
        return img;
    };


    this.get_next_image_url = function(cur_url) {
        
        var re = new RegExp("_([0-9])+.jpg$","gi");
        var cur_frame_no = 1;
        var next_frame_no = 1;

        if (cur_url.match(re)) {
            while (match = re.exec(cur_url)) {
                cur_frame_no = match[1];
            }
            next_frame_no = parseInt(cur_frame_no, 10) + 1;
        }

        return cur_url.replace(/_[0-9]+.jpg$/g, '_' + next_frame_no + '.jpg')
    };

};

