<?php
session_start();
include("db_connection.php");

$_SESSION["CurrentlyLoggedEmail"] = $_SESSION["UserEmail"] = $userEmail = $_POST['email_input'];
$_SESSION["UserEmail"] = $userEmail = $_POST['email_input'];
$_SESSION["UserPhone"] = $userPhone = $_POST['phone_input'];
$_SESSION["UserPass"] = $userPassword = $_POST['password_input'];

$loginStatus = "Unsuccessful";

if (trim($userEmail) == "" || trim($userPassword) == "") {
    echo "Please enter a valid input." . "<br>";

    $url = "http://localhost/social/index.php";
    header("Refresh: 1; URL = $url");
} else {
    $sql = "SELECT user_information.Email, user_information.Password FROM user_information WHERE user_information.Email = '$userEmail' AND user_information.Password = '$userPassword'";

    $result = mysqli_query($conn, $sql);
    $rowNumber = mysqli_num_rows($result);
    if ($rowNumber == 1) {
        $loginStatus = "Successfull";
    }
}

if ($loginStatus == "Successfull") {
    $url = "http://localhost/social/home.php";
    header("Refresh: 1; URL = $url");
} else {
    $url = "http://localhost/social/index.php";
    header("Refresh: 1; URL = $url");
}
