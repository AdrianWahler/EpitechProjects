
function searchMovieInfos() {
    target = document.getElementById('infoBox');
    movieName = document.getElementById('movieName').value;
    genreName = document.getElementById('genreName').value;
    distribName = document.getElementById('distribName').value;

    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        target.innerHTML = this.responseText;
    }
    xml.open("GET", "script/getMovieInfos.php?movieName=" + movieName + "&genreName=" + genreName + "&distribName=" + distribName, true);
    xml.send();
}

function displaySchedule(date) {
    target = document.getElementById('infoBox');
    console.log(date);
    if (date == "") {
        const dateObj = new Date();

        let day = dateObj.getDate();
        let month = dateObj.getMonth() + 1;
        let year = dateObj.getFullYear();

        date = `2018-${month}-${day}`;
    }
    console.log(date);

    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        target.innerHTML = this.responseText;
    }
    xml.open("GET", "script/displaySchedule.php?date=" + date, true);
    xml.send();
}

function getClientInfos() {
    target = document.getElementById('infoBox');
    firstName = document.getElementById('userFirstName').value;
    lastName = document.getElementById('userLastName').value;

    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        target.innerHTML = this.responseText;
    }
    xml.open("GET", "script/getClientInfos.php?firstName=" + firstName + "&lastName=" + lastName, true);
    xml.send();
}

function searchUserForSub() {
    target = document.getElementById('infoBox');
    firstName = document.getElementById('subFirstName').value;
    lastName = document.getElementById('subLastName').value;

    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        target.innerHTML = this.responseText;
    }
    xml.open("GET", "script/getUserForSub.php?firstName=" + firstName + "&lastName=" + lastName, true);
    xml.send();
}

function changeSub(index) {
    clientID = document.getElementById('id' + index).innerHTML;
    newSub = document.getElementById('newSubType' + index).value;

    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            searchUserForSub();
        }
    }
    xml.open("GET", "script/setSubscription.php?clientID=" + clientID + "&newSub=" + newSub, true);
    xml.send();
}

function getClientHistory(firstName,lastName) {
    target = document.getElementById('infoBox');

    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        target.innerHTML = this.responseText;
    }
    xml.open("GET", "script/getClientHistory.php?firstName=" + firstName + "&lastName=" + lastName, true);
    xml.send();
}

function setNewSession(){
    target = document.getElementById('infoBox');
    date = document.getElementById('newScheduleDate').value;
    movieId = document.getElementById('newScheduleMovieId').value;
    movieName = document.getElementById('newScheduleMovieName').value;
    room = document.getElementById('newScheduleRoom').value;

    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        target.innerHTML = this.responseText;
    }
    xml.open("GET", "script/setNewSession.php?date=" + date + "&movieId=" + movieId + "&movieName=" + movieName + "&room=" + room, true);
    xml.send();
}

function lookForMovies(){
    target = document.getElementById('infoBox');
    movieName = document.getElementById('newScheduleMovieName').value;

    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        target.innerHTML = this.responseText;
    }
    xml.open("GET", "script/lookForMovies.php?movieName=" + movieName, true);
    xml.send();
}


function changeTab(newActiveLink, index) {

    links = document.getElementsByClassName("nav-link");
    for (let i = 0; i < links.length; i++) {
        links[i].classList.remove('active');

    }
    newActiveLink.classList.add('active');

    tabs = document.getElementsByClassName("interfaceTab");
    for (let i = 0; i < tabs.length; i++) {
        tabs[i].style.display = "none";
    }
    tabs[index].style.display = "revert";
}

function emptyMovieName()
{
    document.getElementById("newScheduleMovieName").value = "";
}

function emptyMovieId()
{
    document.getElementById("newScheduleMovieId").value = "";
}

function setIdField(id)
{
    document.getElementById("newScheduleMovieId").value = id;
    document.getElementById("newScheduleMovieName").value = "";
}

function getListOfGenres() {

    //CREATION DU TAB DE RECHERCHE
    var xmlGenres = new XMLHttpRequest();
    target = document.getElementById('genreName')

    xmlGenres.onreadystatechange = function () {
        if (xmlGenres.readyState == 4 && xmlGenres.status == 200) {
            target.innerHTML += this.responseText;
        }
    }
    xmlGenres.open("GET", "script/getListOfGenres.php?", true);
    xmlGenres.send();
}

function getListOfDistributors() {

    //CREATION DU TAB DE RECHERCHE
    var xmlDistrib = new XMLHttpRequest();
    target = document.getElementById('distribName')

    xmlDistrib.onreadystatechange = function () {
        if (xmlDistrib.readyState == 4 && xmlDistrib.status == 200) {
            target.innerHTML += this.responseText;
            getListOfGenres();
        }
    }
    xmlDistrib.open("GET", "script/getListOfDistributors.php?", true);
    xmlDistrib.send();
}


function displayDefaultTab() {

    //AFFICHAGE DE LA TAB PAR DEFAUT
    links = document.getElementsByClassName("nav-link");
    for (let i = 0; i < links.length; i++) {
        links[i].classList.remove('active');
    }
    links[0].classList.add('active');

    tabs = document.getElementsByClassName("interfaceTab");
    for (let i = 0; i < tabs.length; i++) {
        tabs[i].style.display = "none";
    }
    tabs[0].style.display = "revert";

    getListOfDistributors();

}

function addSessionToClient(clientId,firstname,lastname){
    sessionId = document.getElementById('sessionId').value;
    target = document.getElementById('infoBox');

    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        getClientHistory(firstname,lastname);
    }
    xml.open("GET", "script/addSessionToClient.php?sessionId=" + sessionId + "&clientId=" + clientId, true);
    xml.send();
}

function changePassword(){
    oldPassword = document.getElementById('oldPassword').value;
    newPassword = document.getElementById('newPassword').value;

    if (oldPassword == "" || newPassword == "") {
        document.getElementById('passwordError').innerHTML = "Above fields are required."
    }
    
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        console.log(this.responseText);
    }
    xml.open("GET", "script/changePassword.php?oldPassword=" + oldPassword + "&newPassword=" + newPassword, true);
    xml.send();
}

function checkUserLogin(){
    email = document.getElementById('email').value;
    password = document.getElementById('password').value;

    if (email == "" || password == ""){
        document.getElementById('errormessage').innerHTML = "Please enter an email and password";
    } else {
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            response = this.responseText.split(',');
            console.log(response);
            if (response[0] == "false"){
                document.getElementById('errormessage').innerHTML = "Wrong username/email";
            } else if (response[0] == "user") {
                document.location = document.location.origin+"/JohnCarpenterCinemas/user.php";
                document.cookie = "id="+response[1]; 
            } else if (response[0] == "employee") {
                document.location = document.location.origin+"/JohnCarpenterCinemas/employee.php";
                document.cookie = "id="+response[1];
            }
        }
        xml.open("GET", "script/checklogin.php?email=" + email + "&password=" + password, true);
        xml.send();
    }
}

inputCode = [];
audio = new Audio('assets/dundundun.mp3');

window.onkeydown = function (e) {

    var code = e.keyCode ? e.keyCode : e.which;
    if (code === 38) { 
        inputCode.push('up');
    } else if (code === 40) { 
        inputCode.push('down');
    } else if (code ===37) { 
        inputCode.push('left');
    } else if (code === 39) { 
        inputCode.push('right');
    }

    if (inputCode.length > 8){
        inputCode = inputCode.slice(1);
    }

    if (JSON.stringify(inputCode) == JSON.stringify(['up','up','down','down','left','right','left','right'])) {
        audio.play();
    }
};