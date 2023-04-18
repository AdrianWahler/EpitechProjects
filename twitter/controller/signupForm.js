
function formError(message){
    $('#errorfield').text(message);
    $('#errorfield').show();
    $('#errorfield').addClass("alert");
    $('#errorfield').addClass("alert-danger");
}

function checkSignupForm()
{
    console.log("checking form...")
    firstname = $('#firstName').val()
    lastName = $('#lastName').val()
    birthdate = $('#birthdate').val()
    handle = $('#handle').val()
    email = $('#email').val()
    password = $('#password').val()

    var newBirthDate = new Date($('#birthDate').val())
    var ageDiff = Date.now() - newBirthDate.getTime();
    var userAge = new Date(ageDiff);
    var userAge = Math.abs(userAge.getUTCFullYear() - 1970);
    
    if (userAge<14) {
        formError("You must be over 14 to register.");
        return false;
    }

    $.ajax({
        url: "../model/addUserToDatabase.php",
        type: "POST",
        data: {
            firstName : $('#firstName').val(),
            lastName : $('#lastName').val(),
            password : $('#password').val(),
            birthDate : $('#birthDate').val(),
            email : $('#email').val(),
            handle : $('#handle').val(),
        },
        success: function(data) {   
            document.location.href = "http://localhost/twitter/view/loginForm.php";
        },error: function(jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR.responseText);
          console.log(errorThrown);
        }
    });


}