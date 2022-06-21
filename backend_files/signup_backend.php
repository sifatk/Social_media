<?php
session_start();
include("db_connection.php");

$userFName =  trim($_POST["first_name"]);
$userLName = trim($_POST["last_name"]);
$userMobile = trim($_POST["phone"]);
$userEmail = trim($_POST["email"]);
$userPassword = trim($_POST["password"]);
$userDOB = trim($_POST["date"]);
$userGender = trim($_POST["gender"]);
$userCountry = trim($_POST["country_id"]);
$userPStatus = 0;

echo $userDOB;


$sql_max_id = "SELECT MAX(user_information.User_ID) FROM user_information";

$result_sql_max_id = mysqli_query($conn, $sql_max_id);

if (mysqli_num_rows($result_sql_max_id) == 1) {
    $row = mysqli_fetch_row($result_sql_max_id);

    $i = $row[0];
}

$i++;

$sql = "INSERT INTO `user_information` VALUES('$i', '$userFName','$userLName','$userMobile','$userEmail','$userPassword','$userDOB','$userGender','$userCountry','0')";


$result = mysqli_query($conn, $sql);
$rowNumber = mysqli_num_rows($result);

if ($rowNumber == 1) {
    echo "insert successfull";
    $url = "http://localhost/social/index.php";
    header("Refresh: 1; URL = $url");
} else {
    echo "insert failed";
    $url = "http://localhost/social/signup.php";
    header("Refresh: 1; URL = $url");
}
