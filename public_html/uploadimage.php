<?php
    include_once 'header.php';
?>  
<section class="main_container">
    <!-- IMAGE FRAME -->
    <div id="upload_image_frame" class="upload_image">
        <image>
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
</section>

<?php
    include_once 'footer.php';
?>