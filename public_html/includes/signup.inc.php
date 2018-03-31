<?php 
if (isset($_POST['submit'])) {
    
    // TODO once SUCCESS we should change to INDEX
    include_once 'dbh.inc.php';

    $first = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Error handlers
    if (empty($first) || 
        empty($last) || 
        empty($email) || 
        empty($username) || 
        empty($password)) { // php function to check if inputs are empty
        // check for errors first
        header("Location: ../signup.php?signup=empty");
        exit();
    }  else {
        // check if input chars are valid
        if (!preg_match("/^[a-zA-Z]*$/", $first) ||
            !preg_match("/^[a-zA-Z]*$/", $last)) { 
            // php func that goes in to see if we have certain chars in a string
            header("Location: ../signup.php?signup=invalid");
            exit();
        } else { // if we have valid chars
            // check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // check for errors in email
                header("Location: ../signup.php?signup=email");
                exit();
            } else {
                $sql = "SELECT * FROM users WHERE user_username = '$username'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) { // we already have a user in the signup page
                    header("Location: ../signup.php?signup=usertaken");
                    exit();
                } else {
                    // hashing the password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // insert the user into the database
                    $sql =  "INSERT INTO users (user_first_name, user_last_name, user_email, user_username, user_password)" .
                            "VALUES ('$first', '$last', '$email', '$username', '$hashedPassword');";
                    
                    // insert data into the database
                    mysqli_query($conn, $sql);
                    
                    // successful signup
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }   
        }
    }

} else {
    header("Location: ../signup.php");
    exit(); // closes off and stops the script from running
}