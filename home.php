<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once("backend_files/db_connection.php");
    session_start();

    $current = $_SESSION["CurrentlyLoggedEmail"];
    $number_of_friend_req;
    $number_of_notification;
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/home.css">
    <link rel="shortcut icon" type="image/png" href="image/favicon_black_48.png">
    <!--From youtube: https://youtu.be/kEf1xSwX5D8 -->
    <title>Social Media</title>
</head>

<body>
    <!-- <h1>Login sucessfull</h1> -->

    <!-- https://materializecss.com/navbar.html -->
    <header>
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
    </header>

    <!-- search bar -->
    <div class="container">

        <form action="backend_files/search_people.php" method="POST" id="search_social_media">
            <input type="text" name="status_text" placeholder="Search Social Media User">
            <button class="btn-floating btn-large waves-effect waves-light grey darken-3" type="submit"><i class="material-icons">search</i></button>

        </form>
    </div>

    <div>
        <h4>Status Update</h4>
    </div>

    <div class="row">
        <div class="col s12 m6 l6">
            <div class="card grey darken-2">
                <div class="card-content white-text">
                    <span class="card-title">Status Update</span>
                    <!-- <p id="post_time">What's on your mind?</p> -->

                    <p>
                    </p>
                </div>
                <div class="card-action">
                    <form action="backend_files/send_statusUpdate.php" method="POST">
                        <input type="text" name="status_text" placeholder="What's on your mind?">
                        <button class="btn waves-effect waves-light deep-orange" type="submit"><i class="material-icons right">send</i>Post</button>
                        <!-- <a href="#"></a> -->
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="">
        <h4>News Feed</h2>
    </div>


    <!-- getting frinds post query -->
    <?php
    // getting all posts for the news feed (friends + self) QUERY
    $sql_get_post = "SELECT user_posts.User_ID, user_posts.Post_Timestamp, user_posts.Text FROM user_posts WHERE user_posts.User_ID IN (SELECT user_friendship_graph.User_ID_2 FROM user_friendship_graph WHERE user_friendship_graph.User_ID_1 = (SELECT user_information.User_ID FROM user_information WHERE user_information.Email LIKE '$current') UNION SELECT user_information.User_ID FROM user_information WHERE user_information.Email LIKE '$current')";

    $result = mysqli_query($conn, $sql_get_post);
    // $resultCheck = mysqli_num_rows($result);
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
</body>

</html>