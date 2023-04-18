<nav class="navbar navbar-expand-lg navbar-dark">
<img src="logo.png" width="100" height="50"> 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div>
    <ul class="navbar-nav">
      <li class="nav-item active">
        <div class="nav-link" href="carousel.php" onclick="$('#navbarNav').slideToggle()">MENU</div>
      </li>
    </ul>
    <div id="navbarNav" style="position:absolute;display:none">
        <a class="pt-2 dropdown-item" href="carousel.php">Carousel</a>
        <a class="pt-2 dropdown-item" href="userPage.php">Options</a>
    </div>
    </div>
</nav>