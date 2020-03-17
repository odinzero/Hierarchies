function menuClick(e) {

    e.preventDefault();

    var $link = $(e.target),
            callUrl = $link.attr('href'),
            id_target = $link.attr('id');

    var array_callUrl = callUrl.split("&");
    var id_callUrl = array_callUrl[1].split("=");
    var click_callUrl = array_callUrl[4].split("=");

    // alert(id_callUrl[1]);

    var arr_id = [];
    var arr_allclicks = [];
    var arr_allid = [];
    $("#main-menu a").each(function () {

        var array_element = $(this).attr('href').split("&");
        var id = array_element[1].split("=");
        var click = array_element[4].split("=");

        // alert(id[1]);
        arr_allid.push({
            ids: id[1],
            clicks: click[1]
        });

        if (id[1] === id_callUrl[1]) {

            if (click_callUrl[1] === "false") {
                click[1] = "true";
            } else if (click_callUrl[1] === "true") {
                click[1] = "false";
            }


            var input = $("<input>")
                    .attr("type", "hidden")
                    .attr("name", "id[" + id[1] + "]").val("" + id[1] + "_" + "true");
            $('#menu-tree-form').append(input);

            arr_id.push({
                ids: id[1],
                clicks: click[1]
            });

            // = parents =
            $('#' + id_target).parents('li').each(function () {

                if ("_" + id_callUrl[1] !== $(this).find('a').attr("id")) {
                    //alert($(this).find('a').attr("id"));
                    //alert("id: " + id[1]);
                    var id_parent = $(this).find('a').attr("id").split("_");
                    var input = $("<input>")
                            .attr("type", "hidden")
                            .attr("name", "id[" + id_parent[1] + "]").val("" + id[1] + "_" + "true");
                    $('#menu-tree-form').append(input);
                    // arr_id.push(id_parent[1]);
                    arr_id.push({
                        ids: id_parent[1],
                        clicks: click[1]
                    });
                }
            });

            // = children =
            $('#' + id_target).next("ul").children().each(function () {

                alert("1: " + $(this).find('*').attr("id"));


                $(this).find('*').next("ul").children().each(function () {

                    alert("2: " + $(this).find('*').attr("id"));
                    var id_child = $(this).find('a').attr("id").split("_");
                    var input = $("<input>")
                            .attr("type", "hidden")
                            .attr("name", "id[" + id_child[1] + "]").val("" + id[1] + "_" + click[1]);
                    $('#menu-tree-form').append(input);
                });

                var id_child = $(this).find('a').attr("id").split("_");
                var input = $("<input>")
                        .attr("type", "hidden")
                        .attr("name", "id[" + id_child[1] + "]").val("" + id[1] + "_" + click[1]);
                $('#menu-tree-form').append(input);

                arr_id.push({
                    ids: id_child[1],
                    clicks: click[1]
                });
            });
        }

    });

    var arr_otherClicks = compareTwoAssotiativeArrays(arr_allid, arr_id);

    for (var i = 0; i < arr_otherClicks.length; i++) {

        // alert("id: " + arr_otherClicks[i].ids);
        var input = $("<input>")
                .attr("type", "hidden")
                .attr("name", "id[" + arr_otherClicks[i].ids + "]").val("" + arr_otherClicks[i].ids +
                "_" + arr_otherClicks[i].clicks);
        $('#menu-tree-form').append(input);
    }


    document.getElementById('menu-tree-form').submit();
//    
//    $(document).ready(function() { 
//    $('li a').click(function() {
//        $('#menu-tree-form').submit();
//    });
//});
}