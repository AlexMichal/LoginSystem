<?php
session_start(); // resume current session

if (isset($_POST['submit'])) { // name we're checking for inside the method is 'submit'
    $file = $_FILES['file']; // FILES is a super global where we get our input from a form where the name is 'file'
    $fileName = $file['name'];
    $fileTmpFileLocation = $_FILES['file']['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type']; // ex.: only allow jpegs
    $fileExtension = explode('.', $fileName); // first part: name of file, second: extension
    $fileActualExtension = strtolower(end($fileExtension)); // end: get last piece of information from array
    $allowed = array('jpg', 'jpeg', 'png');
    $validFileSize = "2000000";
   
    if (in_array($fileActualExtension, $allowed)) {
        if ($fileError === 0) { // 0 means no error
            if ($fileSize < $validFileSize) { 
                uploadFile();

                header("Location: ../index.php?upload=success");
            } else {
                // Error: filesize too large
                header("Location: ../uploadimage.php?upload=filesize_too_large");
            }
        } else {
            // Error: file upload error
            header("Location: ../uploadimage.php?upload=error");
        }
    } else { 
        // Error: incorrect file type
        header("Location: ../uploadimage.php?upload=wrong_file_type");
    }

    function uploadFile() {
        $fileDirectory = "../uploads/" . $_SESSION['u_username'];
        $fileNameNew = uniqid('', true) . "." . $fileActualExtension; // create a unique number in microseconds and then append the file extension to it77
        $fileDestination = $fileDirectory . "/" . $fileNameNew;
        
        if (!file_exists($fileDirectory)) {
            mkdir($fileDirectory, 0777, true);
        }

        move_uploaded_file($fileTmpFileLocation, $fileDestination);
    }
}
?>