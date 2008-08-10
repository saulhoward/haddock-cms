// JS File for displaying the PHP class files in the project.
// © Clear Line Web Design, 2007-05-09

var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject()
{
    var xmlHttp;
    
    if (window.ActiveXObject) {
        try {
            xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
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
        alert('Error creating the XMLHttpRequest object!');
    } else {
        return xmlHttp;
    }
}

function process()
{
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0) {
        class_name = encodeURIComponent(document.getElementById('class_list_select').value);
        xmlHttp.open('GET', '/admin/xml-renderer.php?module=haddock-project-organisation&page=class-list&parent_class_name=' + class_name, true);
        xmlHttp.onreadystatechange = handleServerResponse;
        xmlHttp.send(null);
    } else {
        setTimeout('process()', 1000);
    }
}

function handleServerResponse()
{
    var subclasses_list_div = document.getElementById('subclasses_list');
    
    // Remove the old contents
    var old_sub_elements = subclasses_list_div.getElementsByTagName('*');
    
    for (var i = 0; i < old_sub_elements.length; i++) {
        subclasses_list_div.removeChild(old_sub_elements[i]);
    }
    
    if (xmlHttp.readyState == 4) {
        //document.write(xmlHttp.status);
        
        if (xmlHttp.status == 200) {
            var xml_response = xmlHttp.responseXML;
            var xml_root = xml_response.documentElement;
            var classes_array = xml_root.getElementsByTagName('php_class');
            
            if (classes_array.length > 0) {
                // Create a table of data.
                var html_table = document.createElement('table');
                
                //  The heading row
                var thead = document.createElement('thead');
                var heading_tr = document.createElement('tr');
                var subclass_name_th = document.createElement('th');
                subclass_name_th.appendChild(document.createTextNode('Subclasses'));
                heading_tr.appendChild(subclass_name_th);
                thead.appendChild(heading_tr);
                html_table.appendChild(thead);
                
                var tbody = document.createElement('tbody');
                for (var i = 0; i < classes_array.length; i++) {
                    var html_row = document.createElement('tr');
                    
                    var php_class_name_td = document.createElement('td');
                    
                    php_class_name_td.appendChild(document.createTextNode(classes_array[i].getAttribute('php_class_name')));
                    
                    html_row.appendChild(php_class_name_td);
                    
                    tbody.appendChild(html_row);
                }
                
                html_table.appendChild(tbody);
                
                subclasses_list_div.appendChild(html_table);
            } else {
                // apologise.
                var no_subclasses_p = document.createElement('p');
                
                no_subclasses_p.appendChild(document.createTextNode('No subclasses found!'));
                
                subclasses_list_div.appendChild(no_subclasses_p);
            }
        } else {
            var error_msg = 'There was a problem accessing the server: ' + xmlHttp.statusText;
            //alert(error_msg);
            error_p = document.createElement('p');
            
            error_p.appendChild(document.createTextNode(error_msg));
            
            subclasses_list_div.appendChild(error_p);
        }
    }
}