function checkLogin()
{
    login = $('#email').val();
    password = $('#password').val();

    $.ajax({
        url: "../model/checkLogin.php",
        type: "POST",
        data: {
            login : login,
            password : password
        },
        success: function(data) {
            if (data == "true") {
                document.location.href = "http://localhost/twitter/homepage.php";
            } else {
                $(".errorField").text("Wrong username/password.");
                $(".errorField").show();
            }

        },error: function(jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR.responseText);
          console.log(errorThrown);
        }
    });

}