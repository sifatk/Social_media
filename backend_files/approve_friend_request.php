<?php
include("db_connection.php");
session_start();
$current = $_SESSION["CurrentlyLoggedEmail"];
$to_approve_email = $_GET['email'];


/*
SELECT fr.Email, too.Email
FROM user_information fr
JOIN friend_requests
	ON friend_requests.From_User_ID = fr.User_ID
JOIN user_information too
	ON too.User_ID = friend_requests.To_User_ID
WHERE fr.Email LIKE '$to_approve_email' AND too.Email LIKE '$current'
 */
//check if the request is still valid
$sql_check_FR_ava = "SELECT fr.Email, too.Email FROM user_information fr JOIN friend_requests ON friend_requests.From_User_ID = fr.User_ID JOIN user_information too ON too.User_ID = friend_requests.To_User_ID WHERE fr.Email LIKE '$to_approve_email' AND too.Email LIKE '$current'";

$result_sql_check_FR_ava = mysqli_query($conn, $sql_check_FR_ava);

if (mysqli_num_rows($result_sql_check_FR_ava) > 0) { // approve and delete

    /* 
    INSERT INTO user_friendship_graph(user_friendship_graph.User_ID_1, user_friendship_graph.User_ID_2) 
    SELECT fr.User_ID, too.User_ID
    FROM user_information fr, user_information too
    WHERE fr.Email LIKE '$to_approve_email' AND too.Email LIKE '$current'
    */
    //insert into friendship_graph
    $sql_add_them_as_friend = "INSERT INTO user_friendship_graph(user_friendship_graph.User_ID_1, user_friendship_graph.User_ID_2) SELECT fr.User_ID, too.User_ID FROM user_information fr, user_information too WHERE fr.Email LIKE '$to_approve_email' AND too.Email LIKE '$current'";

    $result_sql_add_them_as_friend = mysqli_query($conn, $sql_add_them_as_friend);

    if ($result_sql_add_them_as_friend) {
        //success;
    } else {
        echo "adding friendship failed";
    }



    /*
    DELETE FROM user_friendship_graph 
    WHERE user_friendship_graph.User_ID_1 =  (
	SELECT user_information.User_ID
    FROM user_information
    WHERE user_information.Email LIKE '$to_approve_email'
) AND user_friendship_graph.User_ID_2 = (
	SELECT user_information.User_ID
    FROM user_information
    WHERE user_information.Email LIKE '$current'
)
    */
    //delete from friend_request
    $sql_delete_from_fr_graph = "DELETE FROM user_friendship_graph WHERE user_friendship_graph.User_ID_1 =  (SELECT user_information.User_ID FROM user_information WHERE user_information.Email LIKE '$to_approve_email') AND user_friendship_graph.User_ID_2 = (SELECT user_information.User_ID FROM user_information WHERE user_information.Email LIKE '$current')";

    $result_sql_delete_from_fr_graph = mysqli_query($conn, $sql_delete_from_fr_graph);

    if ($result_sql_delete_from_fr_graph) {
        echo "success";
    } else {
        echo "deleting failed";
    }
} else {
    echo "Friend Request expired";
}
