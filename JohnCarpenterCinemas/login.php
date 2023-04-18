<?php include 'header.php';?>

<body data-bs-theme="dark" class="d-flex vh-100 text-center" style="box-shadow: inset 0px 0px 30em black">
 
<div class="cover-container w-100 d-flex justify-content-around p-3 mx-auto flex-column">
    <div class="container">
        <h4>Login<h4>
        <div class="m-4">
            <input type="text" id="email" placeholder="Email Adress">
            <input type="password" id="password" placeholder="Password">
        </div>
        <p id="errormessage"><p>
        <button class="btn btn-primary m-4" onclick="checkUserLogin()">Login</button>
    </div>
</div>

<?php include 'footer.php';?>
</body>