<?php
    if (isset($_POST['submit'])) {
        // basically going to log us out of the website
        session_start(); // need to have the session running in this document in order to destroy it
        session_unset(); // unset all session variables
        session_destroy();
        header("Location: ../index.php"); // take us back to the front page
        exit();
    }
?>