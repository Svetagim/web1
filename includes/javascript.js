/*
window.onload=function(){
    console.log(" I'm in");

    document.getElementById("toExecute").onclick=function () {
        console.log("clicked first");
        var obj = document.getElementById( "messageAlert");
        obj.style.display = "block";
    }

    document.getElementById("btnSubmitFirstPart").onclick=function () {
        console.log("clicked second");
        var objFirst = document.getElementById( "messageAlert");
        objFirst.style.display = "none";
        var objSecond = document.getElementById( "messageInput");
        objSecond.style.display = "block";
    }

    document.getElementById("cancel1").onclick=function () {
        console.log("clicked first");
        var obj = document.getElementById( "messageAlert");
        obj.style.display = "none";
    }



    document.getElementById("cancel2").onclick=function () {
        console.log("clicked second");
        var objFirst = document.getElementById( "messageAlert");
        objFirst.style.display = "block";
        var objSecond = document.getElementById( "messageInput");
        objSecond.style.display = "none";
    }

}*/

$(document).ready(function() {
    $.getJSON("data/groups.json", function(data) {
        console.log(data);
    });
});
