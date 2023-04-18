<?php include 'header.php';?>

<body data-bs-theme="dark" class="d-flex vh-100 text-center" style="box-shadow: inset 0px 0px 30em black">
<div class="cover-container w-100 d-flex justify-content-around p-3 mx-auto flex-column">
    <main class="inner cover p-4" style="background-color: rgba(0, 0, 0, .8); background-blend-mode: multiply;">
        <div class="alert alert-success" role="alert">
            Account created!
        </div>
        <h1 class="cover-heading mb-auto">LOGIN</h1>
        <div class="align-self-center">
            <input type="text" id="email" class=" m-2 w-50" placeholder="Email"></input>
            <input type="password" id="password" class="m-2 w-50" placeholder="Password"></input>
        <div>
        <button class="btn btn-primary m-3" onclick="attemptLogin();">LOGIN</button>
    </main>
 </div>

<?php include 'footer.php';?>
</body>