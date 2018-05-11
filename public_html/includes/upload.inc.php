<?php

session_start(); // resume current session

// Upload Image button
if (isset($_POST['upload_submit'])) { // 'name' we're checking for inside the method is 'submit'
    try {
        uploadFile();
    } catch(Exception $e) {
        $msg = $e->getMessage();
        error_log($msg, 3, "php.log");
        exit;
    }
}

function uploadFile() {    
    $file = $_FILES['file']; // FILES is a super global where we get our input from a form where the name is 'file'
    $fileName = $file['name'];
    $fileTmpFileLocation = $_FILES['file']['tmp_name'];
    $fileDirectory = "../uploads/" . $_SESSION['u_username'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type']; // ex.: only allow jpegs
    $fileExtension = explode('.', $fileName); // first part: name of file, second: extension
    $fileActualExtension = strtolower(end($fileExtension)); // end: get last piece of information from array
    $validFileSize = "2000000";
    $allowedFileTypes = array('jpg', 'jpeg', 'png');
    // TODO CHANGE BACK TO THIS: $fileNameNew = uniqid('', true) . "." . $fileActualExtension; // create a unique number in microseconds and then append the file extension to it
    $fileNameNew = "profile_image_" . $_SESSION['u_username'] . "." . $fileActualExtension;
    $fileDestination = $fileDirectory . "/" . $fileNameNew;

    if (true) { // TODO add error if theres no file selected
        if (in_array($fileActualExtension, $allowedFileTypes)) {
            if ($fileError === 0) { // 0 means no error
                if ($fileSize < $validFileSize) { 
                    createDirectory($fileDirectory);
    
                    move_uploaded_file($fileTmpFileLocation, $fileDestination);
    
                    changeStatusToUploaded();

                    header("Location: ../uploadimage.php?upload=success");
                } else {
                    // throw new Exception('Filesize too large.');
                    header("Location: ../uploadimage.php?upload=filesize_too_large");
                }
            } else {
                // throw new Exception('Error uploading file.');
                header("Location: ../uploadimage.php?upload=error");
            }
        } else {
            // throw new Exception('Incorrect file type.');
            header("Location: ../uploadimage.php?upload=wrong_file_type");
        }
    } else { 
        header("Location: ../uploadimage.php?upload=no_file_selected");
    }
}

function createDirectory($fileDirectory) {
    if (!file_exists($fileDirectory)) mkdir($fileDirectory, 0777, true);
}

function changeStatusToUploaded() {
    include 'dbh.inc.php';
    
    $userId = $_SESSION['u_id'];
    $sql = "UPDATE profileimage SET status = 1 WHERE user_id = '$userId';";

    $result = mysqli_query($conn, $sql);
}

// BACK BUTTON
if (isset($_POST['back_button'])) {
    header("Location: ../index.php");
}
?>