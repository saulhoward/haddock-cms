/** 
 * VideoLibrary_HTMLPage.js
 * Using JQuery
 */

$(function() { 

    /**
     * The Search box 
     */
    var empty_re = new RegExp("(^\\s*$)","gi");
    var message_re = new RegExp("(^Search...$)","gi");

    $('input:.search').each (
		function(intIndex){
            var query = $(this).val();
            if (query.match(empty_re)) {
                $(this).val('Search...');
                $(this).addClass('empty');
            }
        $(this).bind (
            "blur",
            function(){
                var query = $(this).val();
                if (query.match(empty_re)) {
                    $(this).val('Search...');
                    $(this).addClass('empty');
                }
            }
        );
        $(this).bind (
                "focus",
                function(){
                    var query = $(this).val();
                    if (query.match(message_re)) {
                        $(this).val('');
                        $(this).removeClass('empty');
                    }
                }
            );

    });

    $( '.search-form').each (
		function(intIndex){
            $(this).submit(function() {
                var query = $('input:.search', this).val();
                if (query.match(empty_re) || query.match(message_re)) {
                    return false;
                }
                $('input:.search', this).addClass('submitted');
        });
        /**
         * For some reason the previous func overrides the default 
         * form submit on enter key, so I reimplement it here
         */
        $(this).keyup(function(e) {
            if(e.keyCode == 13) {
                $(this).submit();
            }
        });
    });

});

