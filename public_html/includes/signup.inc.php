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
                // Add user to DB
                $user->saveUserToDB($conn);
                
                // Get user from DB and use this information in our image table
                if ($user->checkIfUserExistsInDB($conn)) {
                    $result = $user->getUserFromDB($conn);
                    $row = mysqli_fetch_assoc($result);
                    $id = $row['user_id'];
                    
                    // Set status in profileimage for new user to 1
                    $sql =  "INSERT INTO profileimage (user_id, status) " .
                            "VALUES ('$id', 1);";
                    
                    mysqli_query($conn, $sql);
                            
                    // successful signup
                    header("Location: ../index.php?signup=success");
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

function addImageToDB($user, $conn) {

}