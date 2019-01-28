$(function () {
    $("#valid").click(function () {
        var username = document.getElementById("id_usuario").value;
        var pass = document.getElementById("password").value;
        if (username != "" && pass != "") {
            $(".admin").addClass("uper").delay(100).fadeOut(100);
            $(".cms").addClass("downer").delay(150).fadeOut(100);
        }
    });
});