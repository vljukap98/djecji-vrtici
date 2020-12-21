$(document).ready(function () {
    $("#prijavi").on("click", function (event) {
        if(!$("korisnicko_ime").val().length === 0) {
            $("#korisnicko_ime").css("border-color", "red");
            event.preventDefault();
        } else {
            $("#korisnicko_ime").css("border-color", "none");
        }

        if(!$("lozinka").val().length === 0) {
            $("#lozinka").css("border-color", "red");
            event.preventDefault();
        } else {
            $("#lozinka").css("border-color", "none");
        }
    });
})