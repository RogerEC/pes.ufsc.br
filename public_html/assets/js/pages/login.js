$(document).ready(function(){
    $("#user").keyup(function(){
        $("#unknownError").hide();
        $("#errorUser").hide();
        $("#user").removeClass("is-invalid");
    });

    $("#password").keyup(function(){
        $("#unknownError").hide();
        $("#errorPassword").hide();
        $("#password").removeClass("is-invalid");
    })
})
