<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    include_once("backend_files/db_connection.php");

    $current = $_SESSION["CurrentlyLoggedEmail"];
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="image/favicon_black_48.png">
    <!--From youtube: https://youtu.be/kEf1xSwX5D8 -->
    <link rel="stylesheet" href="style/friend_request.css">
    <title>Friend Requests</title>
</head>

<body>
    <!-- https://materializecss.com/navbar.html -->
    <nav class="nav-wrapper deep-orange">
        <!-- <div class="container"> -->

        <a href="#" class="brand-logo"><i class="material-icons" id="site_icon">share</i>Social Media</a>



        <ul class="right">
            <li>
                <!--Friend Request -->
                <a href="http://localhost/social/home.php"><i class="material-icons" id="home_icon">home</i></a>
            </li>
            <li>
                <a href="http://localhost/social/profile.php?email=<?= $current ?>"><i class="material-icons" id="account_icon">account_box</i></a>
            </li>
            <li>
                <a href="http://localhost/social/friend_request.php"><i class="material-icons" id="friend_req">person_add_alt_1</i></a>
            </li>
            <li>
                <!-- Friend Request badge-->
                <!-- SQL QUERY to get the number of Friend Requests available -->
                <?php
                $sql_friend_request_recieved = "SELECT COUNT(friend_requests.From_User_ID) FROM friend_requests JOIN user_information ON user_information.User_ID = friend_requests.To_User_ID WHERE user_information.Email LIKE '$current'";

                $result_sql_friend_request_recieved = mysqli_query($conn, $sql_friend_request_recieved);

                if (mysqli_num_rows($result_sql_friend_request_recieved) == 1) {
                    $row_f_r_r = mysqli_fetch_row($result_sql_friend_request_recieved);
                    // echo isset($number_of_friend_req);
                    $number_of_friend_req = $row_f_r_r[0];
                    // echo isset($number_of_friend_req);
                }
                ?>

                <span class="badge white-text grey darken-2 new" data-badge-caption=""><?= $number_of_friend_req ?></span>
            </li>

            <li>
                <!-- Notification-->
                <a href="http://localhost/social/notification.php"><i class="material-icons" id="notifications">notifications</i></a>
            </li>
            <li>
                <!-- Notification badge-->
                <!-- SQL QUERY to get the number of notification recieved -->
                <?php
                $sql_notification_recieved = "SELECT COUNT(notification.User_ID) FROM notification JOIN user_information ON user_information.User_ID = notification.User_ID WHERE user_information.Email LIKE '$current'";

                $result_sql_notification_recieved = mysqli_query($conn, $sql_notification_recieved);

                if (mysqli_num_rows($result_sql_notification_recieved) == 1) {
                    $row_n_r = mysqli_fetch_row($result_sql_notification_recieved);
                    $number_of_notification = $row_n_r[0];
                }
                ?>

                <span class="badge white-text grey darken-2 new" data-badge-caption=""><?= $number_of_notification ?></span>
            </li>
            <li>
                <!-- Logout -->
                <a href="backend_files/logout_backend.php"><i class="material-icons" id="notifications">exit_to_app</i></a>


            </li>


        </ul>
        <!-- </div> -->
    </nav>
    <?php
    $sql_sent_you_friend_request = "SELECT CONCAT(user_information.First_Name, \" \", user_information.Last_Name), user_information.Email FROM friend_requests JOIN user_information ON user_information.User_ID = friend_requests.From_User_ID WHERE friend_requests.To_User_ID = ( SELECT user_information.User_ID FROM user_information WHERE user_information.Email LIKE '$current')";

    $result_sql_sent_you_friend_request = mysqli_query($conn, $sql_sent_you_friend_request);

    if (mysqli_num_rows($result_sql_sent_you_friend_request) > 0) {
        while ($row_w_s_f_r = mysqli_fetch_row($result_sql_sent_you_friend_request)) {
    ?>
            <h1><?= $row_w_s_f_r[0] ?></h1>
            <a href="backend_files/approve_friend_request.php?email=<?= $row_w_s_f_r[1]; ?>"><i class="material-icons">check</i>Confirm</a>
            <a href="backend_files/dismiss_friend_request.php?email=<?= $row_w_s_f_r[1]; ?>"><i class="material-icons">clear</i>Delete</a>
    <?php
        }
    }
    ?>



</body>

</html>