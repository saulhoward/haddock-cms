/**
 * Functions for wrapping a div with Round corners.
 *
 * @copyright 2008-01-24, Robert Impey
 */

function round_all_corners(class_name)
{
	var divs_to_round = document.getElementsByTagName('div');

	for (var i = 0; i < divs_to_round.length; i++) {
		var current_div = divs_to_round.item(i);
		
		if (current_div.className == class_name) {
			round_corners(current_div);
		}
	}
}

function round_corners(current_div)
{
	/*
	 * Cut the existing content of the div.
	 */
	currrent_div_inner_html = current_div.innerHTML;
	
	current_div.innerHTML = '';
	
	/*
	 * The Header.
	 */
	var div_h = document.createElement('div');
	div_h.className = 'row h horiz';

	var div_h_l = document.createElement('div');
	div_h_l.className = 'l corner';
	var div_h_c = document.createElement('div');
	div_h_c.className = 'c';
	var div_h_r = document.createElement('div');
	div_h_r.className = 'r corner';
	
	div_h.appendChild(div_h_l);
	div_h_l.appendChild(div_h_r);
	div_h_r.appendChild(div_h_c);
	
	current_div.appendChild(div_h);
	
	/*
	 * The middle.
	 */
	
	var div_m = document.createElement('div');
	div_m.className = 'row m';

	var div_m_l = document.createElement('div');
	div_m_l.className = 'l vert';
	var div_m_c = document.createElement('div');
	div_m_c.className = 'c';
	var div_m_r = document.createElement('div');
	div_m_r.className = 'r vert';

	/*
	 * Paste the previous contents into this inner div.
	 */
	div_m_c.innerHTML = currrent_div_inner_html;

	div_m.appendChild(div_m_l);
	div_m_l.appendChild(div_m_r);
	div_m_r.appendChild(div_m_c);
	
	current_div.appendChild(div_m);
	
	/*
	 * The footer.
	 */
	
	var div_f = document.createElement('div');
	div_f.className = 'row f horiz';

	var div_f_l = document.createElement('div');
	div_f_l.className = 'l corner';
	var div_f_c = document.createElement('div');
	div_f_c.className = 'c';
	var div_f_r = document.createElement('div');
	div_f_r.className = 'r corner';
	
	div_f.appendChild(div_f_l);
	div_f_l.appendChild(div_f_r);
	div_f_r.appendChild(div_f_c);
	
	current_div.appendChild(div_f);
}
