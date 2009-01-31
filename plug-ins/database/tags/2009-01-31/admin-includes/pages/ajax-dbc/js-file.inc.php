// JavaScript Functions to find classes for Database Elements
//
// Uses code from "Building Repsonsive Web Applications: AJAX and PHP"
// http://www.amazon.co.uk/AJAX-PHP-Building-Responsive-Applications/dp/1904811825/ref=pd_bbs_sr_1/202-8079250-8084663?ie=UTF8&s=books&qid=1178116054&sr=8-1
//
// © Clear Line Web Design, 2007-05-02

// stores the reference to the XMLHttpRequest object

var xmlHttp = createXmlHttpRequestObject();

// retrieves the XMLHttpRequest object

function createXmlHttpRequestObject()
{
    // will store the reference to the XMLHttpRequest object
    var xmlHttp;
    
    if (window.ActiveXObject) { // if running IE
        try {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {
            xmlHttp = false;
        } 
    } else { 
        try {
            xmlHttp = new XMLHttpRequest();
        } catch (e) {
            xmlHttp = false;
        }
    }
    
    if (!xmlHttp) {
        alert("Error creating the XMLHttpRequest object.");
    } else {
        return xmlHttp;
    }
}

// make asynchronous HTTP request using the XMLHttpRequest object
function process()
{
    // proceed only if the xmlHttp object isn't busy
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0) {
        xmlHttp.open("GET", "/admin/xml-renderer.php?module=database&page=ajax-dbc", true);
        // define the method to handle the server responses
        xmlHttp.onreadystatechange = handleServerResponse;
        // make the server request
        xmlHttp.send(null);
    } else {
        // if the connection is busy, try again after one second.
        setTimeout('process()', 1000);
    }
}

// executed automatically when a message is received from the server
function handleServerResponse()
{
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            xmlResponse = xmlHttp.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            databaseClasses = xmlDocumentElement.firstChild.data;
            document.getElementById("content").innerHTML
                = databaseClasses;
            
            setTimeout('process()', 1000);
        } else {
            alert("There was a problem accessing the server: " + xmlHttp.statusText);
        }
    }
}
