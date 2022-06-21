<!DOCTYPE html>
<html lang="en">

<head>
    <?php session_start() ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/signup.css" />
    <link rel="shortcut icon" type="image/png" href="image/favicon_black_48.png">
    <!--From youtube: https://youtu.be/kEf1xSwX5D8 -->


    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style/login.css">
    <title>Social Meadia - Signup</title>

    <style>
        body {
            background-color: #212121;
            color: aliceblue;
        }

        #signup_main_h1 {
            font-family: "Exo", sans-serif;
            color: #ff5722;
        }

        #index_main_p {
            font-family: "Exo", sans-serif;
            color: #bdbdbd;
            /* color: #00695c; */
            font-size: small;
        }

        #signup_for {
            font-family: "Exo", sans-serif;
            /* color: #bdbdbd; */
            color: #00695c;
            font-size: small;
        }

        #country_div {
            margin-top: 20px;
            margin-bottom: 20px;
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
                <p id="signup_for">Signup for</p>
                <h2 id="signup_main_h1"><i class="medium material-icons" id="site_icon">share</i>Social Media
                </h2>
                <!-- Signup for <br> -->

                <p id="index_main_p">It's quick and easy.</p>
            </div>

            <div class="col s6 m6 l6">
                <!-- signup form -->
                <div class="card grey darken-2">
                    <div class="card-content white-text">


                        <form action="backend_files/signup_backend.php" method="post" id="signup">
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
                                <p>
                                    <label>
                                        <input name="gender" type="radio" id="male" required>
                                        <span>Male</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input name="gender" type="radio" id="female" required>
                                        <span>Female</span>
                                    </label>
                                </p>
                            </div>

                            <div id="country_div">
                                Country ID
                                <input type="num" name="country_id" id="country_id" placeholder="Country ID (BD -> 2)" required />
                            </div>
                        </form>

                        <div class="card-action">
                            <div class="container center">
                                <button class="btn waves-effect waves-light teal darken-3" form="signup"><a href="http://localhost/social/backend_files/signup_backend.php">Sign Up</a></button>
                            </div>
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