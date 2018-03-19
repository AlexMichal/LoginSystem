<?php

// starts session inside the website
session_start();

if (isset($_POST['submit'])) {
    include 'dbh.inc.php'; 

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Error handles
    // Check if inputs are empty
    if (empty($username) || empty($password)) {
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        $sql =  "SELECT * FROM users WHERE user_username = '$username'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result); // returns how many rows found in the db using these params
        
        if ($resultCheck < 1) { // no results found
            header("Location: ../index.php?login=error");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
                // de-hashing password
                $hashedPasswordCheck = password_verify($password, $row['user_password']); // matching up password with the db password
                
                // check if passwords are equal
                if ($hashedPasswordCheck == false) {
                    // error if false
                    header("Location: ../index.php?login=errorHERE");
                    exit();
                } elseif ($hashedPasswordCheck == true) {
                    // true. log in user here.
                    $_SESSION['u_id'] = $row['user_id'];
                    $_SESSION['u_firstname'] = $row['user_first_name'];
                    $_SESSION['u_lastname'] = $row['user_last_name'];
                    $_SESSION['u_email'] = $row['user_email'];
                    $_SESSION['u_username'] = $row['user_username'];
                
                    // send user back to front page with a login success
                    header("Location: ../index.php?login=success");
                    exit();
                }
                
                //echo $row['user_username']; // example to echo out username
            }
        }
    }
} else {
    // Take back to index page if error
    header("Location: ../index.php?login=error");
    exit();
}