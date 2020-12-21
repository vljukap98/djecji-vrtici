$(document).ready(function () {
    $("#registriraj").on("click", function (event) {
        var OIBPattern = new RegExp(/^\d{11}$/);
        var nameSurnamePattern = new RegExp(/^[A-ZČŠĆŽĐa-zčćžđš]+[^\d]{2,50}$/);
        var usernamePattern = new RegExp(/^([a-zA-Z]+(\d?)+){5,20}$/);
        var emailPattern = new RegExp(/^([a-zA-Z]+(\d?)+)(@)([a-zA-Z]+)(.com||.hr||.info){15,50}$/);
        var passwordPattern = new RegExp(/^(?=.*\d)(?=.*[A-Z])(?!.*[^a-zA-Z0-9@#$^+=])(.{8,20})$/);

        if(!OIBPattern.test($("#oib").val())) {
            $("#oib").css("border-color", "red");
            event.preventDefault();
        } else {
            $("#oib").css("border-color", "none");
        }
        if(!nameSurnamePattern.test($("#ime").val())) {
            $("#ime").css("border-color", "red");
            event.preventDefault();
        } else {
            $("#ime").css("border-color", "none");
        }
        if(!nameSurnamePattern.test($("#prezime").val())) {
            $("#prezime").css("border-color", "red");
            event.preventDefault();
        } else {
            $("#prezime").css("border-color", "none");
        }
        if(!usernamePattern.test($("#korisnicko_ime").val())) {
            $("#korisnicko_ime").css("border-color", "red");
            event.preventDefault();
        } else {
            $("#korisnicko_ime").css("border-color", "none");
        }
        if(!emailPattern.test($("#email").val())) {
            $("#email").css("border-color", "red");
            event.preventDefault();
        } else {
            $("#email").css("border-color", "none");
        }
        if(!passwordPattern.test($("#lozinka").val())) {
            $("#lozinka").css("border-color", "red");
            event.preventDefault();
        } else {
            $("#lozinka").css("border-color", "none");
        }
        if($("#lozinka").val() != $("#ponovno").val()) {
            $("#ponovno").css("border-color", "red");
            event.preventDefault();
        } else {
            $("#ponovno").css("border-color", "none");
        }
    });
})
var code;

function createCaptcha() {
    document.getElementById('captcha').innerHTML = "";
    var charsArray =
    "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
    var lengthOtp = 6;
    var captcha = [];
    for (var i = 0; i < lengthOtp; i++) {
      var index = Math.floor(Math.random() * charsArray.length + 1);
      if (captcha.indexOf(charsArray[index]) == -1)
        captcha.push(charsArray[index]);
      else i--;
    }
    var canv = document.createElement("canvas");
    canv.id = "captcha";
    canv.width = 100;
    canv.height = 50;
    var ctx = canv.getContext("2d");
    ctx.font = "25px Georgia";
    ctx.strokeText(captcha.join(""), 0, 30);
    code = captcha.join("");
    document.getElementById("captcha").appendChild(canv); 
  }
  function validateCaptcha() {
    debugger
    if (!(document.getElementById("cpatchaTextBox").value == code)) {
      alert("Pogrešan CAPTCHA!");
        event.preventDefault();
        createCaptcha();
    }
  }