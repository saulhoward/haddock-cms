// perform JavaScript after the document is scriptable. 
$(function() { 
	$('.tags-empty-links-list li').each(
		function(intIndex){
			 $( this ).bind (
				 "click",
				 function(){
					 //alert( "Hottie index: " + intIndex );
					 //alert( "Hottie index: " + $(this).html() );
					if (toggle_tag_on_click($(this).html()) == 1 ) {
						$(this).addClass('selected')
					} else {
						$(this).removeClass('selected')
					}
				 }
			 );

			 if (tag_is_in_input($(this).html()) == 1) {
					$(this).addClass('selected')
			 }
		}
	);
});

function toggle_tag_on_click(tag) {

	var tag_str = $('input:#tags').val()

	//var re = new RegExp('/\b' + tag + "\b/","i");
	var re = new RegExp("\\b" + tag + "\\b","i");
	if (tag_str.match(re)) {
		//var re = new RegExp(tag,"gi");
		tag_str = tag_str.replace(re, '')
		$('input:#tags').val(tag_str)
		clean_up_input();
		return 0;
	} else {
		tag_str = tag_str + ', ' + tag
		$('input:#tags').val(tag_str)
		clean_up_input();
		return 1;
	}

	//alert(tag_str);

}

function clean_up_input() {
	var tag_str = $('input:#tags').val()
	tag_str = tag_str.replace(/\s\s+/g, '')
	tag_str = tag_str.replace(/,,+/g, '')
	tag_str = tag_str.replace(/, ,/g, ',')
	tag_str = tag_str.replace(/^\s/, '')
	tag_str = tag_str.replace(/^,/g, '')

	$('input:#tags').val(tag_str)
}

function tag_is_in_input(tag) {
	var tag_str = $('input:#tags').val()
	var re = new RegExp("\\b" + tag + "\\b","i");
	if (tag_str.match(re)) {
	//alert('wtf')
		return 1;
	}
	return 0;
}
