<!DOCTYPE html>
<html lang="en">

<head>
    <?php session_start() ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shortcut icon" type="image/png" href="image/favicon_black_48.png">
    <!--From youtube: https://youtu.be/kEf1xSwX5D8 -->
    <title>Social Media - Login or Signup</title>


    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style/login.css">


    <style>
        body {
            background-color: #212121;
            color: aliceblue;
        }

        #index_main_h1 {
            font-family: "Exo", sans-serif;
            color: #ff5722;
        }

        #index_main_p {
            font-family: "Exo", sans-serif;
            color: #bdbdbd;
            font-size: large;
        }

        #main_int {
            padding-top: 10%;
        }
    </style>

</head>

<body>


    <div class="container" id="main_int">
        <div class="row">



            <div class="col s6 m6 l6">
                <h2 id="index_main_h1"><i class="medium material-icons" id="site_icon">share</i>Social Media</h2>

                <p id="index_main_p">Social Media helps you connect and share with the people<br>in your life.</p>
            </div>

            <div class="col s6 m6 l6">
                <!-- login form  -->
                <div class="card grey darken-2">
                    <div class="card-content white-text">


                        <form action="backend_files/login_backend.php" method="post" id="login">

                            <div>
                                <input type="email" name="email_input" id="email_input" placeholder="Enter your email address" required>
                            </div>
                            <div>
                                <input type="tel" name="phone_input" id="phone_input" placeholder="Enter your phone number" required>
                            </div>

                            <div>
                                <input type="password" name="password_input" id="password_input" placeholder="Password" required>
                            </div>


                            <!-- <div>
                            <a href="#">Forgotten Password?</a>
                        </div> -->
                        </form>

                        <div class="card-action">
                            <button class="btn waves-effect waves-light deep-orange" type="submit" form="login">Log In</button>

                            <button class="btn waves-effect waves-light teal darken-3 right"><a href="http://localhost/social/signup.php">Sign Up</a></button>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>


    <footer class="page-footer grey darken-3" style="position: fixed; bottom:0; left:0; width: 100%;">

        <!-- <div class="footer-copyright grey darken-4"> -->
        <div class="container center-align">&copy; 2020 Social Media</div>
        <!-- </div> -->
    </footer>

</body>

</html>
