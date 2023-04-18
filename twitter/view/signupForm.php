<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../view/style.css">
</head>


<body>
    <div class="registration-form">
        <form>
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div id="errorfield" style="visibility: hidden"></div>
            <script src="../controller/signupForm.js"></script>
            <script src="../jquery-3.6.3.js"></script>
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" class="form-control item" id="firstName" name="firstName">
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control item" id="lastName" name="lastName"> <br>
            </div>
            <div class="form-group">
                <label for="birthDate">Birth Date:</label>
                <input type="date" class="form-control item" id="birthDate" name="birthDate"> <br>
            </div>
            <div class="form-group">
                <label for="handle">Handle:</label>
                <input type="text" class="form-control item" id="handle" name="handle"> <br> <!-- Mettre un @ en visuel devant le bouton ?-->
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control item" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control item" id="password" name="password">
            </div>

            <button type="button" onclick="checkSignupForm()" class="btn btn-block create-account">SIGN UP</button>
            <div class="social-media">
                <h5>Sign up with social media</h5>
                <div class="social-icons">
                    <a href="#"><i class="icon-social-facebook" title="Facebook"></i></a>
                    <a href="#"><i class="icon-social-google" title="Google"></i></a>
                    <a href="#"><i class="icon-social-twitter" title="Twitter"></i></a>
                </div>
            </div>
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
            <script src="../view/script.js"></script>
        </form>
    </div>

</body>

</html>