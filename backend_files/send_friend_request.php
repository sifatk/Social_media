<?php
session_start();
include_once("db_connection.php");

$fromEmail = $_GET['from'];
$toEmail = $_GET['to'];
$fromID;
$toID;


//get userID from user email
$sql_get_user_id_for_friend_request = "SELECT A.User_ID, B.User_ID FROM user_information A, user_information B WHERE A.Email LIKE '$fromEmail' AND B.Email LIKE '$toEmail'";

$result_sql_get_user_id_for_friend_request = mysqli_query($conn, $sql_get_user_id_for_friend_request);

if (mysqli_num_rows($result_sql_get_user_id_for_friend_request) == 1) {
    $row = mysqli_fetch_row($result_sql_get_user_id_for_friend_request);
    $fromID = $row[0];
    $toID = $row[1];
}

//check if friend request already sent or {data already exists}
$friend_request_sent_already = FALSE;
$sql_whether_fr_req_al_sent = "SELECT too.Email FROM user_information fr JOIN friend_requests ON friend_requests.From_User_ID = fr.User_ID JOIN user_information too ON friend_requests.To_User_ID = too.User_ID WHERE fr.Email LIKE '$fromEmail' AND too.Email LIKE '$toEmail'";

$result_sql_whether_fr_req_al_sent = mysqli_query($conn, $sql_whether_fr_req_al_sent);

if (mysqli_num_rows($result_sql_whether_fr_req_al_sent) > 0) {
    while ($row_w_f_a_s = mysqli_fetch_row($result_sql_whether_fr_req_al_sent)) {
        if (strcmp($row_w_f_a_s[0], $toEmail) == 0) {
            $friend_request_sent_already = TRUE;
        }
    }
}

if ($friend_request_sent_already == FALSE) {
    // Insert user ID
    $sql_insert_friend_request = "INSERT INTO friend_requests(friend_requests.From_User_ID, friend_requests.To_User_ID) VALUES('$fromID', '$toID')";

    $result_sql_insert_friend_request = mysqli_query($conn, $sql_insert_friend_request);

    if ($result_sql_insert_friend_request) {
        $url = "http://localhost/social/profile.php?email=<?=$toEmail?>";
        header("Refresh: 1; URL = $url");
    } else {
        echo "insert fail";
    }
}
