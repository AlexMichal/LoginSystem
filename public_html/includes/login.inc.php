<?php

session_start(); // Starts session inside the website

if (isset($_POST['submit'])) {
    include 'dbh.inc.php'; 
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    loginUser($username, $password);
} else {
    header("Location: ../index.php?login=error");
}

function loginUser($username, $password) {
    include 'dbh.inc.php'; 

    // Check for errors: Starting with if inputs are empty
    if (!empty($username) && !empty($password)) {
        $sql =  "SELECT * FROM users WHERE user_username = '$username'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result); // Returns how many rows found in the db using these params
        
        if ($resultCheck < 1) { // No results found, we exit
            header("Location: ../index.php?login=error");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
                // De-hashing password
                $hashedPasswordCheck = password_verify($password, $row['user_password']); // matching up password with the db password
                
                // Check if passwords are equal
                if ($hashedPasswordCheck == false) {
                    // Error if false
                    header("Location: ../index.php?login=invalidpassword");
                } elseif ($hashedPasswordCheck == true) {
                    // True, so log in user here.
                    $_SESSION['u_id'] = $row['user_id'];
                    $_SESSION['u_first_name'] = $row['user_first_name'];
                    $_SESSION['u_last_name'] = $row['user_last_name'];
                    $_SESSION['u_email'] = $row['user_email'];
                    $_SESSION['u_username'] = $row['user_username'];
                
                    header("Location: ../index.php?login=success");
                }
            }
        }
    } else {
        header("Location: ../index.php?login=empty");
    }
}