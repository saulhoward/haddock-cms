/**
 * A bit of JS magic to sort out the left navigation div.
 *
 * (c) copyright 2010-02-02, Robert Impey
 */

function fixLeftNavigationDiv()
{
	/*
	 * First sort out the left navigation div.
	 */
	var leftNavigationDiv = document.getElementById('directory_navigation');
	
	leftNavigationDiv.style.width = "auto";
	
	/*
	 * Fix the content div.
	 */
	var contentDiv = document.getElementById('directory_contents');
	
	var contentDivMarginLeft = 0;
	
	contentDivMarginLeft += leftNavigationDiv.clientWidth;
	
	contentDivMarginLeft += 6;
	
	contentDivMarginLeft += "px";
	
	contentDiv.style.marginLeft = contentDivMarginLeft;
	
	/*
	 * Fix the height.
	 */
	
	var leftHeight = leftNavigationDiv.clientHeight;
	var contentHeight = contentDiv.clientHeight;
	
	if (leftHeight > contentHeight) {
		contentDiv.style.height = leftHeight + "px";
	} else {
		leftNavigationDiv.style.height = contentHeight + "px";
	}
}
