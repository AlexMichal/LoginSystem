<?php
    include_once 'header.php';
?>

<section class="main_container">
    <div class="main_wrapper">
        <h2>Home</h2>
        <?php
            // check if session variable set
            // use the isset function to change any content on any page when a user is logged in
            if (isset($_SESSION['u_id'])) {
                echo $_SESSION['u_username'];
            }
        ?>
    </div>
</section>

<?php
    include_once 'footer.php';
?>
