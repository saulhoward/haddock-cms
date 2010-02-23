/** 
 * VideoLibrary_ManageExternalVideosPage.js
 * Using JQuery
 */

$(function() { 

	/*
	 * Expecting a list of names of tags
	 * If any of the <li>s are clicked, 
	 * toggle the presence of that tag in the input
	 * box
	 */
	$('.tags-fieldset li[tag]').each(
		function(intIndex){
			 $( this ).bind (
				 "click",
				 function(){
                 var tag = $(this).html();
					if (toggle_tag_on_click($(this).html()) == 1 ) {
                        // $(this).addClass('selected')
                        $(".tags-fieldset li[tag='" + tag + "']").addClass('selected')
					} else {
                        // $(this).removeClass('selected')
                        $(".tags-fieldset li[tag='" + tag + "']").removeClass('selected')
					}
				 }
			 );

			 if (tag_is_in_input($(this).html()) == 1) {
                    var tag = $(this).html();
                    if (tag != '') {
                    $(".tags-fieldset li[tag='" + tag + "']").addClass('selected')
                    // $(this).addClass('selected')
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
			$('.tags-empty-links-list li').each(
				function(){
					 if (tag_is_in_input($(this).html()) == 1) {
							$(this).addClass('selected')
					 } else {
						$(this).removeClass('selected')
					}
				}
			);
		}
	);


});

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
