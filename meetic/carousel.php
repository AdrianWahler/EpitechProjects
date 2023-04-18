<?php include 'header.php';?>
<?php require 'navbar.php';?>

<body onload="getHobbyList();" data-bs-theme="dark" class="vh-100 text-center" style="box-shadow: inset 0px 0px 30em black">
<div class="cover-container w-100 d-flex justify-content-around p-3 mx-auto flex-column">
    <main class="container inner cover p-4" style="background-color: rgba(0, 0, 0, .8); background-blend-mode: multiply;">
        <div id="searchbar" class="row">
            <div class="col align-middle p-4">
                <input type="checkbox" id="male" name="gender" class="gender" value="male" />
                <label for="male">Male</label>
                <input type="checkbox" id="female" name="gender" class="gender" value="female" />
                <label for="female">Female</label>
                <input type="checkbox" id="other" name="gender" class="gender" value="other" />
                <label for="other">Other</label>
            </div>
            <div class ="p-3 col input-group">
                <input id="city" class="form-control" placeholder="City">
                <div class="input-group-append">
                    <button class="btn btn-secondary" onclick="addValueFromInput($('#city')[0],'cityContainer')" type="button">Send</button>
                </div>
                
            </div>
            <div class ="p-3 col">
                <select id="hobbyList" onchange="addValueFromSelect(this,'hobbyContainer');" class="form-control overflow-auto">
                </select>
            </div>
            <div class ="p-3 col">
                <select id="ageGroup" class="form-control overflow-auto">
                    <option value="none">None</option>
                    <option value="18/25">18/25</option>
                    <option value="25/35">25/35</option>
                    <option value="35/45">35/45</option>
                    <option value="45+">45+</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col" id="cityContainer">
            </div> 
            <div class="col" id="hobbyContainer">
            </div>
        </div>
        <button class="btn btn-primary" type="button" onclick="getSearchParameters();"> SEARCH </button>
        <div id="matchContainer">
        </div>
    </main>
 </div>

<?php include 'footer.php';?>
</body>
</html>