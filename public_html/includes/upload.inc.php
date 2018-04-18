<?php
define('VALID_FILE_TYPES', array('jpg', 'jpeg', 'png', 'pdf'));

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
   
    // if (in_array(VALID_FILE_TYPES)) {
    if (in_array($fileActualExtension, $allowed)) {
        if ($fileError === 0) { // 0 means no error
            if ($fileSize < $validFileSize) { 
                $fileNameNew = uniqid('', true) . "." . $fileActualExtension; // create a unique number in microseconds and then append the file extension to it77
                $fileDestination = '../uploads/' . $fileNameNew;
                
                move_uploaded_file($fileTmpFileLocation, $fileDestination);
                header("Location: ../index.php?uploadSuccess"); // bring back to index.php when we're done
            } else {
                echo "Your file is too big.";
            }
        } else {
            print_r($file);
            echo "</br>There was an error uploading your file!";
        }
    } else { 
        echo "You cannot upload files of this type.";
    }
}
?>