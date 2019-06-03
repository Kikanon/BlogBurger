<?php

function echo_json($statusCode, $data) {
  http_response_code($statusCode);
  header('Content-Type: application/json');
  echo json_encode($data);
  exit(1);
}

function echo_err($statusCode, $error, $message) {
  echo_json($statusCode, (object)[
    status => $statusCode,
    error => $error,
    error_description => $message
  ]);
}

session_start();
if(!isset($_SESSION["user"])) {  //security
  echo_err(401, "unauthorized", "You must be logged in");
}
include_once("_libs/db.php");

// Check if POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo_err(400, "invalid_method", "Unsupported method type");
}

// Parse json body
$postData = file_get_contents("php://input");
if (isset($postData) && !empty($postData)) {
  $_GET = (array) json_decode($postData);
}

// Check required input
if (!isset($_POST["post_id"])) {
  echo_err(400, "invalid_args", "'post_id' argument is missing");
}
if (!isset($_POST["like"])) {
  echo_err(400, "invalid_args", "'like' argument is missing");
}

$post_id = $_POST["post_id"];
$like = $_POST["like"] === "true";

// Escape
$post_id = $conn->real_escape_string($post_id);


// Check if post exists
$query = $conn->query("SELECT * FROM posts WHERE id='$post_id' LIMIT 1");
if (!$query) {
  echo_err(500, "database_query", "Unable to query database");
}

if ($query->num_rows == 0) {
  echo_err(404, "unknown", "That post doesn't exist.");
}

// Like
$query = $conn->query("SELECT * FROM likes WHERE PostID='$post_id' AND UserID='" . $_SESSION['user']['UserID'] . "' LIMIT 1");
if (!$query) {
  echo_err(500, "database_query", "Unable to query database");
}

$op = 0;
if ($query->num_rows == 0) {
  $op = $like ? 1 : 0;
} else {
  $saved = $query->fetch_assoc()['active'] == 1;
  if ($saved == $like) {
    $op = 0;
  } else {
    $op = $saved ? -1 : 1;
  }
}

if ($query->num_rows == 0) {
  $query = $conn->query("INSERT INTO likes (PostID, UserID, active) VALUES ('$post_id', '" . $_SESSION['user']['UserID'] . "', " . ($like ? "true" : "false") . ")");
  if (!$query) {
    echo_err(500, "database_query", "Unable to query database");
  }
} else {
  $query = $conn->query("UPDATE likes SET active=" . ($like ? "true" : "false") . " WHERE PostID='$post_id' AND UserID='" . $_SESSION['user']['UserID'] . "'");
  if (!$query) {
    echo_err(500, "database_query", "Unable to query database");
  }
}

if ($op != 0) {
  $query = $conn->query("UPDATE posts SET Likes = Likes" . ($op == 1? " + 1": " - 1") . " WHERE PostID='$post_id'");
  if (!$query) {
    echo_err(500, "database_query", "Unable to query database");
  }
}

// Ok
echo_json(200, (object)["status" => "OK"]);
