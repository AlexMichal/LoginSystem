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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<title></title>
</head>
<body>  
<!-- NAVIGATION BAR -->
<header>
    <nav id="navbar_main" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- HOME button -->
            <div class="main-wrapper">
                <ul>
                    <!-- TODO add button class? -->
                    <li><a id="nav_home_btn" href="index.php" role="button">Home</a></li> 
                </ul>
            </div>
            
            <!-- LOG IN -->
            <div id="navbar_login" class="nav_login">
                <?php
                    $loggedInHTML = 
                        '<form action="includes/logout.inc.php" method="POST">' .
                        '<button type="submit" name="submit" class="btn btn-primary btn-sm">Logout</button>' .
                        '</form>';
                    $notLoggedInHTML =  
                        '<form action="includes/login.inc.php" method="POST">' . 
                        '<input type="text" name="username" placeholder="Username/e-mail">' .
                        '<input type="password" name="password" placeholder="password">' .
                        '<button type="submit" name="submit" class="btn btn-primary btn-sm">Login</button>'.
                        '</form>' .
                        '<a id="nav_signup_btn" href="signup.php" class="btn btn-primary btn-sm" role="button">Sign up</a>';

                    if (isset($_SESSION['u_username'])) {
                        echo $loggedInHTML;
                    } else { // Not logged in
                        echo $notLoggedInHTML;
                    }
                ?>
            </div>
        </div>
    </nav>
</header>