
//var arrData = '<?php echo $data; ?>';

// dynamic element_id which possible fetch from current url and use for ajax content displaying 
var el_id;


function handleAjaxLink(e) {

    e.preventDefault();

    var
            $link = $(e.target),
            callUrl = $link.attr('href'),
            formId = $link.data('formId'),
            onDone = $link.data('onDone'),
            onFail = $link.data('onFail'),
            onAlways = $link.data('onAlways'),
            ajaxRequest;

    alert("ccc: " + callUrl + ",   link:" + $link + ",  formId:" + formId);

    var array_element = callUrl.split("&");
    // find category 'name'
    var element_id = array_element[1].split("=");
    // replace category name in URL if name has the following view PORTABLE+ELECTRONICS
    // to view PORTABLE_ELECTRONICS for id
    let result = element_id[1].replace(/(\w+)\+(\w+)/, (...match) => `${match[1]}_${match[2]}`);
    el_id = result;

    // find category 'depth'
    //var element_depth = array_element[2].split("=");
    // find category 'currState'
    var currState = array_element[2].split("=");

    alert("state:" + currState[1]);

    // when csrf validation enabled !!!
    //var csrfToken = $('meta[name="csrf-token"]').attr("content");
    //alert(csrfToken);

    // alert("arrData: " + tempArray[0]["name"]);

    if ($('#li_' + el_id).next().children().length <= 0) {

        alert("=1=");

        currState[1] = "1";
        var state = currState[0] + "=" + currState[1];

        array_element.pop();
        array_element.push(state);
        callUrl = array_element.join("&");

        ajaxRequest = $.ajax({
            type: "post",
            dataType: 'html',
            // data: { _csrf: csrfToken },
            url: callUrl,
            // data: (typeof formId === "string" ? $('#' + formId).serializeArray() : null) 
            data: tempArray
        });

        // Assign done handler
        if (typeof onDone === "string" && ajaxCallbacks.hasOwnProperty(onDone)) {
            ajaxRequest.done(ajaxCallbacks[onDone]);
        }

        // Assign fail handler
        if (typeof onFail === "string" && ajaxCallbacks.hasOwnProperty(onFail)) {
            ajaxRequest.fail(ajaxCallbacks[onFail]);
        }

        // Assign always handler
        if (typeof onAlways === "string" && ajaxCallbacks.hasOwnProperty(onAlways)) {
            ajaxRequest.always(ajaxCallbacks[onAlways]);
        }

    }
    // depth = 0
    else {

        alert("=0=");

        $('#li_' + el_id).next().empty();

        // alert(id);
    }

}

var ajaxCallbacks = {

    'simpleDone': function (response) {
        // This is called by the link attribute 'data-on-done' => 'simpleDone'
        console.dir(response);
        $('#' + el_id).html(response);
    },

    'linkFormDone': function (response) {
        // This is called by the link attribute 'data-on-done' => 'linkFormDone';
        // the form name is specified via 'data-form-id' => 'link_form'
        $('#' + el_id).html(response);
    }

}