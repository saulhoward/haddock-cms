/** 
 * VideoLibrary_HTMLPage.js
 * Using JQuery
 */

$(function() { 

        /*
         * The Search box in the secondary nav
         */
        var empty_re = new RegExp("(^\\s*$)","gi");
        var message_re = new RegExp("(^Search...$)","gi");

        var query = $('input:.search').val();
        if (query.match(empty_re)) {
            $('input:.search').val('Search...');
            $('input:.search').addClass('empty');
        }
        $( 'input:.search').bind (
            "blur",
            function(){
                var query = $('input:.search').val();
                if (query.match(empty_re)) {
                    $('input:.search').val('Search...');
                    $('input:.search').addClass('empty');
                }
            }
        );
       $( 'input:.search').bind (
            "focus",
            function(){
                var query = $('input:.search').val();
                if (query.match(message_re)) {
                    $('input:.search').val('');
                    $('input:.search').removeClass('empty');
                }
            }
        );
        $('.search-form').submit(function() {
                var query = $('input:.search').val();
                if (query.match(empty_re) || query.match(message_re)) {
                    return false;
                }
            });

});

