/** 
 * VideoLibrary_ManageExternalVideosPage.js
 * Using JQuery
 */

$(function() { 

        /*
         * Expecting a list of names of tags
         * If any of the <li tag="name">s are clicked, 
         * toggle the presence of that tag in the input
         * box
         */
        $('.tags-fieldset li[tag]').each(
            function(intIndex){
                $( this ).bind (
                    "click",
                    function(){
                        var tag = $(this).html();
                        if (
                            (toggle_tag_on_click($(this).html()) == 1 )
                            &&
                            ($(this).html() != '')
                        ) {
                            $(".tags-fieldset li[tag='" + tag + "']").addClass('selected')
                        } else {
                            $(".tags-fieldset li[tag='" + tag + "']").removeClass('selected')
                        }
                        $('input#tags').trigger('change');
                    }
                );

                if (
                    (tag_is_in_input($(this).html()) == 1)
                    &&
                    ($(this).html() != '')
                ) {
                    var tag = $(this).html();
                    if (tag != '') {
                        $(".tags-fieldset li[tag='" + tag + "']").addClass('selected')
                    }
                }
            }
        );

        /*
         * If the text in the input box is changed,
         * change the class of the <li>s
         */
        $( 'input:#tags').bind (
            "keyup",
            function(){
                $('.tags-fieldset li[tag]').each(
                    function(){
                        var tag = $(this).html();
                        if (
                            (tag_is_in_input($(this).html()) == 1)
                            &&
                            ($(this).html() != '')
                        ){
                            $(".tags-fieldset li[tag='" + tag + "']").addClass('selected')
                        } else {
                            $(".tags-fieldset li[tag='" + tag + "']").removeClass('selected')
                        }
                    }
                );
            }
        );

        /**
         * When one of the library radios is selected,
         * only show relevant tags 
         */
        $( '#library-selector input:radio:checked').each(
            function() {
                var library_id = $(this).val();
                $('div.library').each(function() {$(this).hide();});
                $('div.library.' + library_id).show();
            }
        );
        $( '#library-selector input:radio').bind (
            "change",
            function(){
                var library_id = $(this).val();
                $('div.library').each(function() {$(this).fadeOut('fast');});
                $('div.library.' + library_id).fadeIn();
            });

        /*
         * When any radio button is checked, give it's label a css class
         */
        $('input:radio:checked').each (
            function() {
                $(this).parent().siblings('label').removeClass('checked');
                $(this).parent().addClass('checked');
            });
        $('input:radio').bind (
            "change",
            function() {
                $(this).parent().siblings('label').removeClass('checked');
                $(this).parent().addClass('checked');
            });

        /*
         * Highlight any empty input text boxes
         */
        $('input:text[value=""]').each (
            function() {
                $(this).addClass('empty');
            });
        $('input:text', $('#basic-form')).live(
            "keyup focus blur change",
            function(event) {
                if ($(this).val().trim() == '') {
                    $(this).addClass('empty');
                } else {
                    $(this).removeClass('empty');
                }

                if ( 
                    (event.type == 'focusout')
                    &&
                    ($(event.target).attr('id') == 'providers_internal_id') 
                    &&
                    (!($(event.target).val().trim() == ''))
                    &&
                    ($('#external_video_provider_ids input:radio:checked').length > 0)
                ){
                    check_for_providers_internal_id_in_database(
                        $('#external_video_provider_ids input:radio:checked').val(),
                        $(event.target).val()
                    );
                }
            });

        /*
         * On form submit, alert if any textboxes are empty
         */
        $('form').submit(function() {
                var validate = true;
                $(this).find('input:text').each(function() {
                        if ($(this).val().trim() == '') {
                            alert('Please fill in the ' + $(this).siblings('label').html() + '!');
                            $(this).focus();
                            validate = false;
                            return false;
                        } 
                    });
                return validate;
            });

        /*
         * Live check for provider code in database
         */
        $('form#basic-form').before('<div id="form-validity-msg">Enter video details</div><div id="form-validity-loading">Loading...</div>');
        $('#form-validity-loading').hide();

        if ($('form#basic-form').attr('name') == 'edit_something_form') {
            check_for_providers_internal_id_in_database(
                $('#external_video_provider_ids input:radio:checked').val(),
                $('input#providers_internal_id').val()
            );
        }
        $('input:radio', $('#external_video_provider_ids')).live(
            "change",
            function(event) {
                if (!( $('input#providers_internal_id').val().trim() == '')){
                    check_for_providers_internal_id_in_database(
                        $('#external_video_provider_ids input:radio:checked').val(),
                        $('input#providers_internal_id').val()
                    );
                }
            });


    });

function check_for_providers_internal_id_in_database(
    external_video_provider_id,
    providers_internal_id
) {
    var providers_internal_id_query_url =
        '/?oo-page=1&page-class=VideoLibrary_ManageVideosAdminJSONPage&check_providers_internal_id=1&ajax=1'
    + '&external_video_provider_id=' + external_video_provider_id
    + '&providers_internal_id=' + providers_internal_id;

    $.ajax({
            method: "get",url: providers_internal_id_query_url,
            dataType: 'json',
            beforeSend: function(){$("#form-validity-msg").hide();$("#form-validity-loading").fadeIn("fast");}, //show loading just when link is clicked
            complete: function(){ $("#form-validity-loading").hide();$("#form-validity-msg").fadeIn("fast");}, //stop showing loading when the process is complete
            success: function(data){ //so, if data is retrieved, store it in html
                var msg = '';
                if ( data.result == true)
                {
                    msg = 'Video is already in the Database';
                    if ($('form#basic-form').attr('name') == 'add_something_form') {
                        $('#form-validity-msg').addClass('warning');
                        msg = msg + '!';
                    }
                    $('#form-validity-msg').html(msg);
                } else {
                    $('#form-validity-msg').removeClass('warning');
                    if ($('form#basic-form').attr('name') == 'add_something_form') {
                        msg = 'Video is OK';
                    } else {
                        msg = 'Video is new';
                    }
                    $('#form-validity-msg').html(msg);
                }
                return false;
            }
        }); 
}

function toggle_tag_on_click(tag) {

    var tag_str = $('input:#tags').val();

    var re = get_tag_regex(tag)

    if (tag_str.match(re)) {
        tag_str = tag_str.replace(re, ', ')
        /*
         *For some reason the 'g' in the regex wasn't working and it only got rid of one
         *instance of the tag in question.  I added this repetition and now it gets rid
         *of them all - don't know why, don't have time to figure it.
         */
        if (tag_str.match(re)) {
            tag_str = tag_str.replace(re, ', ')
            $('input:#tags').val(tag_str)
        }

        $('input:#tags').val(tag_str)
        clean_up_input();
        return 0;
    } else {
        if (tag_str == '') {
            tag_str = tag
        } else {
            tag_str = tag_str + ', ' + tag
        }
        $('input:#tags').val(tag_str)
        clean_up_input();
        return 1;
    }
}

function get_tag_regex(tag) {
    /***
     * Tag boundaries are either:
     * 1) begininng or end of a line
     * 2) a comma
     * (ignoring whitespace (which has to be escaped in js)
     *
     */
    return new RegExp("(^\\s*|\\s*,)\\s*" + tag + "\\s*(,|$)","gi");
}


function clean_up_input() {
    var tag_str = $('input:#tags').val()

    tag_str = tag_str.replace(/,,+/g, ',')
    tag_str = tag_str.replace(/, ,/g, ',')
    tag_str = tag_str.replace(/^\s+/, '')
    tag_str = tag_str.replace(/^,/, '')
    tag_str = tag_str.replace(/,\s*$/, '')
    tag_str = tag_str.replace(/\s\s+/g, ' ')

    $('input:#tags').val(tag_str)
}

function tag_is_in_input(tag) {
    var tag_str = $('input:#tags').val()
    var re = get_tag_regex(tag);
    if (tag_str.match(re)) {
        return 1;
    }
    return 0;
}
