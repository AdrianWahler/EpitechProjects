<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../twitter/controller/tweetFetcher.js"></script>
    <script src="../twitter/controller/tweetForm.js"></script>
    <script src="../twitter/jquery-3.6.3.js"></script>
    <script src="../twitter/controller/chatFunctions.js"></script>
    <link rel="stylesheet" href="./view/test.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>HOME</title>
</head>

<body onload="getTweets('feed'); chatBarObject = new ChatBar(); getRecommended()">
    <!--sidebar-->
    <div class="sidebar">
        <img src="./IMG/twitter.png" alt="#">
        <a href="homepage.php">
            <div class="sidebarOption  active">
                <span class="material-symbols-outlined"> home </span>
                <h2>Home</h2>
            </div>
        </a>
        <a href="settings.php">
            <div class="sidebarOption">
                <span class="material-symbols-outlined">search</span>
                <h2>Explore</h2>
        </a>
    </div>


    <div class="sidebarOption">
        <span class="material-symbols-outlined"> notifications</span>
        <h2>notifications</h2>
    </div>
    <div class="sidebarOption">
        <span class="material-symbols-outlined">message</span>
        <h2>Message</h2>
    </div>
    <a href="profile.php">
        <div class="sidebarOption">
            <span class="material-symbols-outlined">person</span>
            <h2>Profile</h2>
        </div>
    </a>
    <a href="view/settings.php">
        <div class="sidebarOption">
            <span class="material-symbols-outlined">settings</span>
            <h2>Settings</h2>
        </div>
    </a>

    <a href="logout.php">
        <div class="sidebarOption sideBarOptionRed">
            <span class="material-symbols-outlined">power_settings_new</span>
            <h2>Disconnect</h2>
        </div>
    </a>
    <div class="sidebarOption">
        <a href="#" onclick="setTheme()"><span class="material-symbols-outlined" class="dark-mode">dark_mode</span>
            <h2>Dark mode</h2>
        </a>
    </div>
    <button class="sidebar__tweet">tweet</button>
    </div>
    <!--sidebar end -->

    <!--feed starts-->
    <div class="feed" id="tweetContainer">
        <div class="feed__header">
            <h2 id="headerTitle">Home</h2>
        </div>

        <!--tweetbox start-->
        <div class="tweetbox">
            <?php
            include 'view/tweetForm.php'
            ?>
        </div>
        <!--tweetbox end-->


        <!--post starts-->
        <!--Post end-->


    </div>
    <!-- widgets starts-->
    <div class="widgets">
        <div class="widgets__input">
            <span class="material-symbols-outlined">
                search
            </span>
            <input id="searchbar" oninput="searchbarOnModify(this)" type="text" placeholder="search">
        </div>

        <div class="widgets__widgetContainer" id="recommendations">

        </div>        

    </div>
    <script src="./controller/followUser.js"></script>
    <script src="./view/script.js"></script>
</body>

</html>