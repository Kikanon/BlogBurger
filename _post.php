<div class="container bg-transparent border border-warning">

<h6>Post by: <?php
include("_templates/meta.php");
$id2 = $row["UserID"];
$sql2 = "SELECT UserName FROM users WHERE UserID='$id2'"; 
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    // output data of each row

        echo  $row2["UserName"]; 
}
?></h6>
    <!-- NASLOV  -->
<h4>Title: 
<?php echo  $row["Title"]; ?>
</h4>

     <!-- BESEDILO  -->
<?php echo  $row["Text"]; ?>
<br>
      <!-- SLIKA  -->
      
<img  style="margin:auto; width:700px; display:block;" src="<?php echo  $row["ImagePath"]; ?>">
<br>
      <!-- Samo ce si prijavljen  -->
<?php if(isset($_SESSION['user'])){ ?>

<?php
$sql3 = "SELECT * FROM likes WHERE UserID='" . $_SESSION['user']['UserID'] . "' AND PostID='" . $row['PostID'] . "' AND active='1'"; 
$result3 = $conn->query($sql3);
$liked = ($result3->num_rows > 0);
?>
  <!-- Like button  -->

<br>
<img class="levo" id="like-<?php echo $row['PostID']; ?>" src="<?php  echo $liked? " _images/like_button1.png": " _images/like_button.png"; ?>" width=50px onclick="LikeButton(<?php echo $row['PostID']; ?>)">

  <!-- Stevilo likov  -->

<p>Likes:
<span id="likes-<?php echo  $row["PostID"]; ?>">
<?php echo  $row["Likes"]; ?>
</span>
</p>

<br>

<?php } // zapre if user check
?>



</div>
<br>