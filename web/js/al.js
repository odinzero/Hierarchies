
//var form_info = [];

function menuClick_al(e) {

    e.preventDefault();
    
     var $link = $(e.target),
         id_target = $link.attr('id');

    var arr_id = [];
    var arr_style = [];
    var arr_children = [];

    // = children other levels =
    $('#' + id_target).next("ul").find('a').each(function () {
        // alert( "all:" + $(this).attr('id'));
        arr_children.push($(this).attr('id'));
    });

    // = children first level =    
    $('#' + id_target).next("ul").children().each(function () {
        // alert( "fl: " + $(this).find('a').attr('id'));

        arr_id.push($(this).find('a').attr('id'));

        arr_style.push($(this).find('a').attr('style'));
    });

    // var arr_otherChildren =
    var arr_otherChildren = compareTwoArrays(arr_children, arr_id);

    for (var i = 0; i < arr_id.length; i++) {
        // show childs of first level
        if (arr_style[i] === "display: none;") {
            $('#' + arr_id[i]).attr('style', 'display: inline;');
            // close childs of first level   
        } else if (arr_style[i] === "display: inline;") {
            $('#' + arr_id[i]).attr('style', 'display: none;');
            // close childs other levels
            for (var k = 0; k < arr_otherChildren.length; k++) {
                $('#' + arr_otherChildren[k]).attr('style', 'display: none;');
                //alert(arr_otherChildren[k]);
            }
        }
    }

//    if (!$('#' + id_target).next().closest('ul').is(':hidden')) {
//        alert("h");
//        $('#' + id_target).next().closest('ul').show();
//        for (var i = 0; i < arr1.length; i++) {
//            $('#' + arr1[i]).attr('style', 'display: inline');
//        }
//    } else {
//        alert("nh");
//        $('#' + id_target).next().closest('ul').hide();
//         for (var i = 0; i < arr1.length; i++) {
//            $('#' + arr1[i]).attr('style', 'display: none');
//        }
//    }

}

function submitForm_al(e) {
    // alert("HHH");

    // name 'Category'
    var main_parent = '_1';
    
    //form_info.push($('#' + main_parent).attr('id'));
      var input = $("<input>")
                .attr("type", "hidden")
                .attr("name", "id[" + 9 + "]").val("inline");
    $('#menu-ajacent-list-form').append(input);
    
    // = children other levels =
    $('#' + main_parent).next("ul").find('a').each(function () {
        // alert( "all:" + $(this).attr('id'));
       // form_info.push($(this).attr('id'));
        
        var el_id = $(this).attr('id').split("_");
        var st = $(this).attr('style').split(" ");
        var style = st[1].split(";");

        var input = $("<input>")
                .attr("type", "hidden")
                .attr("name", "id[" + el_id[1] + "]").val("" + style[0]);
        $('#menu-ajacent-list-form').append(input);
    });

    //alert("submit");
    var $link = $(e.target),
        callUrl = $link.attr('href');

    var selected = callUrl.split('&'); 
    var sel_label = selected[1].split('=');
    
    var input = $("<input>")
                .attr("type", "hidden")
                .attr("name", "selectedCategory[selectedCategory]").val("" + sel_label[1]);
        $('#menu-ajacent-list-form').append(input);
    
    document.getElementById('menu-ajacent-list-form').submit();
}

