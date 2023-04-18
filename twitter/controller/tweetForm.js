let files = []

// $(window).on('load', function() {
//     console.log("#searchbar")
//     $("#searchbar").on( "keypress", launchSearch)
// })

window.addEventListener('load', (event) => {
    $("#searchbar").on( "keypress", launchSearch)
  });

function tweetOnModify()
{
    //On regarde la longueur du tweet
    if ($('#tweet').val().length >= 140)
    {
        $('#tweet').val($('#tweet').val().substring(0,139));
    }

    //On regarde si l'uttilisateur essaie de @ qqun
    let lastWord = $('#tweet').val().slice(
        $('#tweet').val().lastIndexOf(' ') + 1
    );
    if (lastWord.substring(0,1) == '@') {
        if($('#autoComplete').length == 0){
            createAutocomplete(lastWord,$("#tweet")[0]);
            updateAutocomplete(lastWord,$("#tweet")[0]);
        }else{
            updateAutocomplete(lastWord,$("#tweet")[0]);
        }
    } else if ($('#autoComplete').length != 0) {
        $(autoCompleteBox).remove();
    }
}

function searchbarOnModify(target){
    //On regarde si l'uttilisateur essaie de @ qqun
    let lastWord = $('#searchbar').val().slice(
        $(target).val().lastIndexOf(' ') + 1
    );

    if (lastWord.substring(0,1) == '@') {
        if($('#autoComplete').length == 0){
            createAutocomplete(lastWord,target);
            updateAutocomplete(lastWord,target);
        }else{
            updateAutocomplete(lastWord,target);
        }
    } else if ($('#autoComplete').length != 0) {
        $(autoCompleteBox).remove();
    }
}

function newMessageOnModify(target){
    //On regarde si l'utilisateur essaie de @ qqun
    let lastWord = $('#newMessage').val()

    console.log(lastWord);
    if($('#autoComplete').length == 0){
        createAutocomplete(lastWord,target);
        updateAutocomplete(lastWord,target);
    }else{
        updateAutocomplete(lastWord,target);
    }
}

function createAutocomplete(lastWord,target)
{
    autoCompleteBox = document.createElement("ul")
    $(autoCompleteBox).attr('id','autoComplete')
    $(autoCompleteBox).html('autoComplete')
    $(autoCompleteBox).toggleClass("autoCompleteBox")
    target.after(autoCompleteBox);
    document.addEventListener('mouseup', (event) => {
        if (!event.composedPath().includes(autoCompleteBox)) {
            $(autoCompleteBox).remove();
        }
    })
}

function updateAutocomplete(lastWord,target)
{

    $("#autoComplete").html("");
    $.ajax({
        url: "./model/getAtAutocomplete.php",
        type: "POST",
        data: {
            userInput : lastWord.replace("@","")
        },
        success: function(data) {
            users = jQuery.parseJSON(data)

            users.forEach(user => {
                let item = document.createElement("li")
                item.innerHTML = "<div class='autoCompleteProfile'><img src='"+user["Path"]+"'>"+"<div><p class='username'>"+user["username"]+"</p><p class='handle'>@"+user["handle"]+"</p></div>"
                item.addEventListener("click",() => {
                    console.log(target)
                    target.value = target.value.replace(lastWord,"@"+user["handle"]);
                    $("#autoComplete").remove()
                })
                $("#autoComplete").append(item)
            });
        },error: function(jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR.responseText);
          console.log(errorThrown);
        }
    });

}


function addImageToTweet()
{
    files.push($('#image').prop('files'));

    newImage = document.createElement("input");
    $(newImage).attr("type","hidden");
    $(newImage).attr("name","image");
    $(newImage).val(files);

    $("#tweetForm").append(newImage);
}

function launchSearch()
{
    if (event.keyCode == 13){
        if ($("#searchbar").val().substring(0,1) == '@'){
            window.location.href = "http://localhost/twitter/homepage.php?user="+$("#searchbar").val().substring(1);
        } else {
            window.location.href = "http://localhost/twitter/homepage.php?search="+$("#searchbar").val();
        }
    }
}
