<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    session_start();
    include("db_connection.php");

    $search_key = $_POST["status_text"];
    $search_key = "%" . $search_key . "%";
    // echo $search_key;


    /*user fname*/
    $sql_user_by_FName = "SELECT CONCAT(user_information.First_Name, \" \", user_information.Last_Name), user_information.Email FROM user_information WHERE user_information.First_Name LIKE '$search_key'";

    $result_sql_user_by_FName = mysqli_query($conn, $sql_user_by_FName);

    /*user lname*/
    $sql_user_by_LName = "SELECT CONCAT(user_information.First_Name, \" \", user_information.Last_Name), user_information.Email FROM user_information WHERE user_information.Last_Name LIKE '$search_key'";

    $result_sql_user_by_LName = mysqli_query($conn, $sql_user_by_LName);

    /*user mobile*/
    $sql_user_by_Mobile = "SELECT CONCAT(user_information.First_Name, \" \", user_information.Last_Name), user_information.Email FROM user_information WHERE user_information.Mobile LIKE '$search_key'";

    $result_sql_user_by_Mobile = mysqli_query($conn, $sql_user_by_Mobile);

    /*user Email*/
    $sql_user_by_Email = "SELECT CONCAT(user_information.First_Name, \" \", user_information.Last_Name), user_information.Email FROM user_information WHERE user_information.Email LIKE '$search_key'";

    $result_sql_user_by_Email = mysqli_query($conn, $sql_user_by_Email);



    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Search Results</h1>

    <?php
    if (mysqli_num_rows($result_sql_user_by_FName) > 0) {
    ?>
        <p><?= "Search results by First Name" . "<br>" ?></p>
        <?php
        $i = 1;
        while ($row = mysqli_fetch_row($result_sql_user_by_FName)) {
        ?>
            <a href="http://localhost/social/profile.php?email=<?= $row[1] ?>">
                <p><?= $i . $row[0] . "<br>"; ?></p>
            </a>

    <?php
            $i++;
        }
    }
    ?>

    <?php
    if (mysqli_num_rows($result_sql_user_by_LName) > 0) {
    ?>
        <p><?= "Search results by Last Name" . "<br>" ?></p>
        <?php
        $i = 1;
        while ($row = mysqli_fetch_row($result_sql_user_by_LName)) {
        ?>
            <a href="http://localhost/social/profile.php?email=<?= $row[1] ?>">
                <p><?= $i . $row[0] . "<br>"; ?></p>
            </a>

    <?php
            $i++;
        }
    }
    ?>

    <?php
    if (mysqli_num_rows($result_sql_user_by_Email) > 0) {
    ?>
        <p><?= "Search results by Email" . "<br>" ?></p>
        <?php
        $i = 1;
        while ($row = mysqli_fetch_row($result_sql_user_by_Email)) {
        ?>
            <a href="http://localhost/social/profile.php?email=<?= $row[1] ?>">
                <p><?= $i . $row[0] . "<br>"; ?></p>
            </a>

    <?php
            $i++;
        }
    }
    ?>

    <?php
    if (mysqli_num_rows($result_sql_user_by_Mobile) > 0) {
    ?>
        <p><?= "Search results by Mobile" . "<br>" ?></p>
        <?php
        $i = 1;
        while ($row = mysqli_fetch_row($result_sql_user_by_Mobile)) {
        ?>
            <a href="http://localhost/social/profile.php?email=<?= $row[1] ?>">
                <p><?= $i . $row[0] . "<br>"; ?></p>
            </a>

    <?php
            $i++;
        }
    }
    ?>

</body>

</html>