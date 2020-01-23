$(document).ready(function()
{
    console.log("js is ready");
    $("#hideLogin").click(function() //hide the login form when user want to register
    {
        $("#loginForm").hide();
        $("#registerForm").show();
    });

    $("#hideRegister").click(function() //hide the register form when user want to log in
    {
        $("#loginForm").show();
        $("#registerForm").hide();
    });
    // . is used for class and # is used for id :D
});