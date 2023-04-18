class CarouselItem{

    constructor(user) {
        this.user = user;
    }

    getUserCarousel() {
        
        let mainDiv = document.createElement('div');
        $(mainDiv).addClass("row");

        let leftDiv = document.createElement('div');
        $(leftDiv).addClass("col text-start");
        $(leftDiv).css("border-left","1px solid grey");
        leftDiv.innerHTML = 
            "Name: "+this.user.lastName+" "+this.user.firstName+"<br>"+
            "Gender: "+this.user.gender+"<br>"+
            "From: "+this.user.city+"<br>"+
            "Born: "+this.user.birthDate+"<br>"+
            "Email: "+this.user.email+"<br>"+
            "Hobbies: "+this.user.hobbies.split(",").join(", ")+"<br><br>";
            if (this.user.description != null){
                leftDiv.innerHTML += this.user.description;
            }

        let rightDiv = document.createElement('div');
        if (this.user.portraitID != null){
            rightDiv.innerHTML +=  '<img src="assets/'+this.user.name+'" alt="'+this.user.lastName+'"><br>' 
        } else {
            rightDiv.innerHTML +=  '<img src="unknown.png" alt="'+this.user.lastName+'" width="200" height="200"><br>' 
        }
        $(rightDiv).addClass("col text-center");
        

        mainDiv.appendChild(rightDiv);
        mainDiv.appendChild(leftDiv);

        return mainDiv;
    }


}

class Carousel{

    constructor(data) {
        this.users = data;
        this.itemList = [];
        this.itemListPosition = 0;
        this.buildCarousel();
    }

    buildCarousel() {
        let mainDiv = document.createElement('div');

        let leftButton = document.createElement('button');
        leftButton.addEventListener('click',() => {this.changeDisplayedItem(-1)});
        leftButton.innerHTML = "<";
        $(leftButton).addClass("btn btn-primary align-middle m-2")
        mainDiv.appendChild(leftButton);

        let rightButton = document.createElement('button');
        rightButton.addEventListener('click',() => {this.changeDisplayedItem(1)});
        rightButton.innerHTML = ">";
        $(rightButton).addClass("btn btn-primary align-middle m-2")
        mainDiv.appendChild(rightButton);

        for (let i = 0; i < this.users.length; i++) {
            let userItem = new CarouselItem(this.users[i]);
            this.itemList[i] = userItem.getUserCarousel();
            $(this.itemList[i]).fadeToggle({duration:0});
            mainDiv.appendChild(this.itemList[i]);
        }
        $(this.itemList[0]).fadeToggle();
        console.log(this.itemList);
        return mainDiv;
    }

    changeDisplayedItem(index){
        console.log("help");
        $(this.itemList[this.itemListPosition]).fadeToggle({duration:0});
        this.itemListPosition += index

        if (this.itemListPosition < 0) {
            this.itemListPosition = this.itemList.length - 1;
        } else if (this.itemListPosition > this.itemList.length - 1) {
            this.itemListPosition = 0;
        }

        $(this.itemList[this.itemListPosition]).fadeToggle();
    }

}

function getCurrentUserCarousel(container){
    $.ajax({
        url: "./model/getCurrentUserCarousel.php",
        type: "POST",
        success: function(data) {   
            console.log(container);
            let carousel = new CarouselItem(jQuery.parseJSON(data));
            container.append(carousel.getUserCarousel());
        },error: function(jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR.responseText);
          console.log(errorThrown);
        }
    });
}

function getHobbyList(){
    $("#hobbyList").load("script/getHobbyList.php");
}

function addValueFromSelect(select,target){
    value = select.value;
    if ($("button").filter(":contains('"+value+"')").length == 0){
        $("#"+target).append(`<button type="button" class="value btn btn-secondary m-1" onclick="this.remove()" type='button btn-light' value='${value}'>${value}</button>`);
    }
}

function addValueFromInput(input,target){
    value = input.value;
    if ($("button").filter(":contains('"+value+"')").length == 0){
        $("#"+target).append(`<button type="button" class="value btn btn-secondary m-1" onclick="this.remove()" type='button btn-light' value='${value}'>${value}</button>`);
    }
}

function attemptLogin(){
    $.ajax({
        url: "./model/attemptLogin.php",
        type: "POST",
        data: {email: $("#email").val(), password: $("#password").val()},
        success: function(data) {   
            if (data == "true"){
                window.location.href = window.location.origin+"/meetic/userPage.php";
            } else {
                console.log(data);
                alert("Wrong mail/password.");
            }
        },error: function(jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR.responseText);
          console.log(errorThrown);
        }
    });
}
function formError(message){
    $('#errorfield').text(message);
    $('#errorfield').addClass("alert");
    $('#errorfield').addClass("alert-danger");
}

function getValuesFromDiv(div){
    var hobbies = $('#'+div+' .value');
    var hobbyArray = [];

    for (let i = 0; i < hobbies.length; i++) {
        hobbyArray.push(hobbies[i].innerHTML);
    }
    
    return hobbyArray;
}

function addHobbiesToDatabase(hobbyList){

    hobbyList.forEach(hobby => {
        $.ajax({
            url: "./model/addHobbiesToDatabase.php",
            type: "POST",
            data: {hobby : hobby}, //This apparently does not cause problems?
            success: function(data) {   
                console.log(data);
            },error: function(jqXHR, textStatus, errorThrown)
            {
              console.log(jqXHR.responseText);
              console.log(errorThrown);
            }
        });
    });

}

function changePassword(){
    password = $('#password').val();
    passwordComfirm = $('#passwordComfirm').val();

    if (password == passwordComfirm) {
        $.ajax({
            url: "./model/changePassword.php",
            type: "POST",
            data: {password : password},
            success: function(data) {
                $('#errorArea').text("Password changed!");
            },error: function(jqXHR, textStatus, errorThrown)
            {
                console.log(jqXHR.responseText);
                console.log(errorThrown);
            }
        });
    } else {
        $('#errorArea').text("Passwords do not match!");
    }
}

function changeEmail(){
    email = $('#email').val();
    emailComfirm = $('#emailComfirm').val();

    if (email == emailComfirm) {
        $.ajax({
            url: "./model/setUserEmail.php",
            type: "POST",
            data: {email : email},
            success: function(data) {
                $('#errorArea').text("Email changed!");
            },error: function(jqXHR, textStatus, errorThrown)
            {
                console.log(jqXHR.responseText);
                console.log(errorThrown);
            }
        });
    } else {
        $('#errorArea').text("Emails do not match!");
    }
}

function deactivateAccount(){

    if (window.confirm("THIS WILL PERMANENTLY DEACTIVATE YOUR ACCOUNT. PROCEED?")){
        if (window.confirm("THIS CANNOT BE UNDONE")){
            if (window.confirm("OK NO CRYING IF YOU WANT IT BACK?")){
                $.ajax({
                    url: "./model/deactivateAccount.php",
                    type: "POST",
                    success: function(data) {
                        document.location.href = "http://localhost/meetic/";
                    },error: function(jqXHR, textStatus, errorThrown)
                    {
                        console.log(jqXHR.responseText);
                        console.log(errorThrown);
                    }
                });
            }        
        }    
    }

}

function changeDescription(){
    bio = $('#description').val();

    $.ajax({
        url: "./model/setUserBio.php",
        type: "POST",
        data: {
            bio : bio
        },
        success: function(data) {
            $('#errorArea').text("Description changed!");
        },error: function(jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR.responseText);
            console.log(errorThrown);
        }
    });
}

function validateUserForm(){

    if ($('#password').val() != $('#passwordComfirm').val()){
        formError("Passwords do not match");
        return false;
    }

    if ($('#email').val() != $('#emailComfirm').val()){
        formError("Emails do not match");
        return false;
    }

    birthDate = new Date($('#birthDate').val())
    var ageDiff = Date.now() - birthDate.getTime();
    var userAge = new Date(ageDiff);
    var userAge = Math.abs(userAge.getUTCFullYear() - 1970);

    if (userAge<18) {
        formError("You must be over 18 to register.");
        return false;
    }

    hobbyList = getValuesFromDiv('hobbyContainer');
    addHobbiesToDatabase(hobbyList);

    $.ajax({
        url: "model/addUserToDatabase.php",
        type: "POST",
        data: {
            firstName : $('#firstName').val(),
            lastName : $('#lastName').val(),
            password : $('#password').val(),
            birthDate : $('#birthDate').val(),
            gender : $('#gender').val(),
            city : $('#city').val(),
            email : $('#email').val(),
            hobbies : hobbyList
        },
        success: function(data) {   
            document.location.href = "http://localhost/meetic/accountCreated.php";
        },error: function(jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR.responseText);
          console.log(errorThrown);
        }
    });

    return false;

}

function getSearchParameters(){
    
    let hobbies = getValuesFromDiv('hobbyContainer');
    let cities = getValuesFromDiv('cityContainer');
    let genders = $('.gender:checkbox:checked');
    let genderArray = [];
    let ageRange = $('#ageGroup').val();

    for (let i = 0; i < genders.length; i++) {
        genderArray[i] = genders[i].value;
    }

    $.ajax({
        url: "model/getMatches.php",
        type: "POST",
        data: {
            hobbies : hobbies,
            cities : cities,
            genderArray : genderArray,
            ageRange : ageRange
        },
        success: function(data) {
            console.log(data);
            var matches = jQuery.parseJSON(data);
            console.log(matches);
            let matchCarousel = new Carousel(matches);
            $('#matchContainer').html("");
            $('#matchContainer').append(matchCarousel.buildCarousel());
        },error: function(jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR.responseText);
          console.log(errorThrown);
        }
    });
}