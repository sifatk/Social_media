<?php
session_start();
include("db_connection.php");

$status_text = $_POST["status_text"];
$current = $_SESSION["CurrentlyLoggedEmail"];


$sql_to_insert_status_text = "INSERT INTO user_posts(user_posts.User_ID, user_posts.Post_Timestamp, user_posts.Text) SELECT user_information.User_ID, CURRENT_TIMESTAMP(), '$status_text' FROM user_information WHERE user_information.Email LIKE '$current'";

$result_sql_to_insert_status_text = mysqli_query($conn, $sql_to_insert_status_text);

if ($result_sql_to_insert_status_text) {
    $url = "http://localhost/social/home.php";
    header("Refresh: 1; URL = $url");
} else {
    echo "insert fail";
}
