$(document).ready(function() {
    $.getJSON("data/groups.json", function(data) {
        $.each(data.groupsdata, function(){
            $('#groups-list').append("<a href='groups.php?groupId="+this.groupid+"&groupName="+this.name+"' class='card'><img class='card-img-top' src=" + this.photo + " alt='Card image cap'><div class='card-body'><h5 class='card-title'>"+this.name+"</div></a>");
        });
    });
    $.getJSON("data/reminders.json", function(data) {
        var index = 1;
        $.each(data.reminders, function() {   
            $('#treatment_box_modal-body').append("<div class='form-check'><input class='form-check-input' type='radio' name='reminder' id='reminder" + index + "' value='" + this.text + "' checked><label class='form-check-label'>"+this.text+"</label></div>");
            index++;
        });
    });
});