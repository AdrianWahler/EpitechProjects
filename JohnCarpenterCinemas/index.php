<?php include 'header.php';?>

<body onload="displaySchedule('2018-01-01');" data-bs-theme="dark" class="d-flex vh-100 text-center" style="background-image: url('assets/cinema.jpg'); background-size: cover; box-shadow: inset 0px 0px 30em black">
<div class="position-absolute top-0 end-0"  >
<a href="login.php"><button class="btn btn-primary m-2">Connexion</button></a>
</div>     
<div class="cover-container w-100 d-flex justify-content-around p-3 mx-auto flex-column">
        <main class="inner cover p-4" style="background-color: rgba(0, 0, 0, .8); background-blend-mode: multiply;">
            <h1 class="cover-heading mb-auto w-100">Jonh Carpenter Cinema</h1>
            <p class="lead mt-auto">The Thing everyone is talking about.</h1>
        </main>
        <div style="background-color:rgba(0, 0, 0, .8)"class="overflow-scroll w-50 p-3 mx-auto" >
        <h1>PLAYING TODAY</h1>
        <div id="infoBox"></div>
        <p>Or choose another date !</p> <input type="date" id="scheduleDate" oninput="displaySchedule(this.value);"> 
        </div>
    </div>

<?php include 'footer.php';?>
</body>
