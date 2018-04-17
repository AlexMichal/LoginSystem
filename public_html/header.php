<?php
    // We need to have this on all pages of the website otherwise user won't be logged in on that page
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- style sheet -->
    <link rel="stylesheet" type="text/css" href="stylesheets/style.css?v=<?= time() ?>">
    <!-- bootstrap --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script> 
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Facebuk</title>
</head>
<body>  
<!-- NAVIGATION BAR -->
<header>
    <!-- TODO signup should be more centered so it doesn't bleed to the right -->
    <nav id="navbar_main" class="navbar navbar-expand-sm navbar-light fixed-top">
        <div class="container">
            <!-- FB LOGO -->
            <div class="">
                <!-- TODO add button class? -->
                <a id="nav_home_btn" href="index.php" role="button">
                    <img src="assets/facebuk-sm.png" style="width: 30px; height: 30px" title="Facebuk logo" alt="Home">
                </a>
            </div>

            <!-- Dropdown menu (when screen becomes too small) -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_login_and_signup">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- LOG IN -->
            <div id="navbar_login_and_signup" class="collapse navbar-collapse">
                <?php
                if (isset($_SESSION['u_username'])) { // User is Logged in
                ?>
                    <form action="includes/logout.inc.php" method="POST">
                    <button type="submit" name="submit" class="btn btn-primary btn-sm">Logout</button>
                    </form>
                <?php
                } else { // User is NOT logged in
                ?>
                    <div class="">
                        <form class="form-inline" action="includes/login.inc.php" method="POST">
                            <input class="form-control" type="text" name="username" placeholder="username / e-mail">
                            <input class="form-control" type="password" name="password" placeholder="password">
                            <button class="form-control btn btn-primary btn-sm" type="submit" name="submit">Login</button>
                        </form>
                        <a class="nav-item btn btn-primary btn-sm" id="nav_signup_btn" href="signup.php" role="button">Sign up</a>
                    </div>
                <?php
                }
                ?>
                </div>
            </div>
    </nav>
</header>
<main>