<?php
session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']['UserType'] > 0) {  //LOGGED IN
?>

<nav class="navbar navbar-expand-lg navbar-light navbar-dark bg-warning">
  <a class="navbar-brand navbar-brand1" href="#">BlogBurger</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      </ul>
      <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/bestburger.php">Best burgers <span class="sr-only">(current)</span></a>
      </li>
    </ul>

    <div style="flex:1"></div><!-- Filler -->

    <!-- Login right side -->
    <ul class="navbar-nav mr-auto justify-content-end">
      <li class="nav-item"><a class="nav-link bg-success" href="/make_post.php">Make post</a></li>
      <li class="nav-item"><a class="nav-link bg-warning" href="/api/logout.php">Log off</a></li>
    </ul>
  </div>
</nav>

<?php

}
} else{


?>


<nav class="navbar navbar-expand-lg navbar-light navbar-dark bg-dark">
  <a class="navbar-brand" href="#">BlogBurger</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/bestburger.php">Best burgers <span class="sr-only">(current)</span></a>
      </li>
    </ul>

    <div style="flex:1"></div><!-- Filler -->

    <!-- Login right side -->
    <ul class="navbar-nav mr-auto justify-content-end">
      <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
      <li class="nav-item"><a class="nav-link bg-success" href="/login.php">Login</a></li>
    </ul>
  </div>
</nav>



<?php
}



?>
