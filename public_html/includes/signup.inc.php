<?php 


include_once 'dbh.inc.php';
//require('user.php');

session_start(); // Starts session inside the website

if (isset($_POST['submit'])) {
    

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $firstName = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lastName = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if (empty($username) || empty($password) || empty($firstName) || empty($lastName) || empty($email)) {
        header("Location: ../signup.php?signup=empty_inputs");
    } else {
        //$password = password_hash($password, PASSWORD_DEFAULT);
        try {
            //$newUser = new User($username, $password, $firstName, $lastName, $email);
        } catch (Exception $e) {
            echo "ERROR" . $e;
            exit();
        }
        //signupUser($newUser);
        echo "ERRORzzzzzzzzzzzzzzzzzzze";
        exit();
        header("Location: ../index.php?signup=empty_inputs");
    }
} else {echo "ERRasdasdasdasd";
    exit();
    header("Location: ../signup.php?signup=failed");
}

// function signupUser($user) {
//     include 'dbh.inc.php';

//     // Check if input chars are valid
//     if (containsOnlyLetters($user->getFirstName()) && containsOnlyLetters($user->getLastName())) {
//         // Check if e-mail is valid
//         if (filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
//             $result = $user->getUserFromDB($conn);
//             $resultCheck = mysqli_num_rows($result);

//             if ($resultCheck === 0) {
//                 // Add user to DB
//                 $user->saveUserToDB($conn);
                
//                 // Get user from DB and use this information in our image table
//                 if ($user->checkIfUserExistsInDB($conn)) {
//                     $result = $user->getUserFromDB($conn);

//                     while ($row = mysqli_fetch_assoc($result)) {
//                         $id = $row['user_id'];
//                     }
                    
//                     // Set status in profileimage for new user to 0 (0 = no image uploaded)
//                     $sql =  "INSERT INTO profileimage (user_id, status, filename) " .
//                             "VALUES ('$id', 0, '');";
                    
//                     mysqli_query($conn, $sql);

//                     // Finally, log the user in
//                     logTheUserIntoTheWebsite($user, $conn);
//                     header("Location: ../signup.php?signup=success");exit();
//                 } else {
//                     header("Location: ../signup.php?signup=user_not_found");exit();
//                 }
//             } else {
//                 // User already exists in the DB
//                 header("Location: ../signup.php?signup=user_taken");exit();
//             }
//         } else {
//             // E-mail doesn't follow "xxx@xxx.com" format
//             header("Location: ../signup.php?signup=email");
//         } 
//     } else { // First and Last names are invalid
//         header("Location: ../signup.php?signup=invalid");
//     }
// }

function containsOnlyLetters($value) {
    // preg_match: value contains certain characters in a string
    if (preg_match("/^[a-zA-Z]*$/", $value)) {
        return true;
    } else {
        return false;
    }
}

// function logTheUserIntoTheWebsite($user, $conn) {
//     // Check for errors: Starting with if inputs are empty
//     if (!empty($user->getUsername()) && !empty($user->getPassword())) {
//         $result = $user->getUserFromDB($conn);
//         $resultCheck = mysqli_num_rows($result); // Returns how many rows found in the db using these params
        
//         if ($resultCheck > 0) {
//             if ($row = mysqli_fetch_assoc($result)) {
//                 // De-hashing password and matching up the password with the db password
//                 $hashedPasswordCheck = ($user->getPassword() === $row['user_password']);

//                 if ($hashedPasswordCheck == true) {
//                     $_SESSION['u_id'] = $row['user_id'];
//                     $_SESSION['u_first_name'] = $row['user_first_name'];
//                     $_SESSION['u_last_name'] = $row['user_last_name'];
//                     $_SESSION['u_email'] = $row['user_email'];
//                     $_SESSION['u_username'] = $row['user_username'];

//                     // Successful signup
//                     header("Location: ../index.php?signup=success");exit();
//                 } elseif ($hashedPasswordCheck == false) {
//                     header("Location: ../index.php?login=invalid_password");exit();
//                 } else {
//                     header("Location: ../index.php?login=error");exit();
//                 }
//             } else {
//                 header("Location: ../index.php?login=error");exit();
//             }
//         } else {
//             header("Location: ../index.php?login=error");exit();
//         }
//     } else {
//         header("Location: ../index.php?login=empty");
//         exit();
//     }
// }