<?php include 'header.php';?>

<body data-bs-theme="dark" class="background-size: cover; box-shadow: inset 0px 0px 30em black">

<div class="container container-fluid text-center">    
        <div class="row content">
            <div class="col-sm-8 text-left">

                <ul class="nav nav-pills mb-4 mt-4" style="border-bottom: 1px solid #3b3939">
                    <li class="nav-item">
                        <a class="nav-link active" onclick="changeTab(this,0)">BUY TICKET</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="changeTab(this,1)">CHANGE PASSWORD</a>
                    </li>
                </ul>
                
                <div class="interfaceTab">
                    <h6>Search for a movie by name, genre and/or publisher, then find sessions for this movie.</h6><br>
                    <input type="text" id="movieName" oninput="searchMovieInfos();" placeholder="Title contains..."> <br> <br>
                    <select type="text" id="genreName" onchange="searchMovieInfos();"><option value="">No Genre</option></select>
                    <select type="text" id="distribName" onchange="searchMovieInfos();"><option value="">No distributor</option></select><br>                   
                </div>
                
                <div class="interfaceTab">
                    <h6>Enter current then new password</h6><br>
                    <input type="text" id="oldPassword" placeholder="Old Password"> 
                    <input type="text" id="newPassword" placeholder="New Password"> <br>
                    <p id="passwordError"></p>
                    <button class="btn btn-primary" onclick="changePassword();">Change Password</button>
                </div>
            </div>  
            <div class="container col-sm-4 sidenav mt-4">
                <div class="jumbotron">
                    <div id="infoBox" class="overflow-scroll" style="background-color='#2b2b2b'; height:90vh; box-shadow: 0px 0px 10px black; border: solid 1px #3b3939;border-radius: 1em">
                        <p style="margin-top:45vh">Ready to work!</p>
                    </div><br>
                </div>
            </div>
        </div>
    </div>

    <script>displayDefaultTab();</script>

<?php include 'footer.php';?>
</body>