<?php
include_once 'header.php';
?>

<section class="main_container">
    <div class="container">
        <!-- IMAGE FRAME -->
        <div id="upload_image_frame" class="upload_image">
            <div id="upload_image_background">
            <?php
            if (isset($_SESSION['u_id'])) {
                include 'includes/dbh.inc.php'; 

                $loggedInUserId = $_SESSION['u_id'];
                $loggedInUsername = $_SESSION['u_username'];
                $sql = "SELECT * FROM users WHERE user_id = '$loggedInUserId'";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sqlImage = "SELECT * FROM profileimage WHERE user_id='$loggedInUserId'";
                        $resultImage = mysqli_query($conn, $sqlImage);

                        while ($rowImage = mysqli_fetch_assoc($resultImage)) {
                            $filename = $rowImage['filename'];
                            $status = $rowImage['status'];
                        }

                        echo '<div class="upload_image_image">';
                        if ($status == 1) { // 1 == We've already uploaded an image (so display it)
                            echo '<img style="width: 100%; height: 100%" src="uploads/' . $loggedInUsername . '/' . $filename . '">';
                        } else {
                            echo '<img style="width: 100%; height: 100%" src="assets/defaultprofilepic.png">'; // Default
                        }
                        echo "</div>";
                    }
                }
            ?>
            </div>
        </div>

        <!-- UPLOAD IMAGE FORM -->
        <div id="" class="upload_image">
            <form id="upload_image_form" action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
                <input class="btn btn-light btn-md" type="file" name="file">
                <button class="btn btn-primary btn-md" type="submit" name="upload_submit">Upload</button>  
            </form>
        </div>

        <!-- BACK BUTTON FORM -->
        <div id="upload_image_back_button" class="upload_image" >
            <form id="" action="includes/upload.inc.php" method="POST">
                <button class="btn btn-primary btn-md" type="submit" name="back_button">Back</button>
        </form>
        </div>
        <?php
        } else {
            echo "<h4>You are not logged in.</h4>";
        }
        ?>
    </div>
</section>
<?php

include_once 'footer.php';
?>