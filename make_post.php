

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("_templates/meta.php"); ?>
    <title>Main site</title>
</head>
<body>
<?php include("_templates/header.php"); ?>
<?php include("_libs/login-guard.php"); ?>
<!-- Content here -->

<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST["inputTitle"])) {
        echo "<h1>The title is missing</h1>";
        return;
    }

    if(!isset($_POST["inputContent"])) {
        echo "<h1>The content is missing</h1>";
        return;
    }

    $title = $_POST['inputTitle'];
    $content = $_POST['inputContent'];
    $photo = "NULL";

    if(isset($_FILES['inputPicture'])) {
        $imageFileType = strtolower(pathinfo(basename($_FILES["inputPicture"]["name"]),PATHINFO_EXTENSION));
        include_once("_libs/uuid.php");
        $target_file = "_user_photos/" . gen_uuid() . "." .  $imageFileType;

        // Check type
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "<h1>Invalid file type</h1>";
                return;
        }

        if (!move_uploaded_file($_FILES["inputPicture"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            return;
        }

        $photo = "'/$target_file'";
    }


    include_once("_libs/db.php");
    $title = $conn->real_escape_string($title);
    $content = $conn->real_escape_string($content);

    $user_id=$_SESSION['user']["UserID"];

    if ($conn->query("INSERT INTO posts(UserID, Title, Text, ImagePath) VALUES ('$user_id', '$title', '$content', $photo)")) {
        echo "New record created successfully";
    } else {
        echo "Error: " . "<br>" . $conn->error;
    }
}







?>




<div class="container">
<form class="form-signin" method="POST" enctype="multipart/form-data">
  <div class="text-center mb-4">
    <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">New Burger </h1>
  </div>

  <div class="form-label-group">
    <input type="text" id="inputTitle" name="inputTitle" class="form-control" placeholder="Title" required autofocus>
    <label for="inputTitle">Title</label>
  </div>

  <div class="form-label-group">
    <textarea rows="10" cols="120" type="text" id="inputContent" name="inputContent" class="form-control" placeholder="Content" required></textarea>
    <label for="inputContent">Content</label>
  </div>

  
  <div class="form-label-group">
    <input type="file" id="inputPicture" name="inputPicture" class="form-control" accept=".jpg,.jpeg,.png,.gif"></textarea>
    <label for="inputContent">Picture</label>
  </div>


  <button type="sibmit" class="btn btn-lg btn-primary btn-block" onclick="login()">Post</button>
  <p class="mt-5 mb-3 text-muted text-center">© 2017-2019</p>
</form>

</div>
<?php 
?>
<!-- Content here -->
<?php include("_templates/footer.php"); ?>
</body>
</html>