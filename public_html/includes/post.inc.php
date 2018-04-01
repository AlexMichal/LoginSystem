<?php 

session_start(); // resume current session

if (isset($_POST['submit'])) {
    include_once 'dbh.inc.php'; // Open up the Database

    $post = mysqli_real_escape_string($conn, $_POST['message']); // We can use conn because we Included the DB file (dbh.inc)
    
    if (empty($post)) {
        header("Location: ../index.php?message=empty");
        exit();
    } else {
        // Check to see if u_id is set
        if (isset($_SESSION['u_id'])) {
            // TODO check to see if you even inserted into the message table
            $userId = $_SESSION['u_id'];
            $sql =  "INSERT INTO messages (message_post, message_user_id)" .
                    "VALUES ('$post', '$userId');";

            mysqli_query($conn, $sql);

            header("Location: ../index.php?message=success");
            exit();
        } else {
            header("Location: ../index.php?message=invaliduserid");
            exit();
        }
    }
}