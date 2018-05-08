<?php 

require_once '../user.php';
include_once 'dbh.inc.php';

if (isset($_POST['submit'])) {
    // TODO once SUCCESS we should change to INDEX
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $firstName = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lastName = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if (empty($username) || empty($password) || empty($firstName) || empty($lastName) || empty($email)) {
        header("Location: ../signup.php?signup=empty_inputs");
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $newUser = new User($username, $password, $firstName, $lastName, $email);

        signupUser($newUser);
    }
} else {
    header("Location: ../signup.php?signup=failed");
}

function signupUser($user) {
    include 'dbh.inc.php';

    // Check if input chars are valid
    if (containsOnlyLetters($user->getFirstName()) && containsOnlyLetters($user->getLastName())) {
        // Check if e-mail is valid
        if (filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $result = $user->getUserFromDB($conn);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck === 0) {
                $user->saveUserToDB($conn);
                
                // go into the db and select user we just created so that we can use this information in our image table
                $results = $user->getUserFromDB($conn);
                
                if (mysqli_num_rows($results) > 0 ) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $id = $row['user_id'];

                        // set status in profileimage for new user to 1
                        $sql =  "INSERT INTO profileimage ('$id', 1) " .
                                "VALUES ('$first', '$last', '$email', '$username', '$hashedPassword');";

                        // successful signup
                        header("Location: ../index.php?signup=success");
                        exit();
                    }
                } else {
                    header("Location: ../signup.php?signup=user_not_found");
                }
            } else {
                // User already exists in the DB
                header("Location: ../signup.php?signup=user_taken");
            }
        } else {
            // E-mail doesn't follow "xxx@xxx.com" format
            header("Location: ../signup.php?signup=email");
        } 
    } else { // First and Last names are invalid
        header("Location: ../signup.php?signup=invalid");
    }
}

function containsOnlyLetters($value) {
    // preg_match: value contains certain characters in a string
    if (preg_match("/^[a-zA-Z]*$/", $value)) {
        return true;
    } else {
        return false;
    }
}

// function getUserFromDB($username) {
//     $sql = "SELECT * FROM users WHERE user_username = '$username'";
//     $result = mysqli_query($conn, $sql);

//     return $result;
// }

// function insertUserIntoDB($user) {
//     $sql =  "INSERT INTO users (user_first_name, user_last_name, user_email, user_username, user_password) " .
//             "VALUES ('$user->getFirstName', '$user->getLasttName', '$user->getEmail', '$user->getUsername', '$user->getPassword');";

//     // insert data into the database
//     mysqli_query($conn, $sql);
// }