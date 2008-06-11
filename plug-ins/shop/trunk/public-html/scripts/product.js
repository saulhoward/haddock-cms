// prepare the form when the DOM is ready
$(document).ready(function() {
    var options = {
        target:        '#form_notification_div',   // target element(s) to be updated with server response
        beforeSubmit:  validate,  // pre-submit callback
        success:       showResponse,  // post-submit callback
        url:       '/?section=plug-ins&module=shop&page=product&type=xml&add_comment=1', // override for form's 'action' attribute
        clearForm: false,        // clear all form fields after successful submit

        // other available options:

        //type:      type        // 'get' or 'post', override for form's 'method' attribute
        //dateType:  null        // 'xml', 'script', or 'json' (expected server response type)
        resetForm: true        // reset the form after successful submit
        // $.ajax options can be used here too, for example:
        //timeout:   3000
    };

    // bind form using 'ajaxForm'
    $('#comment-form').ajaxForm(options);

	//$('#form_notification_div: textarea').clearFields();
    
        //$("#form_notification_div :input").focus(function() {this.toggleClass('focused');});
        //$("#form_notification_div :input").blur(function() {this.toggleClass('focused');});
});

// pre-submit callback
function showRequest(formData, jqForm, options) {
    // formData is an array; here we use $.param to convert it to a string to display it
    // but the form plugin does this for you automatically when it submits the data
    var queryString = $.param(formData);

    // jqForm is a jQuery object encapsulating the form element.  To access the
    // DOM element for the form do this:
    // var formElement = jqForm[0];

    alert('About to submit: \n\n' + queryString);

    // here we could return false to prevent the form from being submitted;
    // returning anything other than false will allow the form submit to continue
    return true;
}

// post-submit callback
function showResponse(responseText, statusText)  {
    // for normal html responses, the first argument to the success callback
    // is the XMLHttpRequest object's responseText property

    // if the ajaxForm method was passed an Options Object with the dataType
    // property set to 'xml' then the first argument to the success callback
    // is the XMLHttpRequest object's responseXML property

    // if the ajaxForm method was passed an Options Object with the dataType
    // property set to 'json' then the first argument to the success callback
    // is the json data object returned by the server

    $('#form_notification_div').fadeIn('slow'); 
}

function validate(formData, jqForm, options) {
    // formData is an array of objects representing the name and value of each field
    // that will be sent to the server;  it takes the following form:
    //
    // [
    //     { name:  username, value: valueOfUsernameInput },
    //     { name:  password, value: valueOfPasswordInput }
    // ]
    //
    // To validate, we can examine the contents of this array to see if the
    // username and password fields have values.  If either value evaluates
    // to false then we return false from this method.

    for (var i=0; i < formData.length; i++) {
        if (!formData[i].value) {
            var idOfInput = formData[i].name;
            
            $('#form_notification_div').html('<p>Please complete&nbsp;' + idOfInput + '</p>'); 
            $('#form_notification_div').fadeIn('slow');
            
            $(' #'+idOfInput).focus();
            //$('#'+idOfInput).toggleClass('focused');
            return false;
        }
    }
    //alert('Both fields contain values.');
    return true;
}

// Focus set class name for ie

inputFocus = function()
    {
        $("#form_notification_div :input").focus(function() {this.toggleClass('focused');});
        $("#form_notification_div :input").blur(function() {this.toggleClass('focused');});

    }
