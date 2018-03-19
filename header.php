<?php
    // need to have this on all pages of the website otherwise user won't be logged in on that page
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
<title></title>
</head>
<body>
    <header>
        <nav>
            <div class="main-wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                </ul>
            </div>
            <div class="nav_login">
                <?php
                    if (isset($_SESSION['u_username'])) {
                        echo '<form action="includes/logout.inc.php" method="POST"><button type="submit" name="submit">Logout</button></form>';
                    } else { // not logged in.
                        echo '<form action="includes/login.inc.php" method="POST"><input type="text" name="username" placeholder="Username/e-mail"><input type="password" name="password" placeholder="password"><button type="submit" name ="submit">Login</button></form><a href="signup.php">Sign up</a>';
                    }
                ?>
            </div>
        </nav>
    </header>