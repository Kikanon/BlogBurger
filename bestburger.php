<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("_templates/meta.php"); ?>
    <title>BestBurgers</title>
</head>
<body>
<?php include("_templates/header.php"); ?>
<!-- Content here -->
<br>
<?php
include_once("_libs/db.php");

 $result = $conn->query("SELECT * FROM `posts`");
 if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
     ?>
 
     <div>
 
     </div>
 
     <?php
     }
 } else {
     echo "No posts";
 }


include("post2.php");
?>




<!-- posts here -->




<!-- Content here -->
<?php include("_templates/footer.php"); ?>
</body>
</html>