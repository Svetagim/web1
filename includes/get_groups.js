$(document).ready(function() {
    $.getJSON("data/groups.json", function(data) {
        console.log(data);
        $.each(data.groupsdata, function(){
            $('#groups-list').append("<a href='groups.php?groupId="+this.groupid+"&groupName="+this.name+"' class='card'><img class='card-img-top' src=" + this.photo + " alt='Card image cap'><div class='card-body'><h5 class='card-title'>"+this.name+"</div></a>");
        });
    });
});
