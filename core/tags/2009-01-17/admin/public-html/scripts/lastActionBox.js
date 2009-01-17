// Script to hide the element with id lastActionBox when the link lastActionBoxHide is clicked, uses moo fx
// by Clear Line Web Design
// (c) 2006 clearlinewebdesign.com
// SANH & RFI 02/10/06
//
//
window.onload = lastActionBoxStart;
var lastActionBoxHeight; 

function lastActionBoxStart() {
                       if (document.getElementById('lastActionBox'))//make sure were on a newer browser
	{
      
      changeLastActionBoxHideHref();
      
               lastActionBoxOpacity = new fx.Opacity('lastActionBox', {duration: 200});
               lastActionBoxHeight = new fx.Height('lastActionBox', {duration: 200});
               
               // lastActionBoxHeight.hide();
                     //lastActionBoxHeight.toggle();	
                               
               $('lastActionBoxHide').onclick = function() {
                       
                       lastActionBoxOpacity.toggle();
                       lastActionBoxHeight.toggle();
                       return false;
               };
        }
       }
                
function changeLastActionBoxHideHref()
{

	var lastActionBoxHide = document.getElementById('lastActionBoxHide'); // get the Link in the box

        lastActionBoxHide.href = '#';
}
               

                 