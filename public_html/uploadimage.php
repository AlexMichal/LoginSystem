<?php
include_once 'header.php';

?>

<section class="main_container">
    <div class="container">
        <?php
        if (isset($_SESSION['u_id'])) {
            include 'includes/dbh.inc.php'; 

            $sql = "SELECT * FROM users";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) { // Any more results than 0
                while ($row = mysqli_fetch_assoc($result)) {
                    // get user id of the person inside the user table
                    $id = $row['user_id'];
                    $sqlImage = "SELECT * FROM profileimage WHERE user_id='$id'";
                    $resultImage = mysqli_query($conn, $sqlImage);

                    while ($rowImage = mysqli_fetch_assoc($resultImage)) {
                        echo "<div>";
                            if ($rowImage['status'] === 0) { // then we've already uploaded an image
                                echo "<img src='uploads/profile" . $id . ".png'>";
                            } else {
                                // default
                                echo "<img src='assets/defaultprofilepic.png'>";
                            }
                            echo $row['user_username'];
                        echo "</div>";
                    }
                }
            }
        ?>

            <!-- IMAGE FRAME -->
            <div id="upload_image_frame" class="upload_image">
                <div id="upload_image_background">
                    <?php 
                    // $dirname = "media/images/iconized/";
                    // $image = glob($dirname."*.png");

                    // echo '<img src="'.$image.'" /><br />';
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