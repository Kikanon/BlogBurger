
<?php
session_start();
if(!isset($_SESSION["user"])) {  //security
    die("Prokleti debil!");
}
include_once("_libs/db.php");


// Cheking if stuff is there
if(/*!isset($_POST["like"]) || */!isset($_POST["post"])) {
    die("Neveljaven vnos");
}

// Input
// $like = $_POST["like"] == 1;
$post = $conn->real_escape_string($_POST["post"]);



// Check if like allready exists
$sql3 = "SELECT * FROM likes WHERE UserID='" . $_SESSION['user']['UserID'] . "' AND PostID='" . $post . "'"; 
$result3 = $conn->query($sql3);

if(1) {
    if($result3->num_rows > 0) {
        die("Stop duping it's illegal. We can dupe for you for 50$ ;D");
    }

    $sql3 = "INSERT INTO `likes`(`PostID`, `UserID`) VALUES (" . $post."," . $_SESSION['user']['UserID'].")";
    if(!$conn->query($sql3)) {
        die("Sorry DB isn't working");
    }

    $sql3 = "UPDATE `posts` SET `Likes` = `Likes` + 1 WHERE `PostID`='$post';";
    if(!$conn->query($sql3)) {
        die("Is No work yes.");
    }



    
} else { //POPRAVIMO KO MAMO VECJI BUDGET
    if($result3->num_rows == 0) {
        die("There is nothing there. Like your dick.");
    }

    $sql3 = "DELETE FROM `likes` WHERE `UserID`='" .$_SESSION['user']['UserID'] . "' AND `PostID`='".$post."'"; 
    $result3 = $conn->query($sql3);
    if(!$result3) {
        die("Sorry DB isn't working");
    }
}
?>