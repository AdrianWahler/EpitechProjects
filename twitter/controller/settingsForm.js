function updateUserProfile()
{
    $.ajax({
        url: "model/updateUserProfile.php",
        type: "POST",
        data: {
            firstname : $('#firstname').val(),
            lastname : $('#lastname').val(),
            email : $('#email').val(),
            password : $('#password').val(),
            city : $('#city').val(),
            username : $('#username').val(),
            bio : $('#bio').val(),
        },
        success: function(data) {
            console.log(data);
        },error: function(jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR.responseText);
          console.log(errorThrown);
        }
    });

}