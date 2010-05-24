/** 
 * VideoLibrary_ThumbnailsPage.js
 * Using JQuery
 * 
 */

$( function() { 

        var $thumbnails = $('#thumbnails');

        var thumbnails = new VideoLibrary_Thumbnails({
                $thumbnails: $thumbnails
        });

        thumbnails.bind();

    });

