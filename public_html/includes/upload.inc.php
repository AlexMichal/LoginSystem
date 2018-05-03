<?php

// namespace app\service\myservice;

session_start(); // resume current session

// try {
//     tesrt();
// } catch (Exception $e) {
//     $msg = $e->getMessage();
//     error_log($msg);
//     exit;
// }

// UPLOAD IMAGE BUTTOn
if (isset($_POST['upload_submit'])) { // name we're checking for inside the method is 'submit'
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
   

    try {
        uploadFile();
    } catch(Exception $e) {
        $msg = $e->getMessage();
        error_log($msg);
    exit;
    }
}

function uploadFile() {
    $fileDirectory = "../uploads/" . $_SESSION['u_username'];
    $fileNameNew = uniqid('', true) . "." . $fileActualExtension; // create a unique number in microseconds and then append the file extension to it77
    $fileDestination = $fileDirectory . "/" . $fileNameNew;
    
    // Error: no file selected
    if (false) { // TODO add error if theres no file selected
        header("Location: ../uploadimage.php?upload=no_file_selected");
    } else {

    }

    // Error: incorrect file type
    $isAcceptableFileType = in_array($fileActualExtension, $allowed);
    if (!$isAcceptableFileType) {
        throw new Exception('File is not acceptable.');
        header("Location: ../uploadimage.php?upload=wrong_file_type");
    }

    $hasError = ($fileError === 1);
    if ($hasError) { // 0 means no error
        // Error: file upload error
        throw new Exception('Error uploading file.');
        header("Location: ../uploadimage.php?upload=error");
    }

    if ($fileSize < $validFileSize) { 
        // Error: filesize too large
        header("Location: ../uploadimage.php?upload=filesize_too_large");
    }

    if (!file_exists($fileDirectory)) {
        mkdir($fileDirectory, 0777, true);
    }

    move_uploaded_file($fileTmpFileLocation, $fileDestination);

    header("Location: ../uploadimage.php?upload=success");
}

// BACK BUTTON
if (isset($_POST['back_button'])) {
    header("Location: ../index.php");
}
?>
