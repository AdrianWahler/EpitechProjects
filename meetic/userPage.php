<?php
session_start();
include 'header.php';
include 'navbar.php';
?>

<body onload="getCurrentUserCarousel($('#carouselContainer'));" data-bs-theme="dark" class="vh-100" style="box-shadow: inset 0px 0px 30em black">

<div class="w-100 p-3">
    <main class="row container p-4 mx-auto mt-5" style="background-color: rgba(0, 0, 0, .8); background-blend-mode: multiply;">
        <h3>PROFILE PREVIEW</h3>
        <div class="mt-3 mb-3 p-3" style="border: 1px solid grey;" id="carouselContainer">
        </div>
        <h3>PROFILE OPTIONS</h3>
        <div class="d-block">
            <label for="email">Tell us about yourself!</label>
            <div class="d-flex">
                <textarea id="description" class="form-control" style="height:10rem;" placeholder="Description..."></textarea>
            </div>
            <button type="button" class="btn btn-primary" onclick="changeDescription()">UPDATE BIO</button>
            <br><br>
            <label for="email">Change Picture:</label>
            <div class="d-flex">
                <form method="post" action="./model/uploadPortrait.php" enctype="multipart/form-data">
                    <input type='file' class="form-control" name='file'>
                    <input type='submit' class="btn btn-primary" value='UPLOAD' name='portrait'>
                </form>
            </div>
        </div>
    
        <h3 class="mt-5">USER OPTIONS</h3> 
        <div class="d-block">
            <label for="email">Change Email Address :</label>
            <div class="d-flex">
                <input type="text" id="email" class="form-control" placeholder="New email">
                <input type="text" id="emailComfirm"class="form-control" placeholder="New email">
                <button type="button" class="btn btn-primary" onclick="changeEmail()">CHANGE</button><br><br>
            </div>
            <br>
            <label for="email">Change Password :</label>
            <div class="d-flex">
                <input type="text" id="password" class="form-control" placeholder="New password">
                <input type="text" id="passwordComfirm" class="form-control" placeholder="New password">
                <button type="button" class="btn btn-primary" onclick="changePassword()">CHANGE</button>
            </div>

        
            <br><button type="button" class="btn btn-danger" onclick="deactivateAccount()">DEACTIVATE ACCOUNT</button>
        </div>
        
    </main>
 </div>

<?php include 'footer.php';?>
</body>
</html>