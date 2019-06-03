<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("_templates/meta.php"); ?>
    <title>Main site</title>
</head>
<body>
<?php include("_templates/header.php") ?>
<!-- Content here -->

<?php
include_once("_libs/db.php");
if(isset($_POST['inputUsername'])){
date_default_timezone_set("Europe/Ljubljana");

$username = $_POST['inputUsername'];
$userpass = $_POST['inputPassword'];
$userpassc = $_POST['inputCPassword'];
$usermail = $_POST['inputEmail'];
$visit = date("m/d/Y, H:i:s");  //mesec/dan/leto, ura:minuta:sekunde
$ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

if($userpass==$userpassc) {  //Preveri da sta gesli enaki
	$find_at = strpos($usermail, '@');
    $find_dot = strpos($usermail, '.');
    if($find_at !== false && $find_dot !== false && $find_dot > $find_at ? true : false || $find_dot < $find_at ? true : false){  //Preveri pravilnost e maila
		  $sql = "SELECT UserID FROM users WHERE UserName LIKE '".$username."'";
      $bad = $conn->query($sql);
		  if($bad->num_rows < 1) {  //Preveri ce je uporabnisko ime ze zasedeno
		    $sql = "SELECT UserID FROM users WHERE UserMail LIKE '".$usermail."'";
        $ebad = $conn->query($sql);
			if($ebad->num_rows < 1) {   //Preveri ce je e mail ze zaseden
				$sql = "INSERT INTO users (UserID, UserName, UserMail, UserPass, UserType, UserRegistration, UserLastVisit) VALUES (NULL, '$username', '$usermail', '$userpass', '1', '$visit', '$visit');";
				$sucess = $conn->query($sql); 
				header('Location: index.php'); //preusmeri na glavno stran
			} else {
				echo "<h1>E-naslov je ze uporabljen.</h1><br>";
			}	
		} else {
		    echo "<h1>Uporabnik ze obstaja.</h1><br>";
			}
	} else {
		echo "<h1>E-naslov ni veljaven.</h1><br>";
	}
} else {
	echo "<h1>Gesli se ne ujemata.</h1><br>";
}
}
?>

<div class="container">
<form class="form-signin" method="POST">
  <div class="text-center mb-4">
    <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Registration forum</h1>
  </div>

  <div class="form-label-group">
    <input type="email" name="inputEmail" class="form-control" placeholder="Email address" required="true" autofocus="">
    <label for="inputEmail">Email address</label>
  </div>

  <div class="form-label-group">
    <input type="username" name="inputUsername" class="form-control" placeholder="Username" required="true" autofocus="">
    <label for="inputUsername">Username</label>
  </div>

  <div class="form-label-group">
    <input type="password" name="inputPassword" class="form-control" placeholder="Password" required="true">
    <label for="inputPassword">Password</label>
  </div>

  <div class="form-label-group">
    <input type="password" name="inputCPassword" class="form-control" placeholder="Confirm password" required="true" autofocus="">
    <label for="inputCPassword">Confirm password</label>
  </div>
 
  <input class="btn btn-lg btn-primary btn-block" type="submit" value="Register">
  <p class="mt-5 mb-3 text-muted text-center">© 2017-2019</p>
</form>
</div>

<!-- Content here -->
<?php include("_templates/footer.php") ?>
</body>
</html>