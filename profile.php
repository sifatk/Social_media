<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once("backend_files/db_connection.php");
    session_start();
    $current = $_SESSION["CurrentlyLoggedEmail"];

    // echo $_GET['email'];
    // $userEmail = $_SESSION["UserEmail"];
    // echo $current;
    $userEmail = $_GET['email'];

    $sql = "SELECT * FROM user_information WHERE user_information.Email LIKE '$userEmail'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_row($result)) {
            $userFName = $row[1];
            $userLName = $row[2];
            $userMobile = $row[3];
            $userEmail = $row[4];
            $userPassword = $row[5];
            $userDOB = $row[6];
            $userGender = $row[7];
            $userCountry = $row[8];
            $userPStatus = $row[9];
        }
    }
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="image/favicon_black_48.png">
    <!--From youtube: https://youtu.be/kEf1xSwX5D8 -->
    <link rel="stylesheet" href="style/profile.css">
    <title><?= "$userFName " . "$userLName " . "| Social Media" ?></title>
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
    <div class="container">

        <?php
        if ($userPStatus == 0) { // Photo not set
            if (strcmp($userGender, "Male") == 0) { // Male

        ?>
                <div class="container">
                    <img src="image/def_profile_picture_male.jpg" alt="">
                </div>
            <?php
            } else if (strcmp($userGender, "Female") == 0) { // Female
            ?>
                <div class="container">
                    <img src="image/def_profile_picture_female.jpg" alt="">
                </div>
            <?php
            }
        } else { // Use uploaded photo
            ?>
            <img src="<?= "image/def_profile_picture_male.jpg" ?>" alt="">
        <?php
        }
        ?>


        <!-- fetch people that are not friends -->
        <?php
        //Not friends Query
        $profile_owner_is_not_friend = TRUE;
        $profile_of_currently_logged_in = (strcmp($current, $userEmail) == 0) ? TRUE : FALSE;


        // $sql_not_friends = "SELECT user_information.Email FROM user_information WHERE user_information.User_ID NOT IN (SELECT user_information.User_ID FROM user_information WHERE user_information.User_ID IN (SELECT T.RESULT FROM (SELECT user_friendship_graph.User_ID_1 AS \"MAIN\", user_friendship_graph.User_ID_2 AS \"RESULT\" FROM user_friendship_graph WHERE USER_ID_1 = (SELECT user_information.User_ID FROM user_information WHERE user_information.Email LIKE '$current') UNION SELECT user_friendship_graph.User_ID_2 AS \"MAIN\", user_friendship_graph.User_ID_1 AS \"RESULT\" FROM user_friendship_graph WHERE USER_ID_2 = (SELECT user_information.User_ID FROM user_information WHERE user_information.Email LIKE '$current')) AS T)) AND user_information.User_ID <> (SELECT user_information.User_ID FROM user_information WHERE user_information.Email LIKE '$current')";

        // $result_not_frinds = mysqli_query($conn, $sql_not_friends);

        //All friends of this profile QUERY
        $sql_all_friends_this_profile = "SELECT CONCAT(user_information.First_Name, \" \", user_information.Last_Name), user_information.Email FROM user_information WHERE user_information.User_ID IN (SELECT T.RESULT FROM (SELECT user_friendship_graph.User_ID_1 AS \"MAIN\", user_friendship_graph.User_ID_2 AS \"RESULT\" FROM user_friendship_graph WHERE USER_ID_1 = (SELECT user_information.User_ID FROM user_information WHERE user_information.Email LIKE '$userEmail') UNION SELECT user_friendship_graph.User_ID_2 AS \"MAIN\", user_friendship_graph.User_ID_1 AS \"RESULT\" FROM user_friendship_graph WHERE USER_ID_2 = (SELECT user_information.User_ID FROM user_information WHERE user_information.Email LIKE '$userEmail')) AS T)";

        $result_all_friends_this_profile = mysqli_query($conn, $sql_all_friends_this_profile);



        // Friends of Currently logged in user
        $sql_friends_current =
            "SELECT user_information.Email FROM user_information WHERE user_information.User_ID IN (SELECT T.RESULT FROM (SELECT user_friendship_graph.User_ID_1 AS \"MAIN\", user_friendship_graph.User_ID_2 AS \"RESULT\" FROM user_friendship_graph WHERE USER_ID_1 = (SELECT user_information.User_ID FROM user_information WHERE user_information.Email LIKE '$current') UNION SELECT user_friendship_graph.User_ID_2 AS \"MAIN\", user_friendship_graph.User_ID_1 AS \"RESULT\" FROM user_friendship_graph WHERE USER_ID_2 = (SELECT user_information.User_ID FROM user_information WHERE user_information.Email LIKE '$current')) AS T)";

        $result_sql_friends_current = mysqli_query($conn, $sql_friends_current);

        if (mysqli_num_rows($result_sql_friends_current) > 0) {
            while ($rowC = mysqli_fetch_row($result_sql_friends_current)) {
                if (strcmp($rowC[0], $userEmail) == 0) {
                    $profile_owner_is_not_friend = FALSE;
                }
            }
        }


        // check if currently logged in already sent a freind request
        $friend_request_sent_already = FALSE;
        $sql_whether_fr_req_al_sent = "SELECT too.Email FROM user_information fr JOIN friend_requests ON friend_requests.From_User_ID = fr.User_ID JOIN user_information too ON friend_requests.To_User_ID = too.User_ID WHERE fr.Email LIKE '$current' AND too.Email LIKE '$userEmail'";

        $result_sql_whether_fr_req_al_sent = mysqli_query($conn, $sql_whether_fr_req_al_sent);

        if (mysqli_num_rows($result_sql_whether_fr_req_al_sent) > 0) {
            while ($row_w_f_a_s = mysqli_fetch_row($result_sql_whether_fr_req_al_sent)) {
                if (strcmp($row_w_f_a_s[0], $userEmail) == 0) {
                    $friend_request_sent_already = TRUE;
                }
            }
        }
        ?>

        <?php
        if ($profile_of_currently_logged_in == TRUE) { // OWN
        ?>
            <div class="container">
                <a href="#" class="waves-effect waves-light btn-small deep-orange right"><i class="material-icons right">mood</i>Own Profile</a>
            </div>
            <?php
        } else {
            if ($profile_owner_is_not_friend == TRUE && $friend_request_sent_already == FALSE) { // NOT FRIENDS
                if ($friend_request_sent_already == TRUE) {
            ?>
                <?php
                }
                ?>
                <div class="container">
                    <a href="backend_files/send_friend_request.php?from=<?= $current ?>&to=<?= $userEmail ?>" class="waves-effect waves-light btn-small deep-orange right"><i class="material-icons right">person_add_alt_1</i>Add Friend</a>
                </div>
                <!-- ^add friend -->
            <?php
            } else if ($profile_owner_is_not_friend == TRUE && $friend_request_sent_already == TRUE) {
            ?>
                <div class="container">
                    <a href="#" class="waves-effect waves-light btn-small deep-orange right"><i class="material-icons right">check_circle</i>Request Sent</a>
                </div>
                <!-- ^Request Sent -->
            <?php
            } else { // FRIENDS
            ?>
                <div class="container">
                    <a href="#" class="waves-effect waves-light btn-small deep-orange right"><i class="material-icons right">done</i>Friends</a>
                </div>
                <!-- ^already friend -->
        <?php
            }
        }
        ?>




        <h1><?= "$userFName " . "$userLName " ?></h1>


        <h4>Timeline</h4>
        <!-- Fetch all personal posts Query -->
        <?php
        $sql = "SELECT user_posts.User_ID, user_posts.Post_Timestamp, user_posts.Text FROM user_posts WHERE user_posts.User_ID = (SELECT user_information.User_ID FROM user_information WHERE user_information.Email LIKE '$userEmail')";

        $result = mysqli_query($conn, $sql);

        ?>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_row($result)) {
                // print_r($row);
                $user_id = $row[0];
                $post_timestamp = $row[1];
                $post_text = $row[2];

                //QUERY to get user name from user ID
                $sql_get_name = "SELECT CONCAT(user_information.First_Name, \" \", user_information.Last_Name) FROM user_information WHERE user_information.User_ID = '$user_id'";
                $result_get_name = mysqli_query($conn, $sql_get_name);
                while ($row_name = mysqli_fetch_row($result_get_name)) {
                    $user_name = $row_name[0];
                }
                // echo $user_id . " " . $post_timestamp . " " . $post_text;

        ?>
                <!-- https://materializecss.com/cards.html -->
                <div class="row">
                    <div class="col s12 m6 l4">
                        <div class="card grey darken-2">
                            <div class="card-content white-text">
                                <span class="card-title" id="user_name"><?= $user_name ?></span>
                                <p id="post_time"><?= date("F j, Y g:i A", strtotime($post_timestamp)); ?></p>
                                <hr>
                                <p><?= $post_text ?>
                                </p>
                            </div>
                            <div class="card-action">
                                <a href="#"></a>
                            </div>
                        </div>
                    </div>
                </div>


        <?php
            }
        } else {
            echo "<h5>Your News Feed is Empty <i class=\"material-icons\">sentiment_very_dissatisfied</i></h5>";
        }
        ?>
        <?php
        $sql_country = "SELECT country.Country_Name FROM country WHERE country.Country_ID = '$userCountry'";
        $result_country = mysqli_query($conn, $sql_country);
        if (mysqli_num_rows($result_country)) {
            while ($row = mysqli_fetch_row($result_country)) {
                $country_name = $row[0];
            }
        }
        ?>

        <h4>About</h4>
        <!-- https://materializecss.com/cards.html -->
        <div class="row">
            <div class="col s12 m6 l4">
                <div class="card grey darken-2">
                    <div class="card-content white-text">
                        <!-- <span class="card-title" id="user_name"><?= $user_name ?></span> -->

                        <div>
                            <i class="material-icons">call</i>
                            <?= $userMobile; ?>

                        </div>

                        <div>
                            <i class="material-icons">mail</i>
                            <a href="mailto:<?= $userEmail; ?>"><?= $userEmail ?></a>
                        </div>

                        <div>
                            <i class="material-icons">cake</i>
                            <?= date("F j, Y", strtotime($userDOB)); ?>
                        </div>

                        <div>
                            <i class="material-icons">supervised_user_circle</i>
                            <?= $userGender; ?>
                        </div>

                        <div>
                            <i class="material-icons">outlined_flag</i>
                            <?= $country_name; ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>



        <h4>Friends</h4>
        <!-- fetch all friends QUERY -->
        <?php
        // ^ friends QUERY above

        if (mysqli_num_rows($result_all_friends_this_profile) > 0) {
            while ($row = mysqli_fetch_row($result_all_friends_this_profile)) {
        ?>
                <a href="http://localhost/social/profile.php?email=<?= $row[1] ?>"><?= $row[0] . "<br>"; ?></a>
        <?php
            }
        }
        ?>

        <?php
        if (strcmp($userEmail, $current) == 0) { // profile owner can edit the profile
        ?>
            <div class="container center">
                <a href="http://localhost/social/edit.php" class="waves-effect waves-light btn-large deep-orange"><i class="material-icons">create</i>Edit</a>
            </div>
        <?php
        }
        ?>

    </div>


    <!-- Timeline -->
    <!-- about -->
    <!-- Friends -->
    <!-- Photos // <-depends on file upload-->
    <!-- edit -->
</body>

</html>