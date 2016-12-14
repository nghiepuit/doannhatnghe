function changeStatus(url){
    $.ajax({
        type: "POST",
        url: url,
        success: function(data){
            var data = $.parseJSON(data);
            var id = data[0];
            var status = data[1];
            var link = data[2];
            $("a#status-"+id).attr("href","javascript:changeStatus('"+ link +"')");
            if(status){
                $("a#status-"+id + " i").removeClass("fa-dot-circle-o").addClass("fa-check-circle");
            }else{
                $("a#status-"+id + " i").removeClass("fa-check-circle").addClass("fa-dot-circle-o");
            }
        }
    });
}

function changeACP(url){
    $.ajax({
        type: "POST",
        url: url,
        success: function(data){
            var data = $.parseJSON(data);
            var id = data[0];
            var acp = data[1];
            var link = data[2];
            $("a#acp-"+id).attr("href","javascript:changeACP('"+ link +"')");
            if(acp){
                $("a#acp-"+id + " i").removeClass("fa-dot-circle-o").addClass("fa-check-circle");
            }else{
                $("a#acp-"+id + " i").removeClass("fa-check-circle").addClass("fa-dot-circle-o");
            }
        }
    });
}

function submitForm(url) {
    $("#frmAdmin").attr("action",url);
    $("#frmAdmin").submit();
}

function changePage(page){
    $("input[name=filter_page]").val(page);
    $("#frmAdmin").submit();
}

$(document).ready(function () {

    $("input[name=checkall-group]").change(function () {
        var isChecked = this.checked;
        $("#frmAdmin").find(":checkbox").each(function () {
            this.checked = isChecked;
        });
    });

    $("select[name=group_id]").change(function () {
        $("#frmAdmin").submit();
    });

    $("select[name=parent_id]").change(function () {
        $("#frmAdmin").submit();
    });

});