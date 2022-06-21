<?php

session_start();
include("db_connection.php");

$current = $_SESSION["CurrentlyLoggedEmail"];

if (isset($_FILES['image'])) {
    $fileName = $_FILES['image']['name'];
    $fileTemp = $_FILES['image']['tmp_name'];
    $fileName = "profile_picture_" . "$current"; // setting name with currently logged in Email

    $explode = explode(".", $fileName); // tokenize using the delim '.'
    $extension = $explode[sizeof($explode) - 1]; // taking last item in the array => extension.

    $size = (($_FILES['image']['size']) / 1024.0) / 1024.0;
    move_uploaded_file($fileTemp, "cloud/" . $fileName);

    echo $extension . " " . $size . " MB";

    $sql_set_picture_status = "UPDATE user_information SET user_information.profile_picture_status = 1 WHERE user_information.Email LIKE '$current'";

    $sql_user_id = "SELECT user_information.User_ID FROM user_information WHERE user_information.Email LIKE '$current'";

    $result_ID = mysqli_query($conn, $sql_user_id);
    if ($result_ID) {
        while ($row = mysqli_fetch_row($result_ID)) {
            $currentID = $row[0];
        }
    }

    $sql_cloud = "INSERT INTO cloud(cloud.User_ID, cloud.File_Timestamp, cloud.File_Name, cloud.File_Path, cloud.File_Size_MB, cloud.File_Type) VALUES('$currentID', 'CURRENT_TIMESTAMP()', '$fileName', \"cloud\", '$size', '$extension')";

    $result_cloud = mysqli_query($conn, $sql_cloud);
    if ($result_cloud) {
        echo "cloud data insertion success";
    } else {
        echo "cloud data insertion fail";
    }


    $result = mysqli_query($conn, $sql_set_picture_status);

    if ($result) {
        echo "picture change successful";
        $url = "http://localhost/social/profile.php?email=<?= $current] ?>";
        header("Refresh: 1; URL = $url");
    } else {
        echo "picture change failed";
        $url = "http://localhost/social/profile.php?email=<?= $current ?>";
        header("Refresh: 1; URL = $url");
    }
}
