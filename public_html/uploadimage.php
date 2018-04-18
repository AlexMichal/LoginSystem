<?php
    include_once 'header.php';
?>  
<section class="main_container">
   <form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit">UPLOAD</button>  
   </form>
</section>

<?php
    include_once 'footer.php';
?>