<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once("backend_files/db_connection.php");
    session_start();
    $current = $_SESSION["CurrentlyLoggedEmail"];


    $sql = "SELECT * FROM user_information WHERE user_information.Email LIKE '$current'";
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

    <title><?= "Edit Profile" . " | " . "$userFName " . "$userLName" ?></title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Exo:wght@900&display=swap");

        #signup_main_h1 {
            font-family: "Exo", sans-serif;
        }
    </style>
</head>

<body>
    <!-- <div class="container"> -->
    <h1 id="signup_main_h1">Edit your profile</h1>


    <form action="backend_files/user_edit.php" method="post">
        <div>
            <input type="text" name="first_name" id="first_name" placeholder="First name" required />
        </div>

        <div>
            <input type="text" name="last_name" id="last_name" placeholder="Last name" required />
        </div>

        <div>
            <input type="email" name="email" id="email" placeholder="Email address" required />
        </div>

        <div>
            <input type="tel" name="phone" id="phone" placeholder="Phone number" required />
        </div>

        <div>
            <input type="password" name="password" id="password" placeholder="Password" required />
        </div>

        <div>
            <label for="date">Date of birth</label><br />
            <input type="date" name="date" id="date" />
        </div>

        Gender
        <div>
            <label for="male">Male</label>
            <input type="radio" name="gender" id="male" />
        </div>
        <div>
            <label for="female">Female</label>
            <input type="radio" name="gender" id="female" />
        </div>

        <div>
            <button type="submit">Complete Edit</button>
        </div>
    </form>

    <!-- <form action="backend_files/profile_picture_change.php" method="POST" enctype="multipart/form-data">
        <h1 id="signup_main_h1">Change Profile Picture</h1>
        <input type="file" name="image" id="">
        <input type="submit" value="Submit">
    </form> -->


    <!-- </div> -->

</body>

</html>