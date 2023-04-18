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

  <div class="container2">
    <div class="registration-form">
        <form>
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div id="errorfield" class="errorField"></div>

                <script src="../controller/loginForm.js"></script>
                <script src="../jquery-3.6.3.js"></script>
                <div class="form-group">
                    <label for="email">Handle/Email:</label>
                    <input type="text" class="form-control item" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control item" id="password" name="password"> <br>
                </div>
                <button type="button" onclick="checkLogin()" class="btn btn-block create-account">LOG IN</button>
                <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
                <script src="view/script.js"></script>
            </form>
        </div>
    </div>
</body>

</html>