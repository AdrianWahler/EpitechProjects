<form id="tweetForm" method="post" action="model/sendTweet.php" enctype="multipart/form-data">
    <div id="errorfield" style="hidden"></div>
    <input type="hidden" id="responseTo" value="" name="responseTo">
    <div class="tweetbox__input">
          <?php
            include "./view/userImage.php";
           ?>
           <input autocomplete="off" oninput="tweetOnModify();" id="tweet" name="tweet" type="text" placeholder="What's happening?">
        </div>

        <div class="tweetbox__buttons">
            <label for="file"><span class="material-symbols-outlined">
                    add_photo_alternate
             </span></label>
         <input type="file" class="tweetBox__imageButton" id="file" name="file[]" multiple>
         <button type="submit" class="tweetBox__tweetButton">Tweet</button>
     </div>
</form>