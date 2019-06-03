
<?php

$sql = "SELECT * FROM `posts` ORDER BY `Likes` DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // output data of each row

    while($row = $result->fetch_assoc()) {

        include("_post.php");
    }

} 
else {

    echo "0 results";
}
?>
