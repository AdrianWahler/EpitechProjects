<?php include 'header.php';?>

<body data-bs-theme="dark">
    <div class="container container-fluid text-center">    
        <div class="row content">
            <div class="col-sm-8 text-left">

                <ul class="nav nav-pills mb-4 mt-4" style="border-bottom: 1px solid #3b3939">
                    <li class="nav-item">
                        <a class="nav-link active" onclick="changeTab(this,0)">FIND MOVIE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="changeTab(this,1)">FIND USER/HISTORY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="changeTab(this,2)">MANAGE SUBSCRIPTION</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="changeTab(this,3)">VIEW SCHEDULE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="changeTab(this,4)">MANAGE SCHEDULE</a>
                    </li>
                </ul>
                
                <div class="interfaceTab">
                    <h6>Search for a movie by name, genre and/or publisher</h6><br>
                    <input type="text" id="movieName" oninput="searchMovieInfos();" placeholder="Title contains..."> <br> <br>
                    <select type="text" id="genreName" onchange="searchMovieInfos();"><option value="">No Genre</option></select>
                    <select type="text" id="distribName" onchange="searchMovieInfos();"><option value="">No distributor</option></select><br>                   
                </div>
                
                <div class="interfaceTab">
                    <h6>Search for a user by name, then access watch history, and add sessions to it</h6><br>
                    <input type="text" id="userFirstName" placeholder="First Name" oninput="getClientInfos()"> 
                    <input type="text" id="userLastName" placeholder="Last Name" oninput="getClientInfos()"> <br>
                </div>

                <div class="interfaceTab">
                    <h6>Search for a user by name, then manage their subscription</h6><br>
                    <input type="text" id="subFirstName" placeholder="First Name" oninput="searchUserForSub();"> 
                    <input type="text" id="subLastName" placeholder="Last Name" oninput="searchUserForSub();">
                </div>

                <div class="interfaceTab">
                    <h6>Search for a day, then display all planned screenings for that day</h6><br>
                    <input type="date" id="scheduleDate" oninput="displaySchedule(this.value);"> 
                </div>

                <div class="interfaceTab">
                    <h6>Search for a movie by name, or enter its ID, then program a screening for it</h6><br>
                    <input type="text" id="newScheduleMovieId" placeholder="Movie ID" oninput="emptyMovieName()"> OR
                    <input type="text" id="newScheduleMovieName" placeholder="Movie Name" oninput="emptyMovieId();lookForMovies()"> <br>
                    <input type="text" id="newScheduleRoom" placeholder="Room Number">
                    <input type="datetime-local" id="newScheduleDate"> <br> <br>    
                    <button onclick="setNewSession();" class="btn btn-primary">Create new session</button>   
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

