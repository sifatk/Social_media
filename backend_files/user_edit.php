<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("db_connection.php");
    session_start();
    $current = $_SESSION["CurrentlyLoggedEmail"];

    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $pass = $_POST["password"];
    $DOB = $_POST["date"];
    $gender = $_POST["gender"];



    $sql_edit = "UPDATE user_information SET user_information.First_Name = '$firstName', user_information.Last_Name = '$lastName', user_information.Email = '$email', user_information.Mobile = '$phone', user_information.Password = '$pass', user_information.Date_of_Birth = '$DOB', user_information.Gender = '$gender' WHERE user_information.Email LIKE '$current'";

    $result = mysqli_query($conn, $sql_edit);

    if ($result) {
        echo "Successful Edit";
        $url = "http://localhost/social/profile.php?email=<?= $current] ?>";
        header("Refresh: 1; URL = $url");
    } else {
        echo "Edit failed";
        $url = "http://localhost/social/profile.php?email=<?= $current ?>";
        header("Refresh: 1; URL = $url");
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>

<body>

</body>

</html>