listPosition = 0;

function getRecommended(){
    
    $.ajax({
        url: "model/getRecommended.php",
        type: "POST",
        data: {
        },
        success: function(data) {
            recommmended = jQuery.parseJSON(data);
            console.log(recommmended);
            recommmendedUsers = recommmended[0];
            recommmendedHashtags = recommmended[1];

            $("#recommendations").html("<h3>USERS TO FOLLOW</h3><ul class='recommendation' id='recommmendedUsers'></ul><h3>HASHTAGS</h3><ul class='recommendation' id='recommmendedHashtags'></ul>")

            recommmendedUsers.forEach(user => {
                let item = document.createElement("li")
                item.innerHTML = "<a href='./homepage.php?user="+user["handle"]+"'><div class='autoCompleteProfile'><img src='"+user["Path"]+"'>"
                +"<div><span class='username'>"+user["username"]+"</span><span class='handle'>@"+user["handle"]
                +"</span></div><a>";

                $("#recommmendedUsers").append(item);
            });

            recommmendedHashtags.forEach(hashtag => {
                let item = document.createElement("li")
                item.innerHTML = "<a href='./homepage.php?search="+hashtag["hashtag_name"]+"'><div class='autoCompleteProfile'><div><span class='username'>#"+hashtag["hashtag_name"]+"</span></div><a>";

                $("#recommmendedHashtags").append(item);
            });

        },error: function(jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR.responseText);
          console.log(errorThrown);
        }
    });

} 

function getTweets(){
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
      });

      if (params.search != null){
        getHashtagTweets(params.search)
      } else  if (params.user != null){
        getUserTweets(params.user)
      } else {
        getFollowedTweets()
      }
}

function getHashtagTweets(hashtag){
    
    $.ajax({
        url: "model/getHashtagTweets.php",
        type: "POST",
        data: {
            position: listPosition,
            hashtag: hashtag
        },
        success: function(data) {
            console.log(data);
            tweets = jQuery.parseJSON(data);
            listPosition += 10;
            displayTweets(tweets);
        },error: function(jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR.responseText);
          console.log(errorThrown);
        }
    });

    $(window).scroll(function() {
        myDiv = document.querySelector("#tweetContainer");
        if((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight -2) {
            getHashtagTweets(hashtag);
        }
     });
}

function getFollowedTweets(){
    
    $.ajax({
        url: "model/getFollowedTweets.php",
        type: "POST",
        data: {
            position: listPosition
        },
        success: function(data) {
            tweets = jQuery.parseJSON(data);
            listPosition += 10;
            displayTweets(tweets);

        },error: function(jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR.responseText);
          console.log(errorThrown);
        }
    });

    $(window).scroll(function() {
        myDiv = document.querySelector("#tweetContainer");
        if((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight -2) {
            getFollowedTweets();
        }
     });
}

function getUserTweets(handle){
    
    $.ajax({
        url: "model/getUserTweets.php",
        type: "POST",
        data: {
            position: listPosition,
            handle: handle
        },
        success: function(data) {
            tweets = jQuery.parseJSON(data);
            listPosition += 10;
            displayTweets(tweets);

        },error: function(jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR.responseText);
          console.log(errorThrown);
        }
    });

    $("#headerTitle").text("@"+handle)

    $(window).scroll(function() {
        myDiv = document.querySelector("#tweetContainer");
        if(window.innerHeight + window.pageYOffset >= document.body.offsetHeight-2) {
            getUserTweets(handle);   
        }
     });

}

function addLinksToTweet(tweetContent,target){

    const hashregex = /(?<=#)\w*/gm
    hashtags = tweetContent.match(hashregex)

    const atregex = /(?<=@)\w*/gm
    mentions = tweetContent.match(atregex)

    if (hashtags != null){
        hashtags.forEach(hashtag => {
            tweetContent = tweetContent.replace("#"+hashtag, "<a href='http://localhost/twitter/homepage.php?search="+hashtag+"'>#"+hashtag+"</a>")
        });
    }

    if (mentions != null){
        mentions.forEach(mention => {
            tweetContent = tweetContent.replace("@"+mention, "<a href='http://localhost/twitter/homepage.php?user="+mention+"'>@"+mention+"</a>")
        });
    }

    target.html(tweetContent)
}

function createModal( event ){

    imagePopup = document.createElement("div");
    $(imagePopup).addClass("popupImage");

    imagePopupContent = document.createElement("img");
    $(imagePopupContent).addClass("popupImageContent");
    $(imagePopupContent).attr("src",event.data.path);

    $(imagePopup).append(imagePopupContent);
    $(imagePopup).click(() => {
        $(imagePopup).remove();
    })
    $("body").append(imagePopup);
}

function createModalFromLink( link ){

    console.log("click")
    imagePopup = document.createElement("div");
    $(imagePopup).addClass("popupImage");

    imagePopupContent = document.createElement("img");
    $(imagePopupContent).addClass("popupImageContent");
    $(imagePopupContent).attr("src",link);

    $(imagePopup).append(imagePopupContent);
    $(imagePopup).click(() => {
        $(imagePopup).remove();
    })
    $("body").append(imagePopup);
}

function addImagesToTweet(target,tweetID){

    $.ajax({
        url: "model/getTweetImages.php",
        type: "POST",
        data: {
            tweetID: tweetID
        },
        success: function(data) {
            images = jQuery.parseJSON(data);
            console.log(images);
            images.forEach(image => {
                imageElement = document.createElement("img");
                $(imageElement).attr("src",image["Path"]);
                $(target).append(imageElement);
                $(imageElement).on("click", {
                    path: image["Path"]
                  }, createModal );
            });
        },error: function(jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR.responseText);
          console.log(errorThrown);
        }
    });

}

function displayTweets(tweets){
    tweets.forEach(tweet => {
        var tweetContainer = document.createElement('div');
        $(tweetContainer).addClass("post");
        $(tweetContainer).html(
            `<div class="post__avatar">
                <img src="`+tweet["Path"]+`" alt="">
            </div>

            <div class="post__body">
                <div class="post__header">
                    <div class="post_headerText">
                        <h4 class="tweetContext"></h4>
                        <h3><a class="userNameLink" href='https://localhost/twitter/homepage.php?user=`+tweet["handle"]+`'>`+tweet["username"]+`</a>
                            <span class="post__headerSpecial">
                            <span></span>@`+tweet["handle"]+`
                        </span>
                        </h3>
                        
                    </div>
                    <div class="post__headerDescription">
                        <p id="tweetContent">`+tweet["content"]+`</p>
                    </div>
                    <div class="post__images" id="tweetImages">
                    </div>
                </div>
                <div class="post__footer">
                    <span class="material-symbols-outlined" type="button" id="commentButton">
                        chat_bubble
                    </span>
                    <span class="material-symbols-outlined" type="button" id="likeButton">
                        favorite
                    </span>
                    <span class="material-symbols-outlined" type="button" id="retweetButton">
                        sync
                    </span>
                </div>`
        );

        addLinksToTweet($(tweetContainer).find("#tweetContent").text(),$(tweetContainer).find("#tweetContent"));
        addImagesToTweet($(tweetContainer).find("#tweetImages"),tweet["0"]);

        if (tweet["comment_of"] != null) {
            $.ajax({
                url: "model/getSingleTweet.php",
                type: "POST",
                data: {
                    tweetID: tweet["comment_of"]
                },
                success: function(data) {
                    console.log(data);
                    parentTweet = jQuery.parseJSON(data)[0];
                    $(tweetContainer).find(".tweetContext").text("@"+parentTweet["handle"]+": "+parentTweet["content"])
                },error: function(jqXHR, textStatus, errorThrown)
                {
                  console.log(jqXHR.responseText);
                  console.log(errorThrown);
                }
            });
        }

        $(tweetContainer).find("#likeButton").click(function() {
            $.ajax({
                url: "model/likeTweet.php",
                type: "POST",
                data: {
                    tweetID: tweet["0"]
                },
                success: function(data) {
                    $(tweetContainer).find("#likeButton").toggleClass("icon-outline-filled");
                    $(tweetContainer).find("#likeButton").toggleClass("icon-outline-red");
                },error: function(jqXHR, textStatus, errorThrown)
                {
                  console.log(jqXHR.responseText);
                  console.log(errorThrown);
                }
            });   
        });
        
        $(tweetContainer).find("#commentButton").click(async function() {
            responseBox = document.createElement("div");
            await $(responseBox).load("./view/tweetForm.php",() => {
                $(responseBox).find("#responseTo").attr("value",tweet["0"]);
            });
            $(tweetContainer).after(responseBox);
        });

        $(tweetContainer).find("#retweetButton").click(function() {
            $.ajax({
                url: "model/retweetTweet.php",
                type: "POST",
                data: {
                    tweetID: tweet["0"]
                },
                success: function(data) {
                    $(tweetContainer).find("#retweetButton").toggleClass("icon-outline-green");
                },error: function(jqXHR, textStatus, errorThrown)
                {
                  console.log(jqXHR.responseText);
                  console.log(errorThrown);
                }
            });   
        });

        $.ajax({
            url: "model/isTweetLiked.php",
            type: "POST",
            data: {
                tweetID: tweet["0"]
            },
            success: function(data) {
                if (data == "true") {
                    $(tweetContainer).find("#likeButton").toggleClass("icon-outline-filled")
                    $(tweetContainer).find("#likeButton").toggleClass("icon-outline-red")
                }
            },error: function(jqXHR, textStatus, errorThrown)
            {
              console.log(jqXHR.responseText);
              console.log(errorThrown);
            }
        }); 

        $.ajax({
            url: "model/isTweetRetweeted.php",
            type: "POST",
            data: {
                tweetID: tweet["0"]
            },
            success: function(data) {
                if (data == "true") {
                    $(tweetContainer).find("#retweetButton").toggleClass("icon-outline-green")
                }
            },error: function(jqXHR, textStatus, errorThrown)
            {
              console.log(jqXHR.responseText);
              console.log(errorThrown);
            }
        });

        $(tweetContainer).appendTo($('#tweetContainer'));
    });
}