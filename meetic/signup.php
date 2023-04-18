<?php include 'header.php';?>

<body onload="getHobbyList();" data-bs-theme="dark" class="d-flex vh-100" style="background-size: cover; box-shadow: inset 0px 0px 30em black">
<div class="row cover-container w-100 d-flex justify-content-around p-3 mx-auto flex-column">
    <form onsubmit="return validateUserForm();" action="./accountCreated.php" class="col-4 align-self-center">
        <h2 class="align-self-center">Enter your information</h2>
        <p id="errorfield"></p>
        <div class="form-group">
        <label for="firstName">First and last name</label>
            <div class="d-flex flex-inline">    
                <input  type="text" class="form-control w-50" id="firstName" placeholder="First Name">
                <input  type="text" class="form-control w-50" id="lastName" placeholder="Last Name">
            </div>
        </div>
        <br>
        <div class="form-group d-flex flex-inline">
            <div class="w-50">
                <label  for="password">Password</label>
                <input  type="password" class="form-control" id="password">
            </div>
            <div class="w-50">
                <label  for="passwordComfirm">Comfirm Password</label>
                <input  type="password" class="form-control" id="passwordComfirm">
            </div>
        </div>
        <br>
        <br>
        <div class="form-group d-flex flex-inline">
            <div class="w-50">
                <label for="birthDate" id="test">Date of birth</label>
                <input  type="date" class="form-control" id="birthDate">
            </div>
            <div class="w-50">
                <label for="gender">Gender</label>
                <select  class="form-control" id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label for="city">City</label>
            <input  type="text" class="form-control w-50" id="city" placeholder="City">
        </div>
        <br>
        <div class="form-group">
            <label for="email">Email</label>
            <input  type="email" class="form-control w-100" id="email" placeholder="god@zilla.net">
        </div>
        <div class="form-group">
            <label for="emailComfirm">Comfirm Email</label>
            <input  type="emailComfirm" class="form-control w-100" id="emailComfirm" placeholder="god@zilla.net">
        </div>
        <br>
        <div class="form-group">
            <label for="hobbyList">Hobbies</label>
            <div class="form-group d-flex flex-inline">
                <select id="hobbyList" onchange="addValueFromSelect(this,'hobbyContainer');" class="form-control w-50 overflow-auto">
                </select>
                <input id="hobbyInput" placeholder="Type your own hobby here!" class="form-control w-50"></input>
                <div class="input-group-append">
                    <button class="btn btn-secondary" onclick="addValueFromInput($('#hobbyInput')[0],'hobbyContainer')" type="button">Send</button>
                </div>
            </div>
            <div id="hobbyContainer" class="border rounded border-light p-4 mt-3">

            </div>
        </div>
        <br>
        <div>
            <button class="btn w-100 btn-primary">SIGN UP</button>
        </div>
    </form>
 </div>

 <script>getHobbyList();</script>
<?php include 'footer.php';
include './model/userObject.php'?>
</body>
