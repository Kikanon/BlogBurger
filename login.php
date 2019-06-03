<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("_templates/meta.php"); ?>
    <title>Login page</title>

    <link rel="stylesheet" href="./styles/login.css">
</head>
<body>
<?php include("_templates/header.php") ?>
<!-- Content here -->

<?php
if(isset($_POST["inputEmail"]) && isset($_POST["inputPassword"])) {
  $email = $_POST["inputEmail"];
  $password=$_POST["inputPassword"];
  $remember=isset($_POST["remember"]);

  include_once($_SERVER['DOCUMENT_ROOT'] . "/_libs/db.php");
  $email = $conn->real_escape_string($email);
  $password = $conn->real_escape_string($password);
  $res = $conn->query("SELECT * FROM `users` WHERE `UserMail` = '$email' AND `UserPass` = '$password' LIMIT 1");
  if($res->num_rows == 0) {
    echo '<img style="margin:auto; width:700px; display:block;" src="_images/wrong_password.jpg">';
  }else {
    // echo "It works";
    $_SESSION['user'] = $res->fetch_assoc();
    //SELL STUFF
    $ip = $_SERVER['REMOTE_ADDR'];

    
    $statement="INSERT INTO `stuff_to_sell`(`UserID`, `UserIP`, `TimesVisited`) VALUES ('" . $_SESSION['user']['UserID'] . "', '$ip', '1')";
    $conn->query($statement);
    header('Location: /index.php');
  }
}
?>


<div class="container">
<form class="form-signin" method="POST">
  <div class="text-center mb-4">
    <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Login form</h1>
  </div>

  <div class="form-label-group">
    <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputEmail">Email address</label>
  </div>

  <div class="form-label-group">
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required minlengt="8">
    <label for="inputPassword">Password</label>
  </div>

  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" id="remember" name="remember" value="remember-me"> Remember me
    </label>
  </div>
  <button type="sibmit" class="btn btn-lg btn-primary btn-block" onclick="login()">Sign in</button>
  <p class="mt-5 mb-3 text-muted text-center">© 2017-2019</p>
</form>
<div>

<!-- Content here -->
<?php include("_templates/footer.php") ?>
</body>
</html>